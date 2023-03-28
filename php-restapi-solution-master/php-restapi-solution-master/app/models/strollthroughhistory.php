<?php

class StrollThroughHistory{
    
        private int $eventID;
        private int $landmarkID;
        private string $practicalDescription;
        private string $guideDescription;
        private string $scheduleDescription;
        private string $locationMap;


        public function __construct(int $eventID, int $landmarkID, string $practicalDescription, string $guideDescription, string $scheduleDescription, string $locationMap){
            $this->eventID = $eventID;
            $this->landmarkID = $landmarkID;
            $this->practicalDescription = $practicalDescription;
            $this->guideDescription = $guideDescription;
            $this->scheduleDescription = $scheduleDescription;
            $this->locationMap = $locationMap;
        }
}

?>