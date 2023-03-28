<?php

class StrollThroughHistoryDetailpage{
    
        private int $landmarkID;
        private string $description;
        private string $image;
        private string $scheduleDescription;


        public function __construct(int $landmarkID, string $description, string $image, string $scheduleDescription){
            $this->landmarkID = $landmarkID;
            $this->description = $description;
            $this->image = $image;
            $this->scheduleDescription = $scheduleDescription;
        }
}

?>