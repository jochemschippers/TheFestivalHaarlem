<?php

class TimeSlotsJazz extends TimeSlot{
    
        private int $artistID;
        private int $hallID;


        public function __construct(int $timeSlotID, int $eventID, float $priceID, DateTime $startTime, DateTime $endTime, int $maximmumAmountTickets, int $artistID, int $hallID) {
            parent::__construct($timeSlotID, $eventID, $priceID, $startTime, $endTime, $maximmumAmountTickets);
            $this->artistID = $artistID;
            $this->hallID = $hallID;
        }
        public function getArtistID(): int {
            return $this->artistID;
        }
        public function setArtistID(int $artistID): void {
            $this->artistID = $artistID;
        }
    
        public function getHallID(): int {
            return $this->hallID;
        }
    
        public function setHallID(int $hallID): void {
            $this->hallID = $hallID;
        }
}

?>