<?php
require __DIR__ . '/controller.php';

class JazzController extends Controller {
    public function index() {
        require __DIR__ . '/../views/jazz/index.php';
    }

    public function about() {
        echo "you've reached the about method of the home controller";
    }
}
?>