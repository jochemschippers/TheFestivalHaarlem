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
	 * @return DateTime
	 */
	public function getEndTime(): DateTime {
		return $this->endTime;
	}
	
	/**
	 * @param DateTime $endTime 
	 * @return self
	 */
	public function setEndTime(DateTime $endTime): self {
		$this->endTime = $endTime;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getEventID(): int {
		return $this->eventID;
	}
	
	/**
	 * @param int $eventID 
	 * @return self
	 */
	public function setEventID(int $eventID): self {
		$this->eventID = $eventID;
		return $this;
	}
}

?>