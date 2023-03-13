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
    public function getAll() {
        // retrieve data
        return $this->yummyDetailPageService->getAll();
    }

    public function getOne($restaurantId) {
        // retrieve data
        return $this->yummyDetailPageService->getOne($restaurantId);
    }

    public function getMenuItems($restaurantId){
       // retrieve data
       return $this->yummyDetailPageService->getMenuItems($restaurantId);
    }
    public function getAllImages(){
        // retrieve data
        return $this->yummyDetailPageService->getAllImages();
    }
    public function getImages($restaurantId){
        // retrieve data
        return $this->yummyDetailPageService->getImages($restaurantId);
    }
    public function getFoodTypes(){
        // retrieve data
        return $this->yummyDetailPageService->getFoodTypes();
    }
}
?>