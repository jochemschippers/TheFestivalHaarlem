<?php
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/landmarkservice.php';

class AdminController extends Controller {

    private $LandmarkService;

    // initialize services
    function __construct() {
        parent::__construct();
        $this->LandmarkService = new LandmarkService();
    }

    public function index() {
        $models = [
            'landmarks' => $this->LandmarkService->getAllLandmarks()
        ];

        //$landmark = $this->landmarkService->getLandmark($_GET['landmarkID']);
        $this->displayView($models);
    }

    public function getAllLandmarks() {
        return $this->LandmarkService->getAllLandmarks();
    }

    public function getLandmark(int $landmarkID){
        return $this->LandmarkService->getLandmark($landmarkID);
    }

    public function createLandmark() {
        $this->LandmarkService->createLandmark($_POST['title'], $_POST['description'], $_POST['image']);
        header('Location: index.php?controller=admin&action=createLandmark');
    }

    public function updateLandmark() {
        $this->LandmarkService->updateLandmark($_POST['landmarkID'], $_POST['title'], $_POST['description'], $_POST['image']);
        header('Location: index.php?controller=admin&action=editLandmark');
    }

    public function deleteLandmark() {
        $this->LandmarkService->deleteLandmark($_POST['landmarkID']);
        header('Location: index.php?controller=admin&action=deleteLandmark');
    }

}

?>