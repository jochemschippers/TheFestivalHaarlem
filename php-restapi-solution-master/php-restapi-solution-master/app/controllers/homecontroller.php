<?php
require_once __DIR__ . '/controller.php';

class HomeController extends Controller {

    public function index() {
        $models = [
            
        ];
        $this->displayView($models);
    }
}
?>