<?php

class YummyRestaurant{
    
        private int $restaurantID;
        private string $restaurantName;
        private string $address;
        private string $description;
        private int $amountOfStars;
        private string $bannerImage;
        private string $headChef;
        private DateTime $startTime;
        private DateTime $duration;
        private float $adultPrice;
        private float $childPrice;


        public function __construct(int $restaurantID, string $restaurantName, string $address, string $description, int $amountOfStars, string $bannerImage, string $headChef, DateTime $startTime, DateTime $duration, float $adultPrice, float $childPrice){
            $this->restaurantID = $restaurantID;
            $this->restaurantName = $restaurantName;
            $this->address = $address;
            $this->description = $description;
            $this->amountOfStars = $amountOfStars;
            $this->bannerImage = $bannerImage;
            $this->headChef = $headChef;
            $this->startTime = $startTime;
            $this->duration = $duration;
            $this->adultPrice = $adultPrice;
            $this->childPrice = $childPrice;
        }
}

?>