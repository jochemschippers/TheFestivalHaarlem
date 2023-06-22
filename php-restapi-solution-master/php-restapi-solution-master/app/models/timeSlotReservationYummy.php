<?php
require_once __DIR__ . '/../models/timeSlot.php';
require_once __DIR__ . '/../models/reservation.php';

class TimeSlotReservationYummy extends TimeSlot implements JsonSerializable
{

    private $restaurantName;
    private Reservation $reservation;


    public function __construct(int $timeSlotID = 0, int $eventID = 0, float $price = 0, string $startTime = '2001-07-29 02:43:00', string $endTime = '2001-07-29 02:43:01', int $maximmumAmountTickets = 0, string $restaurantName = '', Reservation $reservation = new Reservation())
    {

        parent::__construct($timeSlotID, $eventID, $price,  DateTime::createFromFormat('Y-m-d H:i:s', $startTime), DateTime::createFromFormat('Y-m-d H:i:s', $endTime), $maximmumAmountTickets);
        $this->restaurantName = $restaurantName;
        $this->reservation = $reservation;
    }
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'restaurantName' => $this->restaurantName,
            'reservation' => $this->reservation
        ]);
    }

    /**
     * Get the value of restaurantName
     */
    public function getRestaurantName()
    {
        return $this->restaurantName;
    }

    /**
     * Set the value of restaurantName
     *
     * @return  self
     */
    public function setRestaurantName($restaurantName)
    {
        $this->restaurantName = $restaurantName;

        return $this;
    }

    /**
     * Get the value of reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set the value of reservation
     *
     * @return  self
     */
    public function setReservation(array $data): self
    {
        $this->reservation = new Reservation();
        $this->reservation->setCustomerName($data['customerName'])
            ->setPhoneNumber($data['phoneNr'])
            ->setNrOfAdults($data['nrAdult'])
            ->setNrOfChild($data['nrChild'])
            ->setRemark($data['remark']);
        return $this;
    }
}
