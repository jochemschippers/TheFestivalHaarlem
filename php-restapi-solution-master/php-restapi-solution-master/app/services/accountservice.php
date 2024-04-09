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
                $user = $this->repository->getUser($email); //this causes error (i know why! chackek de model)
                return $user;
            }
        }catch(Exception $e){
            throw $e;
        }
        
    }
    public function register($user) {
        try{
        $inputStrings = [$user->getFullName(), $user->getEmail(), $user->getPassword(), $user->getPhoneNumber()];
        $this->validateUserInputs($inputStrings);
        if($this->repository->checkEmailExists($user->getEmail()))
        {
            throw new ErrorException("This email is already linked to an account! Please try to log in.");
        }
        //encrypt user password
        $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

        $this->repository->register($user);

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
        header('Location: /');
        exit();
    }
    // validate user inputs made in another method because the overview page of the user should use this method
    private function validateUserInputs($inputStrings)
    {
        //0 = fullname, 1 = email, 2 = password
        if (!$this->validateStringLength($inputStrings)) {
            throw new ErrorException("One or more inputs have more than 100 characters. Please provide shorter input values.");
        }
        if (!$this->verifyEmail($inputStrings[1])) {
            throw new ErrorException("The email is in an incorrect format!");
        }
        if ($inputStrings[2] !== null && $inputStrings[0] !== null && !$this->isPasswordDistinct($inputStrings[2], $inputStrings[0], $inputStrings[1])) {
            throw new ErrorException("Password is too similar to email, fullname! Please choose a more secure password");
        }
        if($this->isValidPhoneNumber($inputStrings[3])){
            throw new ErrorException("Phone number is invalid!");
        }
    }
    public function validateStringLength($strings)
    {
        foreach ($strings as $string) {
            if (strlen($string) >= 100) {
                return false;
            }
        }
        return true;
    }
    public function verifyEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }



    private function isValidPhoneNumber($phoneNumber) {
        //Optionally starts with a '+' then 1 to 3 digits with possible space after it. 
        //Then, there may be a hyphen, dot, or open parenthesis followed by 1 to 4 digits, and a possible closing parenthesis, hyphen, or dot. this repeats for up to four times
        //Finally, there may be a hyphen, dot, or open parenthesis followed by 1 to 9 digits.
        $pattern = '/^(?:\+\d{1,3}\s?)?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,4}[-. )]?[-. (]?\d{1,9}$/';
        return preg_match($pattern, $phoneNumber) !== 1;
    }
    private function isPasswordDistinct($password, $fullName, $email) {
        $similarityThreshold = 70;
        similar_text(strtolower($password), strtolower($fullName), $nameSimilarity);
        similar_text(strtolower($password), strtolower($email), $emailSimilarity);
        
        // Check if both similarities are below the defined threshold.
        return $nameSimilarity < $similarityThreshold && $emailSimilarity < $similarityThreshold;
    }
}