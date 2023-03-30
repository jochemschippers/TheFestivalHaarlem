<?php
require_once __DIR__ . '/../services/eventservice.php';
class Controller
{
    private $eventService;
    function __construct()
    {
    }
    function displayView($models)
    {
        $eventService = new EventService();
        $events = $eventService->getAll();
        include __DIR__ . '/../views/navbar.php';
        foreach ($models as $key => $value) {
            ${$key} = $value;
        }
        $directory = substr(get_class($this), 0, -10);
        $view = debug_backtrace()[1]['function'];
        require __DIR__ . "/../views/$directory/$view.php";
        include __DIR__ . '/../views/footer.php';
    }
}
