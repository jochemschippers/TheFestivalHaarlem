<?php
require __DIR__ . '/../repositories/historyrepository.php';


class UserService {
    private $repository;
    function __construct()
    {
        $this->repository = new UserRepository();
    }
    public function login() {
        $this->repository->login();
    }
}

?>