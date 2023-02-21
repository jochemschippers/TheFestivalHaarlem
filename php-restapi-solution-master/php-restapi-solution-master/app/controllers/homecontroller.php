<?php
require __DIR__ . '/controller.php';

class HomeController extends Controller {
    public function index() {
        $this->displayView(null);
    }

    public function about() {
        echo "you've reached the about method of the home controller";
    }
}
?>