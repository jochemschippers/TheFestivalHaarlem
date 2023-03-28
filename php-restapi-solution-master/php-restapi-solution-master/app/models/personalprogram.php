<?php

class PersonalProgram{
    
        private int $programID;
        private int $userID;
        private int $paymentMethod;
        private bool $isPaid;


        public function __construct(int $programID, int $userID, int $paymentMethod, bool $isPaid){
            $this->programID = $programID;
            $this->userID = $userID;
            $this->paymentMethod = $paymentMethod;
            $this->isPaid = $isPaid;
        }
}

?>