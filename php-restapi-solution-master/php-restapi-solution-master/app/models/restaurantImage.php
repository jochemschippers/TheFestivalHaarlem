<?php

class RestaurantImage{
    
        private int $imageID;
        private int $restaurantID;
        private string $imageLink;
        private int $imageIndex;


        public function __construct(int $imageID, int $restaurantID, string $imageLink, int $imageIndex){
            $this->imageID = $imageID;
            $this->restaurantID = $restaurantID;
            $this->imageLink = $imageLink;
            $this->imageIndex = $imageIndex;
        }
}

?>