<?php

class RestaurantMenuItem{
    
        private int $menuItemID;
        private int $restaurantID;
        private int $courseID;
        private string $name;
        private string $description;
        private float $price;
        private int $foodType;


        public function __construct(int $menuItemID, int $restaurantID, int $courseID, string $name, string $description, float $price, int $foodType){
            $this->menuItemID = $menuItemID;
            $this->restaurantID = $restaurantID;
            $this->courseID = $courseID;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->foodType = $foodType;
        }
}

?>