<?php

class TimeSlotsJazz{
    
        private int $timeSlotID;
        private int $artistID;
        private int $hallID;


        public function __construct(int $timeSlotID, int $artistID, int $hallID){
            $this->timeSlotID = $timeSlotID;
            $this->artistID = $artistID;
            $this->hallID = $hallID;
        }
}

?>