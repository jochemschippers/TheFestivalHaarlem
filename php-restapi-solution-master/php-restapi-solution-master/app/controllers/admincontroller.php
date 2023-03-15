<?php
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/landmarkservice.php';

class AdminController extends Controller {

    private $landmarkService;

    // initialize services
    function __construct() {
        $this->landmarkService = new LandmarkService();
    }

    public function index() {

        // retrieve data
        $landmarks = $this->landmarkService->getAllLandmarks();
        //$landmark = $this->landmarkService->getLandmark($_GET['landmarkID']);


        require __DIR__ . '/../views/admin/index.php';
    }

    public function getLandmark(int $landmarkID){
        return $this->landmarkService->getLandmark($landmarkID);
    }

    public function createLandmark() {
        $this->landmarkService->createLandmark($_POST['title'], $_POST['description'], $_POST['image']);
        header('Location: index.php?controller=admin&action=index');
    }

}

?>