<?php
require __DIR__ . '/controller.php';
include_once __DIR__ . '/../services/yummyservice.php';

class YummyController extends Controller
{

    private $yummyService;

    // initialize services
    function __construct()
    {
        parent::__construct();
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

        $restaurantId = $_GET['restaurantId'];
        $models = [
            "restaurantId" => $restaurantId,
            "restaurant" => $this->yummyService->getOne($restaurantId),
            "menuItems" => $this->yummyService->getMenuItems($restaurantId),
            "images" => $this->yummyService->getImages($restaurantId),
            "restaurantFoodTypes" => $this->yummyService->getAllRestaurantFoodTypes(),
        ];

        $this->displayView($models);
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

    public function createReservation()
    {
        // private int $timeSlotID; //key
        // private int $restaurantID;
        // private string $customerName;
        // private string $phoneNumber;
        // private int $numberAdults;
        // private int $numberChildren;
        // private string $remark;

        // check if all the required POST parameters are set
        if (
            isset($_POST['btnradio'], $_POST['restaurantID'], $_POST['customerName'], $_POST['phoneNr'],
            $_POST['nrAdult'], $_POST['nrChild'], $_POST['remark'])
        ) {

            // create a DateTime object for the start time
            // $timeSlot = new DateTime($_POST['timeSlotID']);

            // create a new YummyRestaurant object with the required parameters
            $reservation = new RestaurantReservation(
                $_POST['btnradio'],
                $_POST['restaurantID'],
                $_POST['customerName'],
                $_POST['phoneNr'],
                $_POST['nrAdult'],
                $_POST['nrChild'],
                $_POST['remark'],
            );

            // create a new YummyService object
            $yummyService = new YummyService();

            // call the createRestaurant method of the YummyService object with the restaurant object as the parameter
            $yummyService->createReservation($reservation);
        } else {
            // handle the case where one or more POST parameters are missing
            echo "One or more required parameters are missing.";
        }
    }
}