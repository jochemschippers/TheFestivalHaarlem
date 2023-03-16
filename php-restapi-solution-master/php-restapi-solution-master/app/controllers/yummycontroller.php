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
        
        $restaurantId = $_GET['restaurantId'];
        $models = [
            "restaurantId"=> $restaurantId,
            "restaurant" => $this->yummyService->getOne($restaurantId),
            "menuItems" =>  $this->yummyService->getMenuItems($restaurantId),
            "images" => $this->yummyService->getImages($restaurantId),
            "restaurantFoodTypes" => $this->yummyService->getRestaurantFoodTypes(),
        ];

       $this->displayView($models);
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
