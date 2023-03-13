<?php
require_once __DIR__ . '/../services/eventservice.php';

class EventController{
    private $eventService; 
    function __construct() {
        $this->eventService = new EventService();
    }
    public function getEvents(){
        return $this->eventService->getAll();
    }

}
?>