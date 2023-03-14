<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';

class JazzInformationController extends Controller {
    private $JazzService;
    function __construct() {
        $this->JazzService = new JazzService();
    }
    public function index() {
        require __DIR__ . '/../views/jazz/index.php';
    }
    public function getAllArtists(){
        return $this->JazzService->getAllArtists();
    }
}
?>