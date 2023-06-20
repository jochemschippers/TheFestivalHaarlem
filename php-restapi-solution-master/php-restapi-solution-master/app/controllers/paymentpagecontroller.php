<?php
require_once __DIR__ . '/../services/paymentservice.php';
require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/../services/personalprogramservice.php';
require_once __DIR__ . '/../services/encryptionservice.php';
require_once __DIR__ . '/controller.php';



class paymentpageController extends Controller
{
    private $paymentService;
    private $yummyService;
    private $personalProgramService;
    private $encryptionService;

    function __construct()
    {
        $this->paymentService = new PaymentService();
        $this->yummyService = new YummyService();
        $this->personalProgramService = new PersonalProgramService();
        $this->encryptionService = new EncryptionService();
    }


    public function index()
    {

        $models = [
            "JazzTickets" => $this->paymentService->GetJazzTickets(),
            "restaurantReservations" => $this->yummyService->getAllRestaurantReservations(),
        ];
        $this->displayView($models);
    }
    public function payment()
    {
        $models = [
            "JazzTickets" => $this->paymentService->GetJazzTickets(),
            "restaurantReservations" => $this->yummyService->getAllRestaurantReservations(),
        ];
        $this->displayView($models);
    }
    public function recieve()
    {
        $models = [
            "JazzTickets" => $this->paymentService->GetJazzTickets()
        ];
        $this->displayView($models);
    }
    public function getPersonalProgramItems()
    {
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);

        $response = [
            'status' => 0,
            'message' => 'cart is empty!',
            'tickets' => null
        ];
        try {
            if (isset($data["cart"]) && is_array($data["cart"])) {
                $getCartItemsResult = $this->personalProgramService->getCart($data["cart"], $_SESSION['userID'] ?? null);
                if (!empty($getCartItemsResult['items'])) {
                    $response['tickets'] = $getCartItemsResult['items'];
                    $response['message'] = $getCartItemsResult['message'];
                    //status of 1 means cart loaded succesfully, 2 means cart loaded succesfully AND user is logged in
                    $response['status'] = isset($_SESSION['userID']) ? 2 : 1;
                }
            }
        } catch (ErrorException $e) {
            $response['message'] = $e->getMessage();
        }

        echo json_encode($response);
    }
    public function createMolliePayment()
    {
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        if (isset($data["cart"]) && is_array($data["cart"])) {
            $getCartItemsResult = $this->personalProgramService->getCart($data["cart"], $_SESSION['userID'] ?? null);
            $totals = $this->personalProgramService->calculateTotals($getCartItemsResult['items']);
            try {
                $programId = $this->personalProgramService->saveCart($getCartItemsResult['items'], $_SESSION['userID']);
                $paymentUrl = $this->paymentService->createMolliePayment($totals['total'], $getCartItemsResult, $programId);
                echo json_encode(["paymentUrl" => $paymentUrl]);
            } catch (ErrorException $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
        } else {
            echo json_encode(["error" => "Invalid cart data."]);
        }
    }
    public function mollieWebhook()
    {
        if (!isset($_POST['id'])) {
            http_response_code(400);
            exit("No payment ID provided");
        }
        $paymentId = $_POST['id'];
        if($this->paymentService->checkIfPaymentPaid($paymentId)){
            $programId= $this->paymentService->getProgramIdByPaymentId($paymentId);
            $this->personalProgramService->updateStatus($programId, true);
            $this->paymentService->deletePaymentById($paymentId);
        }
    }
    private function paymentFailed($models)
    {
        $this->displayView($models);
    }
    public function paymentConfirm()
    {
        $personalProgram =$this->personalProgramService->getMostRecentPersonalProgram($_SESSION['userID'] ?? null);
        if (!$personalProgram) {
            $models = ['error' => 'Could not retrieve payment information. Please try again later.'];
            $this->paymentFailed($models);
            return;
        }
        if($personalProgram->getIsPaid()){
            $userId = $_SESSION['userID'];
            $personalProgramId = $personalProgram->getProgramId();
            
            $combinedId = $userId . '|' . $personalProgramId;
            $encryptedId = $this->encryptionService->encryptId($combinedId);
            $url = 'https://' . $_SERVER['HTTP_HOST'] . "/paymentPage/personalProgram?id={$encryptedId}";
            header("Location: $url");
            return;
        }else{
            $models = ['error' => 'Your payment has failed, was cancelled or has expired. Please try again or contact support if you need help.'];
            $this->paymentFailed($models);
        }
    }
    public function personalProgram(){
        $encryptedId = $_GET['id'] ?? null;
        if(!$encryptedId){
            $models = ['error' => 'Could not retrieve personal program. Please check if the typed url is correct.'];
            $this->paymentFailed($models);
            return;
        }
        try{
            $decryptedId = $this->encryptionService->decryptId($encryptedId);
            $personalProgram = $this->personalProgramService->getPersonalProgramById($decryptedId['personalProgramId'] , $decryptedId['userId']);
            $personalProgram = $this->personalProgramService->fillPersonalProgramWithItems($personalProgram);
            $personalProgram->setTotals($this->personalProgramService->calculateTotals($personalProgram->getItems()));
            $models = ["personalProgram" => $personalProgram];
            $this->displayView($models);
        }catch(ErrorException $e){
            $models = ['error' => 'Could not retrieve personal program. Please check if the typed url is correct.'];
            $this->paymentFailed($models);
            return;
        } catch (Exception $e) {
            $models = ['error' => 'Could not retrieve personal program. Please check if the typed url is correct.'];
            $this->paymentFailed($models);
            return;
        }
    }
    public function getPaymentId()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $paymentId = $_SESSION['paymentId'] ?? null;
        echo json_encode(["paymentId" => $paymentId]);
    }
    private function getURL(){
        return 'https://' . $_SERVER['HTTP_HOST'] . '/';
    }
}
