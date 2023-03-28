<?php

class eventTicket{
    
        private int $ticketID;
        private int $timeSlotID;
        private int $programID;

        public function __construct(int $ticketID, int $timeSlotID, int $programID){
            $this->ticketID = $ticketID;
            $this->timeSlotID = $timeSlotID;
            $this->programID = $programID;
        }

	/**
	 * @return int
	 */
	public function getTicketID(): int {
		return $this->ticketID;
	}
	
	/**
	 * @param int $ticketID 
	 * @return self
	 */
	public function setTicketID(int $ticketID): self {
		$this->ticketID = $ticketID;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getTimeSlotID(): int {
		return $this->timeSlotID;
	}
	
	/**
	 * @param int $timeSlotID 
	 * @return self
	 */
	public function setTimeSlotID(int $timeSlotID): self {
		$this->timeSlotID = $timeSlotID;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getProgramID(): int {
		return $this->programID;
	}
	
	/**
	 * @param int $programID 
	 * @return self
	 */
	public function setProgramID(int $programID): self {
		$this->programID = $programID;
		return $this;
	}
}

?>