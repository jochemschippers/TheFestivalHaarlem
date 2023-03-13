<?php

class TimeSlot{
    
        private int $timeSlotID;
        private int $eventID;
        private float $price;
        private DateTime $startTime;
        private DateTime $endTime;
        private int $maximmumAmountTickets;


        public function __construct(int $timeSlotID, int $eventID, float $price, DateTime $startTime, DateTime $endTime, int $maximmumAmountTickets){
            $this->timeSlotID = $timeSlotID;
            $this->eventID = $eventID;
            $this->price = $price;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->maximmumAmountTickets = $maximmumAmountTickets;
        }

        /**
         * Get the value of startTime
         */ 
        public function getStartTime()
        {
                return $this->startTime;
        }

        /**
         * Set the value of startTime
         *
         * @return  self
         */ 
        public function setStartTime($startTime)
        {
                $this->startTime = $startTime;

                return $this;
        }
}

?>