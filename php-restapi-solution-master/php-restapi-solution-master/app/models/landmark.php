<?php

class Landmark{
    
        private int $landmarkID;
        private string $title;
        private string $description;
        private string $image;


        public function __construct(int $landmarkID, string $title, string $description, string $image)
        {
            $this->landmarkID = $landmarkID;
            $this->title = $title;
            $this->description = $description;
            $this->image = $image;
        }

        public function getLandmarkID()
        {
          return $this->landmarkID;
        }

        public function setLandmarkID($landmarkID)
        {
          $this->landmarkID = $landmarkID;
          return $this;
        }

        public function getTitle() {
          return $this->title;
        }

        public function setTitle($title) {
          $this->title = $title;
        }

        public function getDescription() {
          return $this->description;
        }

        public function setDescription($description) {
          $this->description = $description;
        }

        public function getImage() {
          return $this->image;
        }

        public function setImage($image) {
          $this->image = $image;
        }
    }
?>