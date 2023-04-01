<?php
require_once __DIR__ . '/../models/TimeSlot.php';

class TimeSlotsJazz extends TimeSlot{
    
        private int $artistID;
        private int $hallID;


        public function __construct(int $timeSlotID, int $eventID, float $price, string $startTime, string $endTime, int $maximmumAmountTickets, int $artistID, int $hallID) {
            parent::__construct($timeSlotID, $eventID, $price,  DateTime::createFromFormat('Y-m-d H:i:s', $startTime), DateTime::createFromFormat('Y-m-d H:i:s', $endTime), $maximmumAmountTickets);
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
