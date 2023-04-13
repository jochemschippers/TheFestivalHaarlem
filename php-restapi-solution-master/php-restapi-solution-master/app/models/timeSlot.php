<?php

class TimeSlot{
    
        private int $timeSlotID;
        private int $eventID;
        private float $price;
        private DateTime $startTime;
        private DateTime $endTime;
        private int $maximumAmountTickets;

        //made all options possible to be null. This is done so the Yummy page doesn't crash. The yummy admin page requires a timeslot that has different variables that are null
        public function __construct(?int $timeSlotID = null, ?int $eventID = null, ?float $price = null, ?DateTime $startTime = null, ?DateTime $endTime = null, ?int $maximumAmountTickets = null)
        {
            $this->timeSlotID = $timeSlotID ?? 0;
            $this->eventID = $eventID ?? 0;
            $this->price = $price ?? 0.0;
            $this->startTime = $startTime ?? new DateTime();
            $this->endTime = $endTime ?? new DateTime();
            $this->maximumAmountTickets = $maximumAmountTickets ?? 0;
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

        /**
         * Get the value of maximumAmountTickets
         */ 
        public function getMaximumAmountTickets()
        {
                return $this->maximumAmountTickets;
        }

        /**
         * Set the value of maximumAmountTickets
         *
         * @return  self
         */ 
        public function setMaximumAmountTickets($maximumAmountTickets)
        {
                $this->maximumAmountTickets = $maximumAmountTickets;

                return $this;
        }
}

?>