<?php

class TimeSlot implements JsonSerializable
{

        private int $timeSlotID;
        private int $eventID;
        private float $price;
        private DateTime $startTime;
        private DateTime $endTime;
        private int $maximumAmountTickets;
        private int $currentlyBoughtTickets;
        private int $quantity;
        //made all options possible to be null. This is done so the Yummy page doesn't crash. The yummy admin page requires a timeslot that has different variables that are null
        public function __construct(?int $timeSlotID = null, ?int $eventID = null, ?float $price = null, ?DateTime $startTime = null, ?DateTime $endTime = null, ?int $maximumAmountTickets = null)
        {
                $this->timeSlotID = $timeSlotID ?? 0;
                $this->eventID = $eventID ?? 0;
                $this->price = $price ?? 0.0;
                $this->startTime = $startTime ?? new DateTime();
                $this->endTime = $endTime ?? new DateTime();
                $this->maximumAmountTickets = $maximumAmountTickets ?? 0;
                $this->quantity = 0;
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
                if(getType($startTime) === 'string'){
                        $this->startTime = DateTime::createFromFormat('Y-m-d H:i:s', $startTime);
                }else{
                        $this->startTime = $startTime;
                }

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
                if(getType($endTime) === 'string'){
                        $this->endTime = DateTime::createFromFormat('Y-m-d H:i:s', $endTime);
                }else{
                        $this->endTime = $endTime;
                }
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
        public function jsonSerialize(): array
        {
                return [
                        'timeSlotID' => $this->timeSlotID,
                        'eventID' => $this->eventID,
                        'price' => $this->price,
                        'startTime' => $this->startTime->format(DateTime::ATOM),
                        'endTime' => $this->endTime->format(DateTime::ATOM),
                        'maximumAmountTickets' => $this->maximumAmountTickets,
                        'quantity' =>$this->getQuantity(),
                        'currentlyBoughtTickets' => $this->currentlyBoughtTickets ?? 0
                ];
        }

        /**
         * Get the value of currentlyBoughtTickets
         */ 
        public function getCurrentlyBoughtTickets()
        {
                return $this->currentlyBoughtTickets;
        }

        /**
         * Set the value of currentlyBoughtTickets
         *
         * @return  self
         */ 
        public function setCurrentlyBoughtTickets($currentlyBoughtTickets)
        {
                $this->currentlyBoughtTickets = $currentlyBoughtTickets;

                return $this;
        }

        /**
         * Get the value of quantity
         */ 
        public function getQuantity()
        {
                return $this->quantity;
        }

        /**
         * Set the value of quantity
         *
         * @return  self
         */ 
        public function setQuantity($quantity)
        {
                $this->quantity = $quantity;

                return $this;
        }
}
