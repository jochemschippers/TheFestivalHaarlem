<?php
require __DIR__ . '/controller.php';

class HomeController extends Controller {

    public function index() {
        $models = [
            
        ];
        $this->displayView($models);
    }

    public function about() {
        echo "you've reached the about method of the home controller";
    }
}
?>