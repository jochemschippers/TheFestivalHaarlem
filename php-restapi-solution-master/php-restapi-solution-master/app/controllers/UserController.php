<?php
require __DIR__ . '/controller.php';

class UserController extends Controller {
    public function index() {
        require __DIR__ . '/../views/admin/index.php';
    }

}
?>