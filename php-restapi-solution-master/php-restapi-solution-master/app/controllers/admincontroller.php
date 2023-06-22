<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';
require_once __DIR__ . '/../services/yummyservice.php';
require_once __DIR__ . '/../services/apiservice.php';
require_once __DIR__ . '/../services/accountservice.php';


class AdminController extends Controller
{
    private $jazzService;
    private $yummyService;
    private $apiService;
    private $accountService;

    // initialize services
    function __construct()
    {
        $this->yummyService = new YummyService();
        $this->jazzService = new JazzService();
        $this->apiService = new ApiService();
        $this->accountService = new AccountService();
    }

    public function index()
    {
        $models = [];
        $this->displayView($models);
    }
    public function api()
    {
        $models = [
            "apis" => $this->apiService->getAll(),
        ];
        $this->displayView($models);
    }
    public function apiCreate()
    {
        $this->handleRequest(function ($data, &$response) {
            // Get the data from the request
            $apiID = isset($data['apiID']) ? (int)$data['apiID'] : 0;
            $apiName = isset($data['apiName']) ? (string)$data['apiName'] : '';
            $apiKey = isset($data['apiKey']) ? (string)$data['apiKey'] : '';

            // Create a new API object
            $api = new Api($apiID, $apiName, $apiKey);

            // Call the create method from the apiService
            $result = $this->apiService->create($api);

            // Check the result and set the appropriate response
            if ($result) {
                $response['message'] = "API created successfully.";
                $response['status'] = 1;
            } else {
                $response['message'] = "API creation failed.";
                $response['status'] = 0;
            }
        });
    }
    public function apiUpdate()
    {
        $this->handleRequest(function ($data, &$response) {
            // Get the data from the request
            $apiID = isset($data['apiID']) ? (int)$data['apiID'] : 0;
            $apiName = isset($data['apiName']) ? (string)$data['apiName'] : '';
            $apiKey = isset($data['apiKey']) ? (string)$data['apiKey'] : '';

            // Create a new API object
            $api = new Api($apiID, $apiName, $apiKey);

            // Call the update method from the apiService
            $result = $this->apiService->update($api);

            // Check the result and set the appropriate response
            if ($result) {
                $response['message'] = "API updated successfully.";
                $response['status'] = 1;
            } else {
                $response['message'] = "API update failed.";
                $response['status'] = 0;
            }
        });
    }
    public function apiDelete()
    {
        $this->handleRequest(function ($data, &$response) {
            // Get the apiID from the request
            $apiID = isset($data['apiID']) ? (int)$data['apiID'] : 0;
            // Call the delete method from the apiService
            $result = $this->apiService->delete($apiID);

            // Check the result and set the appropriate response
            if ($result) {
                $response['message'] = "API deleted successfully.";
                $response['status'] = 1;
            } else {
                $response['message'] = "API deletion failed.";
                $response['status'] = 0;
            }
        });
    }
    public function user()
    {
        $models = [
            "users" => $this->accountService->getAllUsers(),
        ];
        $this->displayView($models);
    }

    public function createUser()
    {
        $this->handleRequest(function ($data, &$response) {
            // Get the data from the request
            $userEmail = isset($data['userEmail']) ? (string)$data['userEmail'] : '';
            $userRole = isset($data['userRole']) ? (string)$data['userRole'] : '';
            $userFullName = isset($data['userFullName']) ? (string)$data['userFullName'] : '';
            $userPhoneNumber = isset($data['userPhoneNumber']) ? (string)$data['userPhoneNumber'] : '';
            $userPassword = isset($data['userPassword']) ? (string)$data['userPassword'] : '';

            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            // Create a new User object
            $user = new User($userFullName, $userRole, $userEmail, $userPhoneNumber, $hashedPassword);

            // Call the create method from the userService
            $result = $this->accountService->createUser($user);

            // Check the result and set the appropriate response
            if ($result) {
                $response['message'] = "User created successfully.";
                $response['success'] = 1;
            } else {
                $response['message'] = "User creation failed.";
                $response['success'] = 0;
            }
        });
    }

    public function updateUser()
    {
        $this->handleRequest(function ($data, &$response) {
            // Get the data from the request
            $userId = isset($data['userId']) ? (int)$data['userId'] : 0;
            $userEmail = isset($data['userEmail']) ? (string)$data['userEmail'] : '';
            $userRole = isset($data['userRole']) ? (string)$data['userRole'] : '';
            $userFullName = isset($data['userFullName']) ? (string)$data['userFullName'] : '';
            $userPhoneNumber = isset($data['userPhoneNumber']) ? (string)$data['userPhoneNumber'] : '';
            $userPassword = isset($data['userPassword']) ? (string)$data['userPassword'] : '';

            // Create a new User object
            $user = new User($userFullName, $userRole, $userEmail, $userPhoneNumber, $userPassword, $userId);

            // Call the update method from the userService
            $result = $this->accountService->updateUser($user);

            // Check the result and set the appropriate response
            if ($result) {
                $response['message'] = "User updated successfully.";
                $response['success'] = 1;
            } else {
                $response['message'] = "User update failed.";
                $response['success'] = 0;
            }
        });
    }

    public function deleteUser()
    {
        $this->handleRequest(function ($data, &$response) {
            // Get the data from the request
            $userId = isset($data['userId']) ? (int)$data['userId'] : 0;

            error_log($data['userId']);

            // Call the delete method from the userService
            $result = $this->accountService->deleteUser($userId);

            // Check the result and set the appropriate response
            if ($result) {
                $response['message'] = "User deleted successfully.";
                $response['success'] = 1;
            } else {
                $response['message'] = "User deletion failed.";
                $response['success'] = 0;
            }
        });
    }

    public function jazz()
    {
        $models = [
            "artists" => $this->jazzService->getAllArtists(),
            "locations" => $this->jazzService->getAllLocations(),
            "halls" => $this->jazzService->getAllHalls(),
            "timeSlotsJazz" => $this->jazzService->getAllTimeSlots(),
        ];
        $this->displayView($models);
    }
    private function handleRequest($action)
    {
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

    public function updateArtist()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->updateArtistService($data);
        });
    }
    public function deleteArtist()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->deleteArtistService($data);
        });
    }

    public function createArtist()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->createArtistService($data);
        });
    }

    public function updateLocation()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->updateLocationService($data);
        });
    }

    public function deleteLocation()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->deleteLocationService($data);
        });
    }

    public function createLocation()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->createLocationService($data);
        });
    }

    public function updateTimeslot()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->updateTimeslotService($data);
        });
    }
    public function createTimeSlot()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->createTimeSlotService($data);
        });
    }

    public function deleteTimeslot()
    {
        $this->handleRequest(function ($data, &$response) {
            $response['message'] = $this->jazzService->deleteTimeslotService($data);
        });
    }




    // Yummy -------------------------------------
    // Call yummy info
    public function yummy()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
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
            $_POST['editReservationNumberAdults'],
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
