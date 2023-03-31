<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';


class TestController extends Controller
{
    private $service;
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $models = [];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    public function jazz(){
        $this->service = new JazzService();
        $models = [
            "artists" => $this->service->getAllArtists(),
            "locations" => $this->service->getAllLocations(),
        ];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
}
