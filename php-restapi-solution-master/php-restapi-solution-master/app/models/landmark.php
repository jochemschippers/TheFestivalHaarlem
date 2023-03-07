<?php

class Landmark{
    
        private int $landmarkID;
        private string $title;
        private string $description;
        private string $image;


        public function __construct(int $landmarkID, string $title, string $description, string $image){
            $this->landmarkID = $landmarkID;
            $this->title = $title;
            $this->description = $description;
            $this->image = $image;
        }
}

?>