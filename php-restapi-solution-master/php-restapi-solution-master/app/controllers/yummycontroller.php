<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/yummyservice.php';

class YummyController extends Controller
{
    private $yummyService;

    // Initialize services
    public function __construct()
    {
        $this->yummyService = new YummyService();
    }

    public function index()
    {
        $this->checkPosts();
        $models = [
            "restaurants" => $this->yummyService->getAll(),
            "timeSlots" => $this->yummyService->getAllTimeSlots(),
            "foodTypes" => $this->yummyService->getFoodTypes(),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
            "allTimeSlotsYummy" => $this->yummyService->getAllRestaurantTimeSlotsYummy(),
        ];
        $this->displayView($models);
    }

    public function restaurant()
    {
        try {
            $this->checkPosts();
            if (isset($_GET['restaurantId'])) {
                // Sanitize the restaurant ID
                $restaurantId = filter_input(INPUT_GET, 'restaurantId', FILTER_SANITIZE_NUMBER_INT);

                // Get all necessary data for the view
                $models = [
                    "restaurantId" => $restaurantId,
                    "timeSlots" => $this->yummyService->getAllTimeSlots(),
                    "images" => $this->yummyService->getImages($restaurantId),
                    "restaurant" => $this->yummyService->getOne($restaurantId),
                    "menuItems" => $this->yummyService->getMenuItems($restaurantId),
                    "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
                    "restaurantReservations" => $this->yummyService->getAllRestaurantReservations(),
                    "timeSlotsYummy" => $this->yummyService->getRestaurantReservationInfo($restaurantId),
                ];
                // Display the view
                $this->displayView($models);
            } else {
                header("Location: /Yummy");
                exit();
            }
        } catch (Exception $e) {
            // Display an error message within the same view
            $models = [
                "errorMessage" => "Error: " . $e->getMessage(),
                "restaurantId" => $restaurantId, // Pass the restaurant ID to the view
            ];
            $this->displayView($models);
        }
    }


    public function YummyReservation()
    {
        $restaurantId = $_GET['restaurantId'];
        $models = [
            "restaurantId" => $restaurantId,
            "timeSlots" => $this->yummyService->getAllTimeSlots(),
            "restaurant" => $this->yummyService->getOne($restaurantId),
            "restaurantReservations" => $this->yummyService->getAllRestaurantReservations(),
            "timeSlotsYummy" => $this->yummyService->getRestaurantReservationInfo($restaurantId),
        ];

        $this->displayView($models);
    }

    private function checkPosts()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            // Set flag to indicate form submission
            // Sanitize and validate specific input fields
            $inputFields = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $customerName = filter_var($inputFields['customerName'], FILTER_SANITIZE_SPECIAL_CHARS);
            $phoneNr = filter_var($inputFields['phoneNr'], FILTER_SANITIZE_SPECIAL_CHARS);
            $nrAdult = filter_var($inputFields['nrAdult'], FILTER_SANITIZE_NUMBER_INT);
            $nrChild = filter_var($inputFields['nrChild'], FILTER_SANITIZE_NUMBER_INT);
            $remark = filter_var($inputFields['remark'], FILTER_SANITIZE_SPECIAL_CHARS);
            $timeSlot = filter_var($inputFields['btnradio'], FILTER_SANITIZE_NUMBER_INT);
            $restaurantId = filter_input(INPUT_GET, 'restaurantId', FILTER_SANITIZE_NUMBER_INT);
            if (isset($inputFields['restaurantId'])) {
                $restaurantId = filter_var($inputFields['restaurantId'], FILTER_SANITIZE_NUMBER_INT);
            }

            // Check if all required fields are present and valid
            if ($customerName && $this->checkPhoneNumber($phoneNr) && $nrAdult && isset($nrChild) && $timeSlot && $restaurantId) {
                // Inputs are valid, create reservation
                if ($this->createReservation($restaurantId, $timeSlot, $customerName, $phoneNr, $nrAdult, $nrChild, $remark)) {
                    $message = "<h2 class='fixed-bottom text-light bg-success rounded-2 text-center' id='successMessage'>Reservation created successfully!</h2>";
                } else {
                    $message = "<h2 class='fixed-bottom text-light bg-danger rounded-2 text-center' id='errorMessage'>Failed to create reservation. Please check your inputs and try again.</h2>";
                }
            } else {
                // Inputs are not valid, show error message
                $errorMsg = "Invalid input fields. Please check the following fields:";
                if (!$customerName) {
                    $errorMsg .= "- Customer name is invalid";
                }
                if (!$this->checkPhoneNumber($phoneNr)) {
                    $errorMsg .= "- Phone number is invalid";
                }
                if (!$nrAdult & $nrAdult > 20) {
                    $errorMsg .= "- Number of adults is invalid";
                }
                if ($nrChild > 20) {
                    $errorMsg .= "- Number of children is invalid";
                }
                if (strlen($remark) > 255) {
                    $errorMsg .= "- Remark is invalid";
                }
                if (!$timeSlot) {
                    $errorMsg .= "- Time slot is invalid";
                }
                if (!$restaurantId) {
                    $errorMsg .= "- Restaurant ID is invalid";
                }
                $message = "<h2 class='fixed-bottom text-light bg-danger rounded-2 text-center' id='errorMsg'>$errorMsg</h2>";
            }
            echo $message;
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

    public function getAll()
    {
        return $this->yummyService->getAll();
    }

    public function getOne($restaurantId)
    {
        return $this->yummyService->getOne($restaurantId);
    }

    public function getMenuItems($restaurantId)
    {
        return $this->yummyService->getMenuItems($restaurantId);
    }

    public function getAllImages()
    {
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
    public function getRestaurantFoodTypes()
    {
        // retrieve data
        return $this->yummyService->getAllRestaurantFoodTypes();
    }
    public function getAllTimeSlots()
    {
        // retrieve data
        return $this->yummyService->getAllTimeSlots();
    }
    public function getAllRestaurantTimeSlotsYummy(){
        return $this->yummyService->getAllRestaurantTimeSlotsYummy();
    }

    public function getRestaurantReservationInfo($restaurantId)
    {
        return $this->yummyService->getRestaurantReservationInfo($restaurantId);
    }

    public function createReservation($restaurantId, $timeSlotId, $customerName, $phoneNr, $nrAdult, $nrChild, $remark)
    {

        $reservation = new Restaurantreservation(
            0, // use 0 as the ID for a new reservation
            $timeSlotId,
            $restaurantId,
            $customerName,
            $phoneNr,
            $nrAdult,
            $nrChild,
            $remark,
            1
        );

        // call the createRestaurant method of the YummyService object with the restaurant object as the parameter
        if ($this->yummyService->createReservation($reservation)) {
            return true;
        } else {
            return false;
        }
    }
}
?>
<script src="../js/yummy/yummyController.js"></script>