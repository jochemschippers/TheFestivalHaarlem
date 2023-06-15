<?php
require_once __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/../services/cartservice.php';
require_once __DIR__ . '/controller.php';



class paymentpageController extends Controller
{
    private $paymentService;
    private $yummyService;
    private $cartService;
    private $URL;

    function __construct()
    {
        $this->URL = 'http://' . $_SERVER['HTTP_HOST']. '/';
        $this->paymentService = new PaymentService();
        $this->yummyService = new YummyService();
        $this->cartService = new CartService();
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
    public function getPersonalProgramItems(){
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
    
        $response = [
            'status' => 0,
            'message' => 'cart is empty!',
            'tickets' => null
        ];
        try {
            if (isset($data["cart"]) && is_array($data["cart"])) {
                $getCartItemsResult = $this->cartService->getCart($data["cart"], $_SESSION['userID'] ?? null);
    
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
            $getCartItemsResult = $this->cartService->getCart($data["cart"], $_SESSION['userID'] ?? null);
            try{
                if (!empty($getCartItemsResult['items'])) {
                    $totals = $this->cartService->calculateTotals($getCartItemsResult['items']);
        
                    // Initialize Mollie API client
                    require_once __DIR__ . "/../vendor/autoload.php";
                    $mollie = new \Mollie\Api\MollieApiClient();
                    $mollie->setApiKey("test_wJ4ga3MgMbww8yk3S3Hb98EUxDebuN"); 
                    // Create a payment object with the total from your cart
                    $payment = $mollie->payments->create([
                        "amount" => [
                            "currency" => "EUR", 
                            "value" => $totals['total']
                        ],
                        "description" => "Order for The Festival",
                        "redirectUrl" => $this->URL . "/paymentPage/payment-success",
                        "webhookUrl" => $this->URL . "/paymentPage/mollie-webhook", 
                    ]);
                    // Send a response with the payment URL
                    echo json_encode(["paymentUrl" => $payment->getCheckoutUrl()]);
                } else {
                    echo json_encode(["error" => "Cart is empty."]);
                }
            }catch(\Mollie\Api\Exceptions\ApiException $e){
                echo json_encode(["error" => $e->getMessage()]);
            }
           
        } else {
            echo json_encode(["error" => "Invalid cart data."]);
        }
    }
    public function mollieWebhook() {
        $mollie = new \Mollie\Api\MollieApiClient();
        $paymentId = $_POST['id']; 
        var_dump($_POST['id']);
        $payment = $mollie->payments->get($paymentId);
        $models=['error' => 'Something went wrong with your payment. Please try again later.'];
    
        switch($payment->status) {
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
    private function paymentFailed($models){
        $this->displayView($models);
    }
}