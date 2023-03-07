<?php

class FestivalInformation{
    
        private int $festivalID;
        private string $userName;
        private string $email;
        private int $userRole;
        private string $fullName;
        private string $phoneNumber;
        private string $password;

        public function __construct(int $festivalID, string $userName, string $email, int $userRole, string $fullName, string $phoneNumber, string $password){
            $this->festivalID = $festivalID;
            $this->userName = $userName;
            $this->email = $email;
            $this->userRole = $userRole;
            $this->fullName = $fullName;
            $this->phoneNumber = $phoneNumber;
            $this->password = $password;
        }
}

?>