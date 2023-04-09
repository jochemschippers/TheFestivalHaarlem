<?php
require_once __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/controller.php';



class paymentpageController extends Controller
{
    private $paymentService;
    function __construct()
    {
        $this->paymentService = new PaymentService();
    }


    public function index()
    {
        $models = [
            "JazzTickets" => $this->paymentService->GetJazzTickets()
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
            "JazzTickets" => $this->paymentService->GetJazzTickets()
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