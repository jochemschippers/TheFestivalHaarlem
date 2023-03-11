<?php
require __DIR__ . '/controller.php';
include_once __DIR__ . '/../services/yummyDetailPageservice.php';

class YummyController extends Controller {

    private $yummyDetailPageService; 

    // initialize services
    function __construct() {
        $this->yummyDetailPageService = new YummyDetailPageService();
    }

    public function index() {
        require __DIR__ . '/../views/yummy/index.php';
    }    
    public function restaurant() {
        $model = $this->yummyDetailPageService->getAll();
        require __DIR__ . '/../views/yummy/detailPage.php';
    }
}
?>