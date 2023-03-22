<?php
class JazzTickets {
    private $ticketID;
    private $startTime;
    private $endTime;
    private $artistName;
    private $locationName;
    private $hallID;
	private $price;
	

    public function __construct($ticketID, $startTime, $endTime, $artistName, $locationName, $hallID, $price) {
        $this->ticketID = $ticketID;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->artistName = $artistName;
        $this->locationName = $locationName;
        $this->hallID = $hallID;
		$this->price = $price;
    }

	/**
	 * @return mixed
	 */
	public function getTicketID() {
		return $this->ticketID;
	}
	
	/**
	 * @param mixed $ticketID 
	 * @return self
	 */
	public function setTicketID($ticketID): self {
		$this->ticketID = $ticketID;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getStartTime() {
		return $this->startTime;
	}
	
	/**
	 * @param mixed $startTime 
	 * @return self
	 */
	public function setStartTime($startTime): self {
		$this->startTime = $startTime;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEndTime() {
		return $this->endTime;
	}
	
	/**
	 * @param mixed $endTime 
	 * @return self
	 */
	public function setEndTime($endTime): self {
		$this->endTime = $endTime;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getArtistName() {
		return $this->artistName;
	}
	
	/**
	 * @param mixed $artistName 
	 * @return self
	 */
	public function setArtistName($artistName): self {
		$this->artistName = $artistName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLocationName() {
		return $this->locationName;
	}
	
	/**
	 * @param mixed $locationName 
	 * @return self
	 */
	public function setLocationName($locationName): self {
		$this->locationName = $locationName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getHallID() {
		return $this->hallID;
	}
	
	/**
	 * @param mixed $hallID 
	 * @return self
	 */
	public function setHallID($hallID): self {
		$this->hallID = $hallID;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPrice() {
		return $this->price;
	}
	
	/**
	 * @param mixed $price 
	 * @return self
	 */
	public function setPrice($price): self {
		$this->price = $price;
		return $this;
	}
}
?>