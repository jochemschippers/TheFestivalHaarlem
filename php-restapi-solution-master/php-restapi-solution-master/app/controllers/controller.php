<?php
require_once __DIR__ . '/../services/eventservice.php';
class Controller
{
    private $eventService;
    private $events;
    function __construct()
    {
        $this->eventService = new EventService();
        $this->events = $this->eventService->getAll();
        $events = $this->events;

        include __DIR__ . '/../views/navbar.php';
    }
    function displayView($models)
    {
        foreach ($models as $key => $value) {
            ${$key} = $value;
        }
        $events = $this->events;
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        require __DIR__ . "/../views/$directory/$view.php";
        include __DIR__ . '/../views/footer.php';
    }
    function displayHome(){
        $events = $this->eventService->getAll();
        include __DIR__ . '/../views/navbar.php';
        require __DIR__ . "/../views/home/index.php";
        include __DIR__ . '/../views/footer.php';
    }
}
