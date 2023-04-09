<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/landmarkservice.php';
require_once __DIR__ . '/../services/yummyservice.php';

class AdminController extends Controller
{

    private $landmarkService;
    private $yummyService;

    // initialize services
    function __construct()
    {
        $this->landmarkService = new LandmarkService();
        $this->yummyService = new YummyService();
    }

    public function index()
    {

        //$restaurantId = $_GET['restaurantId']; //DEZE ZAL VERVANGEN MOETEN WORDEN WANT HIER WERKT HET ANDERS
        $models = [
            // HISTORY
            "landmarks" => $this->landmarkService->getAllLandmarks(),

            // JAZZ

            // YUMMY
            //"restaurantId"=> $restaurantId,
            "restaurants" => $this->yummyService->getAll(),
            "menuItems" => $this->yummyService->getAllMenuItems(),
            "images" => $this->yummyService->getAllImages(),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
        ];

        $this->displayView($models);
    }

    // -------------------  LANDMARKS  -------------------------

    public function getAllLandmarks()
    {
        return $this->landmarkService->getAllLandmarks();
    }

    public function getLandmark()
    {
        return $this->landmarkService->getLandmark($_POST['landmarkID']);
    }


    public function createLandmark() {
       
        $landmark = new Landmark(0, $_POST['setTitle'], $_POST['setDescription'], $_POST['setImage']);
        $this->landmarkService->createLandmark($landmark);
    }


    public function updateLandmark() {
        $this->landmarkService->updateLandmark($_POST['setLandmarkID'], $_POST['setTitle'], $_POST['setDescription'], $_POST['setImage']);
    }

    public function deleteLandmark() {
        $this->landmarkService->deleteLandmark($_POST['setLandmarkID']);

    

    }

    // --------------------------  JAZZ  ---------------------------------






    // --------------------------  YUMMY  --------------------------------
    public function getAllRestaurants()
    {
        return $this->yummyService->getAll();
    }

    public function getRestaurant()
    {
        return $this->yummyService->getOne($_POST['restaurantID']);
    }

    public function createRestaurant()
    {
        //$this->landmarkService->createLandmark($_POST['title'], $_POST['description'], $_POST['image']);
        // $start_time = DateTime::createFromFormat('Y-m-d H:i:s', $_POST['editRestaurantStartTime']);
        // $duration = DateTime::createFromFormat('H:i:s', $_POST['editRestaurantDuration']);

        // check if all the required POST parameters are set
        if (
            isset($_POST['createRestaurantName'], $_POST['createRestaurantAddress'], $_POST['createRestaurantContact'],
            $_POST['createRestaurantCardDescription'], $_POST['createRestaurantDescription'],
            $_POST['createRestaurantAmountOfStars'], $_POST['createRestaurantBannerImage'], $_POST['createRestaurantHeadChef'],
            $_POST['createRestaurantAmountSessions'], $_POST['createRestaurantAdultPrice'], $_POST['createRestaurantChildPrice'],
            $_POST['createRestaurantStartTime'], $_POST['createRestaurantDuration'])
        ) {

            // create a DateTime object for the start time
            $startTime = new DateTime($_POST['createRestaurantStartTime']);

            // create a DateInterval object for the duration
            $duration = new DateTime($_POST['createRestaurantDuration']);

            // create a new YummyRestaurant object with the required parameters
            $restaurant = new YummyRestaurant(
                0, // use 0 as the ID for a new restaurant
                $_POST['createRestaurantName'],
                $_POST['createRestaurantAddress'],
                $_POST['createRestaurantContact'],
                $_POST['createRestaurantCardDescription'],
                $_POST['createRestaurantDescription'],
                $_POST['createRestaurantAmountOfStars'],
                $_POST['createRestaurantBannerImage'],
                $_POST['createRestaurantHeadChef'],
                $_POST['createRestaurantAmountSessions'],
                $_POST['createRestaurantAdultPrice'],
                $_POST['createRestaurantChildPrice'],
                $startTime,
                $duration
            );

            // create a new YummyService object
            $yummyService = new YummyService();

            // call the createRestaurant method of the YummyService object with the restaurant object as the parameter
            $yummyService->createRestaurant($restaurant);
        } else {
            // handle the case where one or more POST parameters are missing
            echo "One or more required parameters are missing.";
        }

        // $restaurant = new YummyRestaurant(0, $_POST['createRestaurantName'], $_POST['createRestaurantAddress'],
        // $_POST['createRestaurantContact'], $_POST['createRestaurantCardDescription'], $_POST['createRestaurantDescription'],
        // $_POST['createRestaurantAmountOfStars'], $_POST['createRestaurantBannerImage'], $_POST['createRestaurantHeadChef'],
        // $_POST['createRestaurantAmountSessions'], $_POST['createRestaurantAdultPrice'], $_POST['createRestaurantChildPrice'],
        // $_POST['createRestaurantStartTime'], $_POST['createRestaurantDuration']);
        // $this->yummyService->createRestaurant($restaurant);
    }

    public function updateRestaurant()
    {
        $this->yummyService->updateRestaurant(
            $_POST['editRestaurantID'], $_POST['editRestaurantName'], $_POST['editRestaurantAddress'],
            $_POST['editRestaurantContact'], $_POST['editRestaurantCardDescription'], $_POST['editRestaurantDescription'],
            $_POST['editRestaurantAmountOfStars'], $_POST['editRestaurantBannerImage'], $_POST['editRestaurantHeadChef'],
            $_POST['editRestaurantAmountSessions'], $_POST['editRestaurantAdultPrice'], $_POST['editRestaurantChildPrice'],
            $_POST['editRestaurantStartTime'], $_POST['editRestaurantDuration']
        );
    }

    public function deleteRestaurant()
    {
        $this->yummyService->deleteRestaurant($_POST['deleteRestaurantID']);
    }

}

?>