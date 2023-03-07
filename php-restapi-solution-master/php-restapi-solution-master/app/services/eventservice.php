<?php
require __DIR__ . '/../repositories/eventrepository.php';


class EventService {
    public function getAll() {
        // retrieve data
        $repository = new EventRepository();
        $articles = $repository->getAll();
        return $articles;
    }
}

?>