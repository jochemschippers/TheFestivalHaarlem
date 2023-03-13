<?php

class JazzaArtist{
    
        private int $artistID;
        private string $description;
        private string $image;
        private string $name;
        private array $timeSlots;
        

        public function __construct(int $artistID, string $description, string $image, string $name){
            $this->artistID = $artistID;
            $this->description = $description;
            $this->image = $image;
            $this->name = $name;
            $this->timeSlots = array();
        }
}

?>