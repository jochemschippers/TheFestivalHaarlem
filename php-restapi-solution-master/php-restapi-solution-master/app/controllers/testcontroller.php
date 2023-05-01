<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';
require_once __DIR__ . '/../services/yummyservice.php';

class TestController extends Controller
{
    private $jazzService;
    private $yummyService;

    // initialize services
    function __construct()
    {
        $this->yummyService = new YummyService();
        $this->jazzService = new JazzService();
    }

    public function index()
    {
        $models = [];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    public function jazz(){
        $models = [
            "artists" => $this->jazzService->getAllArtists(),
            "locations" => $this->jazzService->getAllLocations(),
            "halls" => $this->jazzService->getAllHalls(),
            "timeSlotsJazz" => $this->jazzService->getAllTimeSlots(),
        ];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    private function handleRequest($action) {
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => ''
        );
    
        if ($data !== null) {
            try {
                $action($data, $response);
            } catch (ErrorException $e) {
                $response['status'] = 0;
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "Invalid input data format. Please check the provided data.";
        }
    
        echo json_encode($response);
    }
    public function updateArtist() {
        $this->handleRequest(function($data, &$response) {
            $artist = new JazzArtist($data["artistID"], $data["description"], $data["imagePath"], $data["artistName"], $data["imageSmallPath"]);
            $this->jazzService->updateArtist($artist);
            $response['message'] = 'Artist is successfully updated!';
        });
    }
    public function deleteArtist() {
        $this->handleRequest(function($data, &$response) {
            $artist = new JazzArtist($data["artistID"]);
            $this->jazzService->deleteArtist($artist);
            $response['message'] = 'Artist is successfully deleted!';
        });
    }
    public function createArtist() {
        $this->handleRequest(function($data, &$response) {
            //artistID won't be used, so it's 0 for now
            $artist = new JazzArtist(0, $data["description"], $data["imagePath"], $data["artistName"], $data["imageSmallPath"]);
            $response['artist'] = $this->jazzService->createArtist($artist);
            $response['message'] = 'Artist is successfully created!';
        });
    }
    public function updateLocation() {
        $this->handleRequest(function($data, &$response) {
            $location = new JazzLocation($data["locationID"], $data["locationName"], $data["address"], $data["imagePath"], $data["toAndFromText"], $data["accessibilityText"]);
            $this->jazzService->updateLocation($location);
            $response['message'] = 'Location is successfully updated!';
        });
    }
    public function deleteLocation() {
        $this->handleRequest(function($data, &$response) {
            $location = new JazzLocation($data["locationID"]);
            $this->jazzService->deleteLocation($location);
            $response['message'] = 'Location is successfully deleted!';
        });
    }
    public function createLocation() {
        $this->handleRequest(function($data, &$response) {
            //artistID won't be used, so it's 0 for now
            $location = new JazzLocation(0, $data["locationName"], $data["address"], $data["imagePath"], $data["toAndFromText"], $data["accesibillityText"]);
            $response['location'] = $this->jazzService->createLocation($location);
            $response['message'] = 'Location is successfully created!';
        });
    }

    // Yummy -------------------------------------
    // Call yummy info
    public function yummy()
    {

        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            // var_dump($_POST);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // YUMMY RESTAURANT CRUD
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
            // END OF YUMMY RESTAURANT CRUD

            // YUMMY RESERVATION CRUD
            if (isset(
                $_POST['createReservationTimeSlotID'],
                $_POST['createReservationRestaurantID'],
                $_POST['createReservationName'],
                $_POST['createReservationPhoneNumber'],
                $_POST['createReservationNumberAdults'],
                $_POST['createReservationNumberChildren'],
                $_POST['createReservationRemark']
            )) {
                if (!$this->createReservation()) {
                    echo "Something went wrong while creating the reservation";
                }
            }
            if (isset( // pas nog aan
                $_POST['editReservationTimeSlotID'],
                $_POST['editReservationRestaurantID'],
                $_POST['editReservationName'],
                $_POST['editReservationPhoneNumber'],
                $_POST['numberAdults'],
                $_POST['editReservationNumberChildren'],
                $_POST['editReservationRemark'],
                $_POST['editReservationTicketID']
            )) {
                if (!$this->editReservation()) {
                    echo "Something went wrong while updating the reservation";
                }
            }

            if (isset(
                $_POST['activateReservationTicketID']
            )) {
                if (!$this->activateReservation()) {
                    echo "Something went wrong while activating the reservation";
                }
            }

            if (isset(
                $_POST['deactivateReservationTicketID']
            )) {
                if (!$this->deactivateReservation()) {
                    echo "Something went wrong while deactivating the reservation";
                }
            }
            // END OF YUMMY RESERVATION CRUD

            // YUMMY MENU ITEM CRUD
            // END OF YUMMY MENU ITEM CRUD
        }

        $models = [
            "restaurants" => $this->yummyService->getAll(),
            "images" => $this->yummyService->getAllImages(),
            "menuItems" => $this->yummyService->getAllMenuItems(),
            "timeSlotsYummy" => $this->yummyService->getAllTimeSlotsYummy(),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
            "restaurantReservations" => $this->yummyService->getAllRestaurantReservations(),

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

    // Yummy Restaurant CRUD
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
    // END Yummy Restaurant CRUD

    // Yummy Reservation CRUD
    public function createReservation()
    {
        // check if all the required POST parameters are set
        if (isset(
            $_POST['createReservationTimeSlotID'],
            $_POST['createReservationRestaurantID'],
            $_POST['createReservationName'],
            $_POST['createReservationPhoneNumber'],
            $_POST['createReservationNumberAdults'],
            $_POST['createReservationNumberChildren'],
            $_POST['createReservationRemark'],
        )) {

            // create a new YummyReservation object with the required parameters
            $reservation = new Restaurantreservation(
                0, // use 0 as the ID for a new reservation
                $_POST['createReservationTimeSlotID'],
                $_POST['createReservationRestaurantID'],
                $_POST['createReservationName'],
                $_POST['createReservationPhoneNumber'],
                $_POST['createReservationNumberAdults'],
                $_POST['createReservationNumberChildren'],
                $_POST['createReservationRemark'],
                1
            );

            // call the createReservation method of the YummyService object with the reservation object as the parameter
            $this->yummyService->createReservation($reservation);
        } else {
            // handle the case where one or more POST parameters are missing
            echo "One or more required parameters are missing.";
        }
    }

    public function editReservation()
    {
        if (isset(
            $_POST['editReservationTimeSlotID'],
            $_POST['editReservationRestaurantID'],
            $_POST['editReservationName'],
            $_POST['editReservationPhoneNumber'],
            $_POST['numberAdults'],
            $_POST['editReservationNumberChildren'],
            $_POST['editReservationRemark'],
            $_POST['editReservationTicketID']
        )) {
            $reservation = new Restaurantreservation(
                $_POST['editReservationTicketID'],
                $_POST['editReservationTimeSlotID'],
                $_POST['editReservationRestaurantID'],
                $_POST['editReservationName'],
                $_POST['editReservationPhoneNumber'],
                $_POST['numberAdults'],
                $_POST['editReservationNumberChildren'],
                $_POST['editReservationRemark'],
                1
            );
            if ($this->yummyService->editReservation($reservation)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function activateReservation()
    {
        if (isset(
            $_POST['activateReservationTicketID']
        )) {
            if ($this->yummyService->activateReservation($_POST['activateReservationTicketID'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    private function deactivateReservation()
    {
        if (isset(
            $_POST['deactivateReservationTicketID']
        )) {
            if ($this->yummyService->deactivateReservation($_POST['deactivateReservationTicketID'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // END Yummy Reservation CRUD

    // END Yummy Functions
}
