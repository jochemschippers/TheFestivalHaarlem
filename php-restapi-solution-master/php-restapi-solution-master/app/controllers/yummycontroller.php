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
        $models = [
            "restaurants" => $this->yummyService->getAll(),
            "foodTypes" => $this->yummyService->getFoodTypes(),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
        ];

        $this->displayView($models);
    }

    public function restaurant()
{
    if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
        // Sanitize all input fields
        $inputFields = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        // Sanitize and validate specific input fields
        $customerName = filter_var($inputFields['customerName'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phoneNr = filter_var($inputFields['phoneNr'], FILTER_SANITIZE_SPECIAL_CHARS);
        $nrAdult = filter_var($inputFields['nrAdult'], FILTER_SANITIZE_NUMBER_INT);
        $nrChild = filter_var($inputFields['nrChild'], FILTER_SANITIZE_NUMBER_INT);
        $remark = filter_var($inputFields['remark'], FILTER_SANITIZE_SPECIAL_CHARS);
        $timeSlot = filter_var($inputFields['btnradio'], FILTER_SANITIZE_NUMBER_INT);
        $restaurantId = filter_input(INPUT_GET, 'restaurantId', FILTER_SANITIZE_NUMBER_INT);
        
        // Check if all required fields are present and valid
        if ($customerName && $phoneNr && $nrAdult && $nrChild && $remark && $timeSlot && $restaurantId) {
            // Inputs are valid, create reservation
            if ($this->createReservation($restaurantId, $timeSlot, $customerName, $phoneNr, $nrAdult, $nrChild, $remark)) {
                echo "<script>alert('Reservation created successfully!')</script>";
            } else {
                echo "<script>alert('Failed to create reservation. Please check your inputs and try again.')</script>";
            }
        } else {
            // Inputs are not valid, show error message
            echo "<script>alert('Invalid input fields. Please check your inputs and try again.')</script>";
        }
    } else if (isset($_GET['restaurantId'])) {
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
    }
}

    public function YummyReservation()
    {
        $restaurantId = $_GET['restaurantId'];
        $models = [
            "restaurantId" => $restaurantId,
            "restaurant" => $this->yummyService->getOne($restaurantId)
        ];

        $this->displayView($models);
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

    public function getRestaurantReservationInfo()
    {
        $restaurantId = $_GET['restaurantId'];

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
