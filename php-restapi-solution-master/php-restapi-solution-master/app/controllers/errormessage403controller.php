<?php
require_once __DIR__ . '/controller.php';

class ErrorMessage403Controller extends Controller
{
    private $service;
    public function index()
    {
        $models = [];
        $this->displayView($models);
    }
}
