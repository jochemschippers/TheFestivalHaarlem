<?php

class TimeSlot{
    
        private int $timeSlotID;
        private int $eventID;
        private float $priceID;
        private DateTime $startTime;
        private DateTime $endTime;
        private int $maximmumAmountTickets;


        public function __construct(int $timeSlotID, int $eventID, float $priceID, DateTime $startTime, DateTime $endTime, int $maximmumAmountTickets){
            $this->timeSlotID = $timeSlotID;
            $this->eventID = $eventID;
            $this->priceID = $priceID;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->maximmumAmountTickets = $maximmumAmountTickets;
        }
}

?>