<?php
require_once __DIR__ . '/controller.php';
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
        ];

        $this->displayView($models);
    }

    public function getAllLandmarks() {
        return $this->landmarkService->getAllLandmarks();
    }

    public function getLandmark(){
        return $this->landmarkService->getLandmark($_POST['landmarkID']);
    }

    public function createLandmark() {
        //$this->landmarkService->createLandmark(0, $_POST['setTitle'], $_POST['setDescription'], $_POST['setImage']);
        $landmark = new Landmark(0, $_POST['setTitle'], $_POST['setDescription'], $_POST['setImage']);
        $this->landmarkService->createLandmark($landmark);
    }

    public function updateLandmark() {
        $this->landmarkService->updateLandmark($_POST['setLandmarkID'], $_POST['setTitle'], $_POST['setDescription'], $_POST['setImage']);
    }

    public function deleteLandmark() {
        $this->landmarkService->deleteLandmark($_POST['setLandmarkID']);
    }

}

?>