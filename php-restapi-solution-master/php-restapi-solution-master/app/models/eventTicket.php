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
}

?>