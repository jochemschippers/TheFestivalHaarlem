<?php

class User{
    
        private int $userID;
        private $email;
        private int $userRole;
        private string $fullName;
        private $phoneNumber;
        private $password;


        public function __construct(int $userID, int $userRole, string $fullName, $email = '',   $phoneNumber = '', $password = ''){
            $this->userID = $userID;
            $this->email = $email;
            $this->userRole = $userRole;
            $this->fullName = $fullName;
            $this->phoneNumber = $phoneNumber;
            $this->password = $password;
        }

        /**
         * Get the value of userID
         */ 
        public function getUserID()
        {
                return $this->userID;
        }

        /**
         * Set the value of userID
         *
         * @return  self
         */ 
        public function setUserID($userID)
        {
                $this->userID = $userID;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of userRole
         */ 
        public function getUserRole()
        {
                return $this->userRole;
        }

        /**
         * Set the value of userRole
         *
         * @return  self
         */ 
        public function setUserRole($userRole)
        {
                $this->userRole = $userRole;

                return $this;
        }

        /**
         * Get the value of fullName
         */ 
        public function getFullName()
        {
                return $this->fullName;
        }

        /**
         * Set the value of fullName
         *
         * @return  self
         */ 
        public function setFullName($fullName)
        {
                $this->fullName = $fullName;

                return $this;
        }

        /**
         * Get the value of phoneNumber
         */ 
        public function getPhoneNumber()
        {
                return $this->phoneNumber;
        }

        /**
         * Set the value of phoneNumber
         *
         * @return  self
         */ 
        public function setPhoneNumber($phoneNumber)
        {
                $this->phoneNumber = $phoneNumber;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }
}

?>