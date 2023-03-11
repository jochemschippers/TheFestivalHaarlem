<?php

class RestaurantReservation{
    
        private int $timeSlotID;
        private int $restaurantID;
        private string $customerName;
        private string $phoneNumber;
        private int $numberAdults;
        private int $numberChildren;
        private string $remark;

	/**
	 * @return int
	 */
	public function getTimeSlotID(): int {
		return $this->timeSlotID;
	}
	
	/**
	 * @param int $timeSlotID 
	 * @return self
	 */
	public function setTimeSlotID(int $timeSlotID): self {
		$this->timeSlotID = $timeSlotID;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getRestaurantID(): int {
		return $this->restaurantID;
	}
	
	/**
	 * @param int $restaurantID 
	 * @return self
	 */
	public function setRestaurantID(int $restaurantID): self {
		$this->restaurantID = $restaurantID;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCustomerName(): string {
		return $this->customerName;
	}
	
	/**
	 * @param string $customerName 
	 * @return self
	 */
	public function setCustomerName(string $customerName): self {
		$this->customerName = $customerName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPhoneNumber(): string {
		return $this->phoneNumber;
	}
	
	/**
	 * @param string $phoneNumber 
	 * @return self
	 */
	public function setPhoneNumber(string $phoneNumber): self {
		$this->phoneNumber = $phoneNumber;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getNumberAdults(): int {
		return $this->numberAdults;
	}
	
	/**
	 * @param int $numberAdults 
	 * @return self
	 */
	public function setNumberAdults(int $numberAdults): self {
		$this->numberAdults = $numberAdults;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getNumberChildren(): int {
		return $this->numberChildren;
	}
	
	/**
	 * @param int $numberChildren 
	 * @return self
	 */
	public function setNumberChildren(int $numberChildren): self {
		$this->numberChildren = $numberChildren;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRemark(): string {
		return $this->remark;
	}
	
	/**
	 * @param string $remark 
	 * @return self
	 */
	public function setRemark(string $remark): self {
		$this->remark = $remark;
		return $this;
	}
}

?>