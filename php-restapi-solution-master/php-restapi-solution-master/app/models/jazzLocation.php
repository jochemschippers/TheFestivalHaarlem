<?php

class JazzLocation{
    
        private int $locationID;
        private string $locationName;

        private string $address;
        private string $locationImage;
        private string $toAndFromText;
        private string $accesibillityText;


        public function __construct(int $locationID, string $locationName, string $address, string $locationImage, string $toAndFromText, string $accesibillityText){
            $this->locationID = $locationID;
            $this->locationName = $locationName;
            $this->address = $address;
            $this->locationImage = $locationImage;
            $this->toAndFromText = $toAndFromText;
            $this->accesibillityText = $accesibillityText;
        }

        /**
         * Get the value of accesibillityText
         */ 
        public function getAccesibillityText()
        {
                return $this->accesibillityText;
        }

        /**
         * Set the value of accesibillityText
         *
         * @return  self
         */ 
        public function setAccesibillityText($accesibillityText)
        {
                $this->accesibillityText = $accesibillityText;

                return $this;
        }

        /**
         * Get the value of toAndFromText
         */ 
        public function getToAndFromText()
        {
                return $this->toAndFromText;
        }

        /**
         * Set the value of toAndFromText
         *
         * @return  self
         */ 
        public function setToAndFromText($toAndFromText)
        {
                $this->toAndFromText = $toAndFromText;

                return $this;
        }

        /**
         * Get the value of locationImage
         */ 
        public function getLocationImage()
        {
                return $this->locationImage;
        }

        /**
         * Set the value of locationImage
         *
         * @return  self
         */ 
        public function setLocationImage($locationImage)
        {
                $this->locationImage = $locationImage;

                return $this;
        }

        /**
         * Get the value of address
         */ 
        public function getAddress()
        {
                return $this->address;
        }

        /**
         * Set the value of address
         *
         * @return  self
         */ 
        public function setAddress($address)
        {
                $this->address = $address;

                return $this;
        }

        /**
         * Get the value of locationName
         */ 
        public function getLocationName()
        {
                return $this->locationName;
        }

        /**
         * Set the value of locationName
         *
         * @return  self
         */ 
        public function setLocationName($locationName)
        {
                $this->locationName = $locationName;

                return $this;
        }

        /**
         * Get the value of locationID
         */ 
        public function getLocationID()
        {
                return $this->locationID;
        }

        /**
         * Set the value of locationID
         *
         * @return  self
         */ 
        public function setLocationID($locationID)
        {
                $this->locationID = $locationID;

                return $this;
        }
}
