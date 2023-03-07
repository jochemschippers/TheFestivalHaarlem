<?php

class JazzLocation{
    
        private int $locationID;
        private string $address;
        private string $locationImage;
        private string $toAndFromText;
        private string $accesibillityText;


        public function __construct(int $locationID, string $address, string $locationImage, string $toAndFromText, string $accesibillityText){
            $this->locationID = $locationID;
            $this->address = $address;
            $this->locationImage = $locationImage;
            $this->toAndFromText = $toAndFromText;
            $this->accesibillityText = $accesibillityText;
        }
}

?>