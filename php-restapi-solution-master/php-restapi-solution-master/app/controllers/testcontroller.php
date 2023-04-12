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

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            // var_dump($_POST);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (
                isset(
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
                    $_POST['createRestaurantChildPrice']
                )
            ) {
                $this->createRestaurant();
            }

            if (isset(
                $_POST['editRestaurantId'],
                $_POST['editRestaurantName'],
                $_POST['editRestaurantAddress'],
                $_POST['editRestaurantContact'],
                $_POST['editRestaurantCardDescription'],
                $_POST['editRestaurantDescription'],
                $_POST['editRestaurantAmountOfStars'],
                $_POST['editRestaurantBannerImage'],
                $_POST['editRestaurantHeadChef'],
                $_POST['editRestaurantAmountSessions'],
                $_POST['editRestaurantAdultPrice'],
                $_POST['editRestaurantChildPrice']
            )) {
                if (!$this->updateRestaurant()) {
                    echo "Something went wrong while updating the restaurant";
                }
            }
            if (isset(
                $_POST['deleteRestaurantID']
            )) {
                if (!$this->deleteRestaurant()) {
                    echo "Something went wrong while deleting the restaurant";
                }
            }
        }

        $models = [
            "restaurants" => $this->yummyService->getAll(),
            "images" => $this->yummyService->getAllImages(),
            "menuItems" => $this->yummyService->getAllMenuItems(),
            "timeSlotsYummy" => $this->yummyService->getAllTimeSlotsYummy(),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
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
        if (isset(
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
        )) {

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
        // var_dump($_POST);
        if (isset(
            $_POST['editRestaurantId'],
            $_POST['editRestaurantName'],
            $_POST['editRestaurantAddress'],
            $_POST['editRestaurantContact'],
            $_POST['editRestaurantCardDescription'],
            $_POST['editRestaurantDescription'],
            $_POST['editRestaurantAmountOfStars'],
            $_POST['editRestaurantBannerImage'],
            $_POST['editRestaurantHeadChef'],
            $_POST['editRestaurantAmountSessions'],
            $_POST['editRestaurantAdultPrice'],
            $_POST['editRestaurantChildPrice']
        )) {
            $restaurant = new YummyRestaurant(
                $_POST['editRestaurantId'],
                $_POST['editRestaurantName'],
                $_POST['editRestaurantAddress'],
                $_POST['editRestaurantContact'],
                $_POST['editRestaurantCardDescription'],
                $_POST['editRestaurantDescription'],
                $_POST['editRestaurantAmountOfStars'],
                $_POST['editRestaurantBannerImage'],
                $_POST['editRestaurantHeadChef'],
                $_POST['editRestaurantAmountSessions'],
                $_POST['editRestaurantAdultPrice'],
                $_POST['editRestaurantChildPrice'],
            );
            if ($this->yummyService->updateRestaurant($restaurant)) {
                return true;
            } else {
                return false;
            }
        } else {
            echo "One or more required parameters are missing.";
        }
    }

    public function deleteRestaurant()
    {
        if (isset($_POST['deleteRestaurantID'])) { {
                if ($this->yummyService->deleteRestaurant($_POST['deleteRestaurantID'])) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    // END Yummy Functions
}
