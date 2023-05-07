<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';
require_once __DIR__ . '/../services/yummyservice.php';

class TestController extends Controller
{
    private $jazzService;
    private $yummyService;
    private $apikeyService;

    // initialize services
    function __construct()
    {
        $this->yummyService = new YummyService();
        $this->jazzService = new JazzService();
        // $this->apikeyService = new ApikeyService();
    }

    public function index()
    {
        include_once __DIR__ . '/../views/test/adminnav.php';
        $models = [];
        $this->displayView($models);
    }

    public function apikeys(){
        include_once __DIR__ . '/../views/test/adminnav.php';
        $models = [
            // "apikeys" => $this->yummyService->getAllApiKeys(),
        ];
        $this->displayView($models);
    }
    public function jazz()
    {
        include_once __DIR__ . '/../views/test/adminnav.php';
        $models = [
            "artists" => $this->jazzService->getAllArtists(),
            "locations" => $this->jazzService->getAllLocations(),
        ];
        $this->displayView($models);
    }
    public function updateArtist()
    {
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => 'Artist is successfully updated!'
        );
        if ($data !== null) {
            try {
                $artist = new JazzArtist($data["artistID"], $data["description"], $data["imagePath"], $data["artistName"], $data["imageSmallPath"]);
                $this->jazzService->updateArtist($artist);
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
    public function deleteArtist()
    {
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => 'Artist is successfully deleted!'
        );
        if ($data !== null) {
            try {
                $artist = new JazzArtist($data["artistID"]);
                $this->jazzService->DeleteArtist($artist);
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
    public function createArtist()
    {
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => 'Artist is successfully created!',
            'artist' => ''
        );
        if ($data !== null) {
            try {
                //artistID wont be used, so it's 0 for now
                $artist = new JazzArtist(0, $data["description"], $data["imagePath"], $data["artistName"], $data["imageSmallPath"]);
                $response['artist'] = $this->jazzService->createArtist($artist);
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
    public function updateLocation()
    {
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => 'Location is successfully updated!'
        );
        if ($data !== null) {
            try {
                $location = new JazzLocation($data["locationID"], $data["locationName"], $data["address"], $data["imagePath"], $data["toAndFromText"], $data["accessibilityText"]);
                $this->jazzService->updateLocation($location);
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
    // Yummy -------------------------------------
    // Call yummy info
    public function yummy()
    {
        include_once __DIR__ . '/../views/test/adminnav.php';
        $this->checkPosts();
        $models = [
            "restaurants" => $this->yummyService->getAll(),
            "images" => $this->yummyService->getAllImages(),
            "menuItems" => $this->yummyService->getAllMenuItems(),
            "timeSlotsYummy" => $this->yummyService->getAllTimeSlotsYummy(),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
            "restaurantReservations" => $this->yummyService->getAllRestaurantReservations(),

        ];
        $this->displayView($models);

    }
    // Yummy Functions
    private function checkPosts()
    {
        // var_dump("checkPosts");
        // var_dump($_POST);
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // YUMMY RESTAURANT CRUD
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
                $_POST['createRestaurantChildPrice']
            )) {
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
                $_POST['editReservationNumberAdults'],
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
    }

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
        // check if all the required POST parameters are of the same type
        if (
            strval($_POST['createRestaurantName']) &&
            strval($_POST['createRestaurantAddress']) &&
            strval($_POST['createRestaurantContact']) &&
            strval($_POST['createRestaurantCardDescription']) &&
            strval($_POST['createRestaurantDescription']) &&
            intval($_POST['createRestaurantAmountOfStars']) &&
            strval($_POST['createRestaurantBannerImage']) &&
            strval($_POST['createRestaurantHeadChef']) &&
            strval($_POST['createRestaurantAmountSessions']) &&
            floatval($_POST['createRestaurantAdultPrice']) &&
            floatval($_POST['createRestaurantChildPrice'])
        ) {

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
        // check if all the required POST parameters are of the same type
        if (
            intval($_POST['editRestaurantId']) &&
            strval($_POST['editRestaurantName']) &&
            strval($_POST['editRestaurantAddress']) &&
            strval($_POST['editRestaurantContact']) &&
            strval($_POST['editRestaurantCardDescription']) &&
            strval($_POST['editRestaurantDescription']) &&
            intval($_POST['editRestaurantAmountOfStars']) &&
            strval($_POST['editRestaurantBannerImage']) &&
            strval($_POST['editRestaurantHeadChef']) &&
            strval($_POST['editRestaurantAmountSessions']) &&
            floatval($_POST['editRestaurantAdultPrice']) &&
            floatval($_POST['editRestaurantChildPrice'])
        ) {
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
        if (intval($_POST['createReservationTimeSlotID']) &&
        intval($_POST['createReservationRestaurantID']) &&
        strval($_POST['createReservationName']) &&
        intval($_POST['createReservationPhoneNumber']) &&
        intval($_POST['createReservationNumberAdults']) &&
        intval($_POST['createReservationNumberChildren']) &&
        strval($_POST['createReservationRemark']) && $this->checkPhoneNumber($_POST['createReservationPhoneNumber'])
        ) {

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

    private function checkPhoneNumber($phoneNr)
    {
        if (preg_match('/^((\+31|0)6[-\s]?[1-9](\d[-\s]?){7})$/', $phoneNr)) {
            // The input is a valid phone number
            return true;
        } else {
            // The input is not a valid phone number
            return false;
        }
    }

    public function editReservation()
    {
        if (
            intval($_POST['editReservationTimeSlotID']) &&
            intval($_POST['editReservationRestaurantID']) &&
            strval($_POST['editReservationName']) &&
            intval($_POST['editReservationPhoneNumber']) &&
            intval($_POST['editReservationNumberAdults']) &&
            intval($_POST['editReservationNumberChildren']) &&
            strval($_POST['editReservationRemark']) &&
            intval($_POST['editReservationTicketID'])
        ) {
            $reservation = new Restaurantreservation(
                $_POST['editReservationTicketID'],
                $_POST['editReservationTimeSlotID'],
                $_POST['editReservationRestaurantID'],
                $_POST['editReservationName'],
                $_POST['editReservationPhoneNumber'],
                $_POST['editReservationNumberAdults'],
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
        if (
            intval($_POST['activateReservationTicketID'])
        ) {
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
        if (
            $ticketID = intval($_POST['deactivateReservationTicketID'])
        ) {
            if ($this->yummyService->deactivateReservation($ticketID)) {
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
