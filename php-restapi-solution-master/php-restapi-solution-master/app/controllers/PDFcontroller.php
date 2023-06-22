<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/pdfservice.php';

class PDFController extends Controller {

    public function index() {
        require __DIR__ . '/../views/PDF/index.php';
    }
}
?>