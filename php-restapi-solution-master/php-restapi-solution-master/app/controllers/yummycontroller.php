<?php
require __DIR__ . '/controller.php';
include_once __DIR__ . '/../services/yummyservice.php';

class YummyController extends Controller
{

    private $yummyService;

    // initialize services
    function __construct() {
        parent::__construct();
        $this->yummyService = new YummyService();
    }

    public function index()
    {
        $models = [
            "restaurants" => $this->yummyService->getAll(),
            "foodTypes" =>  $this->yummyService->getFoodTypes(),
            "restaurantFoodTypes" => $this->yummyService->getRestaurantFoodTypes(),
        ];

        $this->displayView($models);
    }    
    public function restaurant() {
        // $model = $this->yummyDetailPageService->getAll();
        require __DIR__ . '/../views/yummy/detailPage.php';
    }
    public function getAll()
    {
        // retrieve data
        return $this->yummyService->getAll();
    }

    public function getOne($restaurantId)
    {
        // retrieve data
        return $this->yummyService->getOne($restaurantId);
    }

    public function getMenuItems($restaurantId){
       // retrieve data
       return $this->yummyService->getMenuItems($restaurantId);
    }
    public function getAllImages()
    {
        // retrieve data
        return $this->yummyService->getAllImages();
    }
    public function getImages($restaurantId)
    {
        // retrieve data
        return $this->yummyService->getImages($restaurantId);
    }
    public function getFoodTypes()
    {
        // retrieve data
        return $this->yummyService->getFoodTypes();
    }
    public function getRestaurantFoodTypes(){
        // retrieve data
        return $this->yummyService->getRestaurantFoodTypes();
    }
}
