<?php
require_once __DIR__ . '/../repositories/yummyrepository.php';

class YummyService
{
    private $repository;
    function __construct()
    {
        $this->repository = new YummyRepository();
    }

    public function getAll()
    {
        // retrieve data
        return $this->repository->getAll();
    }

    public function getOne($restaurantId)
    {
        // retrieve data
        return $this->repository->getOne($restaurantId);
    }

    public function getAllMenuItems()
    {
        // retrieve data
        return $this->repository->getAllMenuItems();
    }

    public function getMenuItems($restaurantId)
    {
        // retrieve data
        return $this->repository->getMenuItems($restaurantId);
    }
    public function getAllImages()
    {
        // retrieve data
        return $this->repository->getAllImages();
    }
    public function getImages($restaurantId)
    {
        // retrieve data
        return $this->repository->getImages($restaurantId);
    }
    public function getFoodTypes()
    {
        return $this->repository->getAllFoodTypes();
    }
    public function getAllRestaurantFoodTypes()
    {
        // retrieve data
        return $this->repository->getAllRestaurantFoodTypes();
    }
    public function getRestaurantReservationInfo($restaurantId){
        // Retrieve data from both models
        return $this->repository->getRestaurantReservationInfo($restaurantId);
    }
    public function createReservation($reservation){

        // creates a new restaurant
        return $this->repository->createReservation($reservation);
    }

    // -------------------  Administrator  ----------------------

    public function createRestaurant($restaurant)
    {
        // creates a new restaurant
        $this->repository->createRestaurant($restaurant);
    }

    public function updateRestaurant($update)
    {
        // this updates a existing restaurant
        $this->repository->updateRestaurant($update);
    }

    public function deleteRestaurant($delete)
    {
        // this will delete a existing restaurant
        $this->repository->deleteRestaurant($delete);
    }

    // --------------- TimeSlotsYummy ------------

    public function getAllTimeSlotsYummy(){
        return $this->repository->getAllTimeSlotsYummy();
    }

}

?>