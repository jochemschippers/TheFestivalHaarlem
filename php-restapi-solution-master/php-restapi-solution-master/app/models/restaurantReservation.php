<?php
require_once __DIR__ . '/../models/timeslotsyummy.php';

class Restaurantreservation extends TimeSlotsYummy
{
    private int $ticketID;
    private string $reservationName;
    private int $phoneNumber;
    private int $numberAdults;
    private int $numberChildren;
    private string $remark;
    private bool $isActive;

    // constructor method
    public function __construct(int $ticketID, int $timeSlotID = null, int $restaurantID = null,
    string $reservationName, int $phoneNumber, int $numberAdults, int $numberChildren,
    string $remark, bool $isActive, int $eventID = null, float $price = null, string $startTime = null,
    string $endTime = null, int $maximumAmountTickets = null)
    {
        parent::__construct(
            $timeSlotID,
            $restaurantID,
            $eventID,
            $price,
            $startTime ? DateTime::createFromFormat('Y-m-d H:i:s', $startTime) : null,
            $endTime ? DateTime::createFromFormat('Y-m-d H:i:s', $endTime) : null,
            $maximumAmountTickets
        );
        $this->ticketID = $ticketID;
        $this->reservationName = $reservationName;
        $this->phoneNumber = $phoneNumber;
        $this->numberAdults = $numberAdults;
        $this->numberChildren = $numberChildren;
        $this->remark = $remark;
        $this->isActive = $isActive;
    }


    /**
     * @return int
     */
    public function getTicketID(): int
    {
        return $this->ticketID;
    }

    /**
     * @param int $ticketID 
     * @return self
     */
    public function setTicketID(int $ticketID): self
    {
        $this->ticketID = $ticketID;
        return $this;
    }

    /**
     * @return string
     */
    public function getReservationName(): string
    {
        return $this->reservationName;
    }

    /**
     * @param string $reservationName 
     * @return self
     */
    public function setReservationName(string $reservationName): self
    {
        $this->reservationName = $reservationName;
        return $this;
    }

    /**
     * @return int
     */
    public function getPhoneNumber(): int
    {
        return $this->phoneNumber;
    }

    /**
     * @param int $phoneNumber 
     * @return self
     */
    public function setPhoneNumber(int $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberAdults(): int
    {
        return $this->numberAdults;
    }

    /**
     * @param int $numberAdults 
     * @return self
     */
    public function setNumberAdults(int $numberAdults): self
    {
        $this->numberAdults = $numberAdults;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberChildren(): int
    {
        return $this->numberChildren;
    }

    /**
     * @param int $numberChildren 
     * @return self
     */
    public function setNumberChildren(int $numberChildren): self
    {
        $this->numberChildren = $numberChildren;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemark(): string
    {
        return $this->remark;
    }

    /**
     * @param string $remark 
     * @return self
     */
    public function setRemark(string $remark): self
    {
        $this->remark = $remark;
        return $this;
    }

	/**
	 * @return bool
	 */
	public function getIsActive(): bool {
		return $this->isActive;
	}
	
	/**
	 * @param bool $isActive 
	 * @return self
	 */
	public function setIsActive(bool $isActive): self {
		$this->isActive = $isActive;
		return $this;
	}

}
