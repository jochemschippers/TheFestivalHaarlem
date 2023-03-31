<?php
require __DIR__ . '/../repositories/accountrepository.php';


class AccountService {
    private $repository;
    function __construct()
    {
        $this->repository = new AccountRepository();
    }
    public function login($email, $password) {
        $current_time = date("H:i:s");
        $encryptedPassword = $this->repository->getPasswordByEmail($email);
        //checks if repository fetched something or checks if the password can be verified
        if($encryptedPassword == false || !password_verify($password, $encryptedPassword["password"])){
            throw new ErrorException("incorrect email or password! <br>Current time: {$current_time}");
        }
        else {
            $user = $this->repository->getUser($email);
            return $user;
        }
    }
    public function register($fullname, $password, $email, $role, $phoneNumber) {
        if($this->repository->checkEmailExists($email))
        {
            throw new ErrorException("This email is already linked to an account! Please try to log in.");
        }
        else if(!$this->isPasswordDistinct($password,$fullname,$email))
        {
            throw new ErrorException("Password is too similair to email or fullname! Please choose a more secure password.");
        }
        else if (!$this->isValidPhoneNumber($phoneNumber)){
            throw new ErrorException("The phone format does not seem correct. Please try to adjust.");
        }
        else{
            $this->repository->register($fullname, password_hash($password, PASSWORD_DEFAULT), $email, $role, $phoneNumber);
        }
    }
    private function isValidPhoneNumber($phoneNumber) {
        $pattern = '/^(?:\+\d{1,3}\s?)?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,9}$/';
        return preg_match($pattern, $phoneNumber) === 1;
    }
    private function isPasswordDistinct($password, $fullName, $email) {
        $similarityThreshold = 70;
        similar_text(strtolower($password), strtolower($fullName), $nameSimilarity);
        similar_text(strtolower($password), strtolower($email), $emailSimilarity);
        
        // Check if both similarities are below the defined threshold.
        return $nameSimilarity < $similarityThreshold && $emailSimilarity < $similarityThreshold;
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
