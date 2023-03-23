<?php
require __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/controller.php';

class paymentpageController extends Controller{
    private $models;
    
    function __construct() {
        $this->paymentService = new PaymentService();
        parent::__construct();
        $this->models = [];
    }
  
    public function index() {
        $this->displayView($this->models);
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
    private $paymentService; 
    public function getEvents(){
        return $this->paymentService->getAll();
    }
}
?>