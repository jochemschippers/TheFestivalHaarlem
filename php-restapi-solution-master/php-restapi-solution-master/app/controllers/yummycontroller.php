<?php
require __DIR__ . '/controller.php';
include_once __DIR__ . '/../services/yummyservice.php';

class YummyController extends Controller
{

    private $yummyService;

    // initialize services
    function __construct()
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
        if (isset($_GET['restaurantId'])) {

            $restaurantId = $_GET['restaurantId'];
            $models = [
                "restaurantId" => $restaurantId,
                "timeSlots" => $this->yummyService->getAllTimeSlots(),
                "images" => $this->yummyService->getImages($restaurantId),
                "restaurant" => $this->yummyService->getOne($restaurantId),
                "menuItems" => $this->yummyService->getMenuItems($restaurantId),
                "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
                "timeSlotsYummy" => $this->yummyService->getRestaurantReservationInfo($restaurantId),
                "restaurantReservations" => $this->yummyService->getAllRestaurantReservations(),
            ];
            $this->displayView($models);
        }
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST)) {
            // var_dump($_POST);
            if (isset($_POST['btnradio'], $_POST['customerName'], $_POST['phoneNr'], $_POST['nrAdult'], $_POST['nrChild'], $_POST['remark'])) { //if posts then

                // create a DateTime object for the start time
                $timeSlot = $_POST['btnradio'];
                $customerName = $_POST['customerName'];
                $phoneNr = $_POST['phoneNr'];
                $nrAdult = $_POST['nrAdult'];
                $nrChild = $_POST['nrChild'];
                $remark = $_POST['remark'];

                if ($this->createReservation($restaurantId, $timeSlot, $customerName, $phoneNr, $nrAdult, $nrChild, $remark)) {
                    // HIER EEN POPUP MELDING TONEN IS GESLAAGD
                    // if reservation is created successfully
                    echo "<script>alert('Reservation created successfully!')</script>";
                } else {
                    // HIER MELDEN DAT EEN WAARDE VERKEERD INGEVULD IS. OF DAT ER EEN ERROR IS
                    // if reservation creation fails
                    echo "<script>alert('Failed to create reservation. Please check your inputs and try again.')</script>";
                }
            }
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
        // retrieve data
        return $this->yummyService->getAll();
    }

    public function getOne($restaurantId)
    {
        // retrieve data
        return $this->yummyService->getOne($restaurantId);
    }

    public function getMenuItems($restaurantId)
    {
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

        $reservation = [
            'ticketID' => 0,
            'timeSlotId' => $timeSlotId,
            'restaurantId' => $restaurantId,
            'customerName' => $customerName,
            'phoneNr' => $phoneNr,
            'nrAdult' => $nrAdult,
            'nrChild' => $nrChild,
            'remark' => $remark,
            'isActive' => true
        ];

        // call the createRestaurant method of the YummyService object with the restaurant object as the parameter
        if ($this->yummyService->createReservation($reservation)) {
            return true;
        } else {
            return false;
        }
    }
}
