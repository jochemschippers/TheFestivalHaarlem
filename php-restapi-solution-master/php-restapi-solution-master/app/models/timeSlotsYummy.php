<?php
require_once __DIR__ . '/../models/timeSlot.php';

class TimeSlotsYummy extends TimeSlot
{
	private int $restaurantID;
	
	public function __construct(
		int $timeSlotID = null,
		int $restaurantID = null,
		int $eventID = null,
		float $price = null,
		string $startTime = null,
		string $endTime = null,
		int $maximumAmountTickets = null
	) {
		parent::__construct(
			$timeSlotID,
			$eventID,
			$price,
			$startTime ? DateTime::createFromFormat('Y-m-d H:i:s', $startTime) : null,
			$endTime ? DateTime::createFromFormat('Y-m-d H:i:s', $endTime) : null,
			$maximumAmountTickets
		);
		$this->restaurantID = $restaurantID;
	}

	/**
	 * @return int
	 */
	public function getRestaurantID(): int
	{
		return $this->restaurantID;
	}

	/**
	 * @param int $restaurantID 
	 * @return self
	 */
	public function setRestaurantID(int $restaurantID): self
	{
		$this->restaurantID = $restaurantID;
		return $this;
	}
	
}

?>