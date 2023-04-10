<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';
require_once __DIR__ . '/../services/yummyservice.php';

class TestController extends Controller
{
    private $service;
    private $yummyService;

    // initialize services
    function __construct()
    {
        $this->yummyService = new YummyService();
    }

    public function index()
    {
        $models = [];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    // Jazz -----------------------------------------------
    public function jazz(){
        $this->service = new JazzService();
        $models = [
            "artists" => $this->service->getAllArtists(),
            "locations" => $this->service->getAllLocations(),
        ];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    public function updateArtist(){
        $response = array(
            'status' => 1,
            'message' => 'Account is successfully created! You can now login'
        );
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        try{
            //$this->service->register($data["fullname"], $data["password"], $data["email"], 0, $data["phoneNumber"]);
        }
        catch(ErrorException $e){
            // $response['status'] = 0;
            // $response['message'] = $e->getMessage();
        }
        $response['message'] = "aaaaa";
        echo json_encode($response);
    }

    // Yummy -------------------------------------
    // Call yummy info
    public function yummy(){
        $this->yummyService = new YummyService();
        $models = [
            "restaurants" => $this->yummyService->getAll(),
            "menuItems" => $this->yummyService->getAllMenuItems(),
            "images" => $this->yummyService->getAllImages(),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
            "timeSlotsYummy" => $this->yummyService->getAllTimeSlotsYummy(),
        ];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    // Yummy Functions

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

            // call the createRestaurant method of the YummyService object with the restaurant object as the parameter
            $this->yummyService->createRestaurant($restaurant);
        } else {
            // handle the case where one or more POST parameters are missing
            echo "One or more required parameters are missing.";
        }

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

    // END Yummy Functions
}
