<?php

class RestaurantFoodType{
    
        private int $menuItemID;
        private int $restaurantID;


        public function __construct(int $menuItemID, int $restaurantID){
            $this->menuItemID = $menuItemID;
            $this->restaurantID = $restaurantID;
        }
}

?>