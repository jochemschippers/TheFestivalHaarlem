<?php
require __DIR__ . '/controller.php';

class qrscannerController extends Controller {

    public function index() {
        require __DIR__ . '/../views/qrscanner/index.php';
    }
}
?>