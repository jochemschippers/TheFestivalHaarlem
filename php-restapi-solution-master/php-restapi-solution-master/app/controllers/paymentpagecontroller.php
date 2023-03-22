<?php
require_once __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/controller.php';

class paymentpageController extends Controller{
    private $paymentService; 
    function __construct() {
        $this->paymentService = new PaymentService();
        parent::__construct();
        
    }
    
  
    public function index() {
        $models = [
            "jazzTickets" => $this->paymentService->GetJazzTickets()
        ];
        $this->displayView($models);
        //require __DIR__ . '/../views/paymentpage/index.php';
    }
  
    public function login() {
        $this->displayView($this->models);
    }
    public function payment() {
        $this->displayView($this->models);
    }
    public function recieve() {
        $this->displayView($this->models);
    }
    
    // public function getEvents(){
    //     return $this->paymentService->getAll();
    // }
}
?>