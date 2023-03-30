<?php
require __DIR__ . '/../repositories/accountrepository.php';


class AccountService {
    private $repository;
    function __construct()
    {
        $this->repository = new AccountRepository();
    }
    public function login() {
        $this->repository->login();
    }

    public function register($fullname, $password, $email, $role, $phoneNumber) {
        if($this->repository->checkEmailExists($email))
        {
            throw new ErrorException("This email is already linked to an account! Please try to log in.");
        }
        else{
            $this->repository->register($fullname, password_hash($password, PASSWORD_DEFAULT), $email, $role, $phoneNumber);
        }
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

    // public function updateUser($userID, $username, $password, $email, $role) {
    //     $this->repository->updateUser($userID, $username, $password, $email, $role);
    // }

    public function deleteUser($userID) {
        $this->repository->deleteUser($userID);
    }
    
}
