<?php
require __DIR__ . '/../services/PaymentService.php';

class paymentpageController {
    public function index() {
        require __DIR__ . '/../views/paymentpage/index.php';
    }
    public function login() {
        require __DIR__ . '/../views/paymentpage/login.php';
    }
    public function payment() {
        require __DIR__ . '/../views/paymentpage/payment.php';
    }
    public function recieve() {
        require __DIR__ . '/../views/paymentpage/recieve.php';
    }
    private $paymentService; 
    function __construct() {
        $this->paymentService = new PaymentService();
    }
    public function getEvents(){
        return $this->paymentService->getAll();
    }
}
?>