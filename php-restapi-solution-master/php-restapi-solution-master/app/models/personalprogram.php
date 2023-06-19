<?php

class PersonalProgram{
    
        private $programID;
        private int $userID;
        private $isPaid;


        public function __construct($programID, $isPaid){
            $this->programID = $programID;
            $this->isPaid = $isPaid;
        }

        /**
         * Get the value of programID
         */ 
        public function getProgramID()
        {
                return $this->programID;
        }

        /**
         * Set the value of programID
         *
         * @return  self
         */ 
        public function setProgramID($programID)
        {
                $this->programID = $programID;

                return $this;
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
         * Get the value of isPaid
         */ 
        public function getIsPaid()
        {
                return $this->isPaid;
        }

        /**
         * Set the value of isPaid
         *
         * @return  self
         */ 
        public function setIsPaid($isPaid)
        {
                $this->isPaid = $isPaid;

                return $this;
        }
}

?>