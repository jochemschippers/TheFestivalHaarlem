<?php
require_once __DIR__ . '/../repositories/yummyrepository.php';

class YummyService {
    public function getAll() {
        // retrieve data
        $repository = new YummyRepository();
        return $repository->getAll();
    }

    public function getOne($restaurantId) {
        // retrieve data
        $repository = new YummyRepository();
        return $repository->getOne($restaurantId);
    }

    public function getMenuItems($restaurantId){
       // retrieve data
       $repository = new YummyRepository();
       return $repository->getMenuItems($restaurantId);
    }
    public function getAllImages(){
        // retrieve data
        $repository = new YummyRepository();
        return $repository->getAllImages();
    }
    public function getImages($restaurantId){
        // retrieve data
        $repository = new YummyRepository();
        return $repository->getImages($restaurantId);
    }
    public function getFoodTypes(){
        $repository = new YummyRepository();
        return $repository->getFoodTypes();
    }
    public function getRestaurantFoodTypes(){
        // retrieve data
        $repository = new YummyRepository();
        return $repository->getRestaurantFoodTypes();
    }    
}

?>