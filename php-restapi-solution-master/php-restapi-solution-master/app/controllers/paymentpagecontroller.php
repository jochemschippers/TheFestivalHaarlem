<?php
require_once __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/controller.php';



class paymentpageController extends Controller
{
    private $paymentService;
    private $yummyService;
    function __construct()
    {
        $this->paymentService = new PaymentService();
        $this->yummyService = new YummyService();
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
}
?>