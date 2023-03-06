<?php

class RestaurantReservation{
    
        private int $timeSlotID;
        private int $restaurantID;
        private string $customerName;
        private string $phoneNumber;
        private int $numberAdults;
        private int $numberChildren;
        private string $remark;


        public function __construct(int $timeSlotID, int $restaurantID, string $customerName, string $phoneNumber, int $numberAdults, int $numberChildren, string $remark){
            $this->timeSlotID = $timeSlotID;
            $this->restaurantID = $restaurantID;
            $this->customerName = $customerName;
            $this->phoneNumber = $phoneNumber;
            $this->numberAdults = $numberAdults;
            $this->numberChildren = $numberChildren;
            $this->remark = $remark;
        }
}

?>