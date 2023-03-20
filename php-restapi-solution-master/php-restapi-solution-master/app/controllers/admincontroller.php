<?php
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/landmarkservice.php';

class AdminController extends Controller {

    private $landmarkService;

    // initialize services
    function __construct() {
        parent::__construct();
        $this->landmarkService = new LandmarkService();
    }

    public function index() {
        
        $models = [
            "landmarks" => $this->landmarkService->getAllLandmarks(),
            "landmark" => $this->landmarkService->getLandmark($_GET['landmarkID']),    
        ];

        $this->displayView($models);
    }

    public function getAllLandmarks() {
        return $this->landmarkService->getAllLandmarks();
    }

    public function getLandmark(){
        return $this->landmarkService->getLandmark($_GET['landmarkID']);
    }

    public function createLandmark() {
        $this->landmarkService->createLandmark($_POST['title'], $_POST['description'], $_POST['image']);
        header('Location: index.php?controller=admin&action=createLandmark');
    }

    public function updateLandmark() {
        $this->landmarkService->updateLandmark($_POST['landmarkID'], $_POST['title'], $_POST['description'], $_POST['image']);
        header('Location: index.php?controller=admin&action=editLandmark');
    }

    public function deleteLandmark() {
        $this->landmarkService->deleteLandmark($_POST['landmarkID']);
        header('Location: index.php?controller=admin&action=deleteLandmark');
    }

}

?>