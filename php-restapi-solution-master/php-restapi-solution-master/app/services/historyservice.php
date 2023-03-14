<?php
require __DIR__ . '/../repositories/historyrepository.php';


class HistoryService 
{
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
    
    public function getAll() {
        // retrieve data
        $repository = new HistoryRepository();
        $history = $repository->getAll();
        return $history;
    }

    public function get($historyID) {
        // retrieve data
        $repository = new HistoryRepository();
        $history = $repository->get($historyID);
        return $history;
    }

    public function update($history) {
        // retrieve data
        $repository = new HistoryRepository();
        $repository->update($history);
    }

    public function delete($historyID) {
        // retrieve data
        $repository = new HistoryRepository();
        $repository->delete($historyID);
    }
}
?>
