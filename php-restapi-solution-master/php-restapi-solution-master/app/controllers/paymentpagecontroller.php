<?php
require_once __DIR__ . '/../services/paymentservice.php';
require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/../services/personalprogramservice.php';
require_once __DIR__ . '/controller.php';



class paymentpageController extends Controller
{
    private $paymentService;
    private $yummyService;
    private $personalProgramService;

    function __construct()
    {
        $this->paymentService = new PaymentService();
        $this->yummyService = new YummyService();
        $this->personalProgramService = new PersonalProgramService();
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
                $paymentUrl = $this->paymentService->createMolliePayment($totals['total']);
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
        $mollie = new \Mollie\Api\MollieApiClient();
        $paymentId = $_POST['id'];
        $payment = $mollie->payments->get($paymentId);
        $models = ['error' => 'Something went wrong with your payment. Please try again later.'];

        switch ($payment->status) {
            case 'failed':
                $models = ['error' => 'Your payment has failed. Please check your payment details and try again.'];
                break;
            case 'canceled':
                $models = ['error' => 'Your payment was cancelled. Please try again or contact support if you need help.'];
                break;
            case 'expired':
                $models = ['error' => 'Your payment has expired. Please try again.'];
                break;
        }
        $this->paymentFailed($models);
    }
    private function paymentFailed($models)
    {
        $this->displayView($models);
    }
    public function paymentSuccess()
    {

        $paymentId = $_GET['id'];
        $models = ['error' => 'Something went wrong with your payment. Please try again later.'];
        try {
            $status = $this->paymentService->verifyPayment($paymentId);
            if ($status == 'paid') {
                $cartItems = $this->personalProgramService->getCart($_SESSION['cart'], $_SESSION['userID'] ?? null)['items'];
                $this->personalProgramService->saveCart($cartItems, $_SESSION['userID']);
                // Display a success view

                $this->displayView($models);
                return;
            }
        } catch (ErrorException $e) {
            $models = ['error' => 'Something went wrong on our side. Sorry! Please try again later.' . $e->getMessage()];
        }
        $this->paymentFailed($models);
    }
}
