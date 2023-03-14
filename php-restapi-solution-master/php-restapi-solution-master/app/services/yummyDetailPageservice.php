<?php
require_once __DIR__ . '/../repositories/yummyDetailPagerepository.php';

class YummyDetailPageService {
    public function getAll() {
        // retrieve data
        $repository = new YummyDetailPageRepository();
        return $repository->getAll();
    }

    public function getOne($restaurantId) {
        // retrieve data
        $repository = new YummyDetailPageRepository();
        return $repository->getOne($restaurantId);
    }

    public function getMenuItems($restaurantId){
       // retrieve data
       $repository = new YummyDetailPageRepository();
       return $repository->getMenuItems($restaurantId);
    }
    public function getAllImages(){
        // retrieve data
        $repository = new YummyDetailPageRepository();
        return $repository->getAllImages();
    }
    public function getImages($restaurantId){
        // retrieve data
        $repository = new YummyDetailPageRepository();
        return $repository->getImages($restaurantId);
    }
    public function getFoodTypes(){
        // retrieve data
        $repository = new YummyDetailPageRepository();
        return $repository->getFoodTypes();
    }    
}

?>