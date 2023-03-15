<?php
require __DIR__ . '/controller.php';

class StrollThroughHistoryController extends Controller {
    public function index() {
        require __DIR__ . '/../views/history/index.php';
    }
    
}
?>