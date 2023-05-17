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
    function __construct()
    {
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

    public function login()
    {
        $models = [
            "JazzTickets" => $this->paymentService->GetJazzTickets()
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
            'message' => 'cart is empty! please go to products and press "add to cart"',
            'products' => null
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
}
?>