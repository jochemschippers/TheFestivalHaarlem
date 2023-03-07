<?php

class TimeSlotsStrollThroughHistory{
    
        private int $timeSlotID;
        private int $languageID;
        private int $guideID;


        public function __construct(int $timeSlotID, int $languageID, int $guideID){
            $this->timeSlotID = $timeSlotID;
            $this->languageID = $languageID;
            $this->guideID = $guideID;
        }
}

?>