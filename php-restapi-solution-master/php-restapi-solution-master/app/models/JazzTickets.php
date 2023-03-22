<?php
class JazzTickets {
    public $ticketID;
    public $startTime;
    public $endTime;
    public $artistName;
    public $locationName;
    public $hallID;

    public function __construct($ticketID, $startTime, $endTime, $artistName, $locationName, $hallID) {
        $this->ticketID = $ticketID;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->artistName = $artistName;
        $this->locationName = $locationName;
        $this->hallID = $hallID;
    }
    public function getTicketID()
        {
                return $this->ticketID;
        }
    public function getArtistName(){
        return $this->artistName;
    }
}
?>