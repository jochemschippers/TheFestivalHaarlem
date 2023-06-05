<?php 
require_once __DIR__ . '/../repositories/apirepository.php';

class ApiService {

    private $repository;

    function __construct() {
        $this->repository = new ApiRepository();
    }

    public function getAll() {
        // retrieve data
        return $this->repository->getAll();
    }
    public function getMollie(){
        return $this->repository->getMollie();
    }
    public function create($data) {
        // retrieve data
        return $this->repository->create($data);
    }
    public function update($data) {
        // retrieve data
        return $this->repository->update($data);
    }
    public function delete($data) {
        // retrieve data
        return $this->repository->delete($data);
    }
}