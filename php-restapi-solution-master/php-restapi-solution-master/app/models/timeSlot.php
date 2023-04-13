<?php

class TimeSlot{
    
        private int $timeSlotID;
        private int $eventID;
        private float $price;
        private DateTime $startTime;
        private DateTime $endTime;
        private int $maximumAmountTickets;


        public function __construct(int $timeSlotID, int $eventID, float $price, DateTime $startTime, DateTime $endTime, int $maximumAmountTickets){
            $this->timeSlotID = $timeSlotID;
            $this->eventID = $eventID;
            $this->price = $price;
            $this->startTime = $startTime;
            $this->endTime = $endTime;
            $this->maximumAmountTickets = $maximumAmountTickets;
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
        /**
         * Get the value of endTime
         */ 
        public function getEndTime()
        {
                return $this->endTime;
        }

        /**
         * Set the value of endTime
         *
         * @return  self
         */ 
        public function setEndTime($endTime)
        {
                $this->endTime = $endTime;

                return $this;
        }

        /**
         * Get the value of maximmumAmountTickets
         */ 
        public function getMaximmumAmountTickets()
        {
                return $this->maximumAmountTickets;
        }

        /**
         * Set the value of maximmumAmountTickets
         *
         * @return  self
         */ 
        public function setMaximmumAmountTickets($maximmumAmountTickets)
        {
                $this->maximumAmountTickets = $maximmumAmountTickets;

                return $this;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
                $this->price = $price;

                return $this;
        }

        /**
         * Get the value of eventID
         */ 
        public function getEventID()
        {
                return $this->eventID;
        }

        /**
         * Set the value of eventID
         *
         * @return  self
         */ 
        public function setEventID($eventID)
        {
                $this->eventID = $eventID;

                return $this;
        }

        /**
         * Get the value of timeSlotID
         */ 
        public function getTimeSlotID()
        {
                return $this->timeSlotID;
        }

        /**
         * Set the value of timeSlotID
         *
         * @return  self
         */ 
        public function setTimeSlotID($timeSlotID)
        {
                $this->timeSlotID = $timeSlotID;

                return $this;
        }
}

?>