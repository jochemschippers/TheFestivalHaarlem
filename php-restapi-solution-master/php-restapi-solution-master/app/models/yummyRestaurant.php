<?php

class YummyRestaurant{
    
        private int $restaurantID;
        private string $restaurantName;
        private string $address;
		private string $contact;
        private string $description;
        private int $amountOfStars;
        private string $bannerImage;
        private string $headChef;
		private string $amountSessions;
        private float $adultPrice;
        private float $childPrice;
        private DateTime $startTime;
        private DateTime $duration;

        public function __construct(
                int $restaurantID,
                string $restaurantName,
                string $address,
				string $contact,
                string $description,
                int $amountOfStars,
                string $bannerImage,
                string $headChef,
				int $amountSessions,
                float $adultPrice,
                float $childPrice,
                DateTime $startTime,
                DateTime $duration
            ) {
                $this->restaurantID = $restaurantID;
                $this->restaurantName = $restaurantName;
                $this->address = $address;
				$this->contact = $contact;
                $this->description = $description;
                $this->amountOfStars = $amountOfStars;
                $this->bannerImage = $bannerImage;
                $this->headChef = $headChef;
				$this->amountSessions = $amountSessions;
                $this->adultPrice = $adultPrice;
                $this->childPrice = $childPrice;
                $this->startTime = $startTime;
                $this->duration = $duration;
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
	public function getRestaurantName(): string {
		return $this->restaurantName;
	}
	
	/**
	 * @param string $restaurantName 
	 * @return self
	 */
	public function setRestaurantName(string $restaurantName): self {
		$this->restaurantName = $restaurantName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string {
		return $this->address;
	}
	
	/**
	 * @param string $address 
	 * @return self
	 */
	public function setAddress(string $address): self {
		$this->address = $address;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getContact(): string {
		return $this->contact;
	}
	
	/**
	 * @param string $contact 
	 * @return self
	 */
	public function setContact(string $contact): self {
		$this->contact = $contact;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}
	
	/**
	 * @param string $description 
	 * @return self
	 */
	public function setDescription(string $description): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getAmountOfStars(): int {
		return $this->amountOfStars;
	}
	
	/**
	 * @param int $amountOfStars 
	 * @return self
	 */
	public function setAmountOfStars(int $amountOfStars): self {
		$this->amountOfStars = $amountOfStars;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBannerImage(): string {
		return $this->bannerImage;
	}
	
	/**
	 * @param string $bannerImage 
	 * @return self
	 */
	public function setBannerImage(string $bannerImage): self {
		$this->bannerImage = $bannerImage;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getHeadChef(): string {
		return $this->headChef;
	}
	
	/**
	 * @param string $headChef 
	 * @return self
	 */
	public function setHeadChef(string $headChef): self {
		$this->headChef = $headChef;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getStartTime(): DateTime {
		return $this->startTime;
	}
	
	/**
	 * @param DateTime $startTime 
	 * @return self
	 */
	public function setStartTime(DateTime $startTime): self {
		$this->startTime = $startTime;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getDuration(): DateTime {
		return $this->duration;
	}
	
	/**
	 * @param DateTime $duration 
	 * @return self
	 */
	public function setDuration(DateTime $duration): self {
		$this->duration = $duration;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getAmountSessions(): string {
		return $this->amountSessions;
	}
	
	/**
	 * @param string $amountSessions 
	 * @return self
	 */
	public function setAmountSessions(string $amountSessions): self {
		$this->amountSessions = $amountSessions;
		return $this;
	}
	
	/**
	 * @return float
	 */
	public function getAdultPrice(): float {
		return $this->adultPrice;
	}
	
	/**
	 * @param float $adultPrice 
	 * @return self
	 */
	public function setAdultPrice(float $adultPrice): self {
		$this->adultPrice = $adultPrice;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getChildPrice(): float {
		return $this->childPrice;
	}
	
	/**
	 * @param float $childPrice 
	 * @return self
	 */
	public function setChildPrice(float $childPrice): self {
		$this->childPrice = $childPrice;
		return $this;
	}	
}
?>