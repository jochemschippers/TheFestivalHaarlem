<?php
require_once __DIR__ . '/../repositories/yummyrepository.php';

class YummyService
{
    private $repository;
    function __construct()
    {
        try {
            $this->repository = new YummyRepository();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            // retrieve data
            return $this->repository->getAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getOne($restaurantId)
    {
        try {
            // retrieve data
            return $this->repository->getOne($restaurantId);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getAllMenuItems()
    {
        try {
            // retrieve data
            return $this->repository->getAllMenuItems();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getMenuItems($restaurantId)
    {
        try {
            // retrieve data
            return $this->repository->getMenuItems($restaurantId);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getAllImages()
    {
        try {
            // retrieve data
            return $this->repository->getAllImages();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getImages($restaurantId)
    {
        try {
            // retrieve data
            return $this->repository->getImages($restaurantId);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getFoodTypes()
    {
        try {
            // retrieve data
            return $this->repository->getAllFoodTypes();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getAllRestaurantFoodTypes()
    {
        try {
            // retrieve data
            return $this->repository->getAllRestaurantFoodTypes();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getAllRestaurantReservations()
    {
        try {
            // retrieve data
            return $this->repository->getAllRestaurantReservations();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllTimeSlots()
    {
        try {
            // retrieve data
            return $this->repository->getAllTimeSlots();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getAllRestaurantTimeSlotsYummy()
    {
        try {
            // retrieve data
            return $this->repository->getAllRestaurantTimeSlotsYummy();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getRestaurantReservationInfo($restaurantId)
    {
        try {
            // retrieve data
            return $this->repository->getRestaurantReservationInfo($restaurantId);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    

    // -------------------  Administrator  ----------------------

    // CRUD YUMMY RESTAURANTS
    public function createRestaurant($restaurant)
    {
        try {
            // creates a new restaurant
            $this->repository->createRestaurant($restaurant);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function updateRestaurant($update)
    {
        try {
            // this updates a existing restaurant
            $this->repository->updateRestaurant($update);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function deleteRestaurant($delete)
    {
        try {
            // this will delete a existing restaurant
            $this->repository->deleteRestaurant($delete);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    // END CRUD YUMMY RESTAURANTS

    // CRUD YUMMY RESERVATIONS
    public function createReservation($reservation)
    {
        try {
            // creates a new restaurant
            $this->repository->createReservation($reservation);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function editReservation($update)
    {
        try {
            // this updates a existing reservation
            $this->repository->editReservation($update);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function activateReservation($activate)
    {
        try {
            // this will activate a existing reservation
            $this->repository->activateReservation($activate);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function deactivateReservation($deactivate)
    {
        try {
            // this will deactivate a existing reservation
            $this->repository->deactivateReservation($deactivate);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    // END CRUD YUMMY RESERVATIONS

    // --------------- TimeSlotsYummy ------------

    public function getAllTimeSlotsYummy()
    {
        try {
            // retrieve data
            return $this->repository->getAllTimeSlotsYummy();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
