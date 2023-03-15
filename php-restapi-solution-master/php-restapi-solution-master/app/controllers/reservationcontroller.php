<?php
require __DIR__ . '/controller.php';

class ReservationController extends Controller {
    public function index() {
        require __DIR__ . '/../views/reservation/index.php';
    }    
}
?>