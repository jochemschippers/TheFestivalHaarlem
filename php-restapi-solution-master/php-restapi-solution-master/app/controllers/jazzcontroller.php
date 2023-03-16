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
            "artists" => $this->JazzService->getAllArtists()
        ];
        $this->displayView($models);
        // require __DIR__ . '/../views/jazz/index.php';
    }
    public function getAllArtists(){
        return $this->JazzService->getAllArtists();
    }

}
?>