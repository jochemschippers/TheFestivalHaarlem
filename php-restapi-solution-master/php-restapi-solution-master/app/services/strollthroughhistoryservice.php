<?php
require __DIR__ . '/../repositories/strollthroughhistoryrepository.php';


class HistoryService 
{
    private $repository;

    function __construct()
    {
        $this->repository = new HistoryRepository();
    }

    public function insert($history) {
        $this->repository->insert($history);        
    }
    
    public function getAll() {
        // retrieve data
        return $this->repository->getAll();
    }

    public function get($historyID) {
        return $this->repository->get($historyID);
    }

    public function update($history) {
        $this->repository->update($history);
    }

    public function delete($historyID) {
        $this->repository->delete($historyID);
    }
}
?>
