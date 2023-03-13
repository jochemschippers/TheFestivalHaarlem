<?php
require __DIR__ . '/../services/PaymentService.php';

class paymentpageController {
    public function index() {
        require __DIR__ . '/../views/paymentpage/index.php';
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