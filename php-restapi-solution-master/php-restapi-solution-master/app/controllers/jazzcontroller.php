<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';

class JazzController extends Controller {
    private $JazzService;
    function __construct() {
        parent::__construct();
        $this->JazzService = new JazzService();
    }
    public function index() {
        $models = [
            "artists" => $this->JazzService->getAllArtists(),
            "locations" => $this->JazzService->getAllLocations(),
        ];
        $this->displayView($models);
    }
    public function getAllArtists(){
        return $this->JazzService->getAllArtists();
    }

}
?>