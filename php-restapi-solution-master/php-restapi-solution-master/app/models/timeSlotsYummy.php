<?php
require_once __DIR__ . '/../models/timeSlot.php';

class TimeSlotsYummy extends TimeSlot
{
	private int $timeSlotID;
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
		if ($eventID !== null && $price !== null && $startTime !== null && $endTime !== null && $maximumAmountTickets !== null) {
			parent::__construct(
				$timeSlotID,
				$eventID,
				$price,
				DateTime::createFromFormat('Y-m-d H:i:s', $startTime),
				DateTime::createFromFormat('Y-m-d H:i:s', $endTime),
				$maximumAmountTickets
			);
		}
		$this->timeSlotID = $timeSlotID;
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
}

?>