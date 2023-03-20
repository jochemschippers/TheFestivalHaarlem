<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/landmarkservice.php';
require_once __DIR__ . '/../services/strollthroughhistoryservice.php';

class StrollThroughHistoryController extends Controller {
    private $landmarkService;
    private $historyService;

    function __construct() {
        parent::__construct();
        $this->landmarkService = new LandmarkService();
        $this->historyService = new HistoryService();
    }

    public function index() {
        $landmarkID = $_GET['landmarkID'];

        $models = [
            "landmarkID" => $landmarkID,
            "landmarks" => $this->landmarkService->getAllLandmarks(),
            "landmark" => $this->landmarkService->getLandmark($_GET['landmarkID']),
            
        ];

        $this->displayView($models);
    }

    public function getAllLandmarks() {
        return $this->landmarkService->getAllLandmarks();
    }


    
}
?>