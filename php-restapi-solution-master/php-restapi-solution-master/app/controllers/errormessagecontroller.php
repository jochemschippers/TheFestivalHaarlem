<?php
require_once __DIR__ . '/controller.php';

class ErrorMessageController extends Controller
{
    public function index()
    {
        $models = [];
        $this->displayView($models);
    }
    public function Error500(){
        $models = [];
        $this->displayView($models);
    }
    public function Error404(){
        $models = [];
        $this->displayView($models);
    }
}
