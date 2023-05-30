<?php
require_once __DIR__ . '/../repositories/eventrepository.php';


class EventService {
    public function getAll() {
        // retrieve data
        $repository = new EventRepository();
        $events = $repository->getAll();
        return $events;
    }
}