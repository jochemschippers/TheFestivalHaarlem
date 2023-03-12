<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';

class JazzController extends Controller {
    public function index() {
        require __DIR__ . '/../views/jazz/index.php';
    }
}
?>