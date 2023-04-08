<?php
require __DIR__ . '/../repositories/accountrepository.php';


class AccountService {
    private $repository;
    function __construct()
    {
        $this->repository = new AccountRepository();
    }
    public function login($email, $password) {
        try{
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
        }catch(Exception $e){
            throw $e;
        }
        
    }
    public function register($fullname, $password, $email, $role, $phoneNumber) {
        try{
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
    }catch(Exception $e){
        throw $e;
    }
    }
    public function logout(){
        //was in controller, not sure if still works ^^

        //if user somehow tries to log out when user has no session. This prevents crash
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        header('Location: ' . $previousPage);
        exit();
    }
    private function isValidPhoneNumber($phoneNumber) {
        //Optionally starts with a '+' then 1 to 3 digits with possible space after it. 
        //Then, there may be a hyphen, dot, or open parenthesis followed by 1 to 4 digits, and a possible closing parenthesis, hyphen, or dot. this repeats for up to four times
        //Finally, there may be a hyphen, dot, or open parenthesis followed by 1 to 9 digits.
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
}