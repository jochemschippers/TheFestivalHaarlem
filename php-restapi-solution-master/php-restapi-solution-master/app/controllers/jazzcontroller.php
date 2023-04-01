<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';

class JazzController extends Controller {
    private $service;
    function __construct() {
        parent::__construct();
        $this->service = new JazzService();
    }
    public function index() {
        $models = [
            "artists" => $this->service->getAllArtists(),
            "locations" => $this->service->getAllLocations(),
        ];
        $this->displayView($models);
    }

}
?>