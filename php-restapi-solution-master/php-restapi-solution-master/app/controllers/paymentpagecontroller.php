<?php
require __DIR__ . '/controller.php';

class paymentpageController extends Controller {
    public function index() {
        require __DIR__ . '/../views/paymentpage/index.php';
    }
}
?>