<?php
require __DIR__ . '/controller.php';

class TemplateController extends Controller {
    public function index() {
        require __DIR__ . '/../views/template/index.php';
    }    
}
?>