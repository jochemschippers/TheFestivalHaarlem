<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/timeSlot.php';
require_once __DIR__ . '/../models/JazzArtist.php';
require_once __DIR__ . '/../models/TimeSlotsJazz.php';
require_once __DIR__ . '/../models/JazzLocation.php';


class TimeSlotRepository extends Repository
{
    function checkTimeSlotIDExists($timeSlotID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT timeSlotID
            FROM TimeSlots
            WHERE timeSlotID = ?;");
            $stmt->execute([$timeSlotID]);
            $result = $stmt->fetch();

            return $result !== false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function get($timeSlotID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT timeSlotID
            FROM TimeSlots
            WHERE timeSlotID = ?;");
            $stmt->execute([$timeSlotID]);
            $result = $stmt->fetch();

            return $result !== false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
}
