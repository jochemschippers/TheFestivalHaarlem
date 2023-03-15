<?php
require __DIR__ . '/../repositories/userrepository.php';


class UserService {
    private $repository;
    function __construct()
    {
        $this->repository = new UserRepository();
    }
    public function login() {
        $this->repository->login();
    }

    public function register() {
        $this->repository->register();
    }

    public function logout() {
        $this->repository->logout();
    }

    public function getUser($userID) {
        return $this->repository->getUser($userID);
    }

    public function getAllUsers() {
        return $this->repository->getAllUsers();
    }

    public function updateUser($userID, $username, $password, $email, $role) {
        $this->repository->updateUser($userID, $username, $password, $email, $role);
    }

    public function deleteUser($userID) {
        $this->repository->deleteUser($userID);
    }
    
}

?>