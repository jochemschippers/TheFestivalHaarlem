<?php
require_once __DIR__ . '/../services/eventservice.php';
class Controller
{

    function displayView($models)
    {
        $eventService = new EventService();
        $events = $eventService->getAll();
        include __DIR__ . '/../views/header.php';

        // Include admin navigation only for AdminController
        if ($this instanceof AdminController) {
            include __DIR__ . '/../views/admin/adminnav.php';
        }
        foreach ($models as $key => $value) {
            ${$key} = $value;
        }
        $directory = strtolower(substr(get_class($this), 0, -10));
        $view = strtolower(debug_backtrace()[1]['function']);
        require __DIR__ . "/../views/$directory/$view.php";
        include __DIR__ . '/../views/footer.php';
    }
}
