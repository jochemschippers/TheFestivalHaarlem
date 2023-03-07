<?php
require __DIR__ . '/../repositories/historyrepository.php';


class HistoryService {
    private $repository;
    function __construct()
    {
        $this->repository = new HistoryRepository();
    }
    public function insert($history) {
        // retrieve data
        $repository = new HistoryRepository();
        $repository->insert($history);        
    }
}

?>
