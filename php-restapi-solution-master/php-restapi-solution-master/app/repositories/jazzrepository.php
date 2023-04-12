<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/timeSlot.php';
require_once __DIR__ . '/../models/JazzArtist.php';
require_once __DIR__ . '/../models/TimeSlotsJazz.php';
require_once __DIR__ . '/../models/JazzLocation.php';


class JazzRepository extends Repository
{
    function getAllArtists()
    {
        try {
            $stmt = $this->connection->prepare("SELECT artistID,`description`,`image`,`name` FROM JazzArtists");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $artists = [];
            foreach ($results as $row) {
                $artist = new JazzArtist(
                    $row["artistID"],
                    $row['description'],
                    $row['image'],
                    $row['name']
                );
                array_push($artists, $artist);
            }
            return $artists;

        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

function getAllTimeSlots($artist)
{
    try {
        $stmt = $this->connection->prepare("
        SELECT J.timeSlotID , J.locationID, J.hallID, T.eventID, T.price, T.startTime, T.endTime, T.maximumAmountTickets 
        FROM TimeSlotsJazz J 
        INNER JOIN TimeSlots T ON J.timeSlotID = T.timeSlotID 
        WHERE artistID =" . $artist->getArtistID());
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $timeSlots = [];
        foreach ($results as $row) {
            $timeSlotJazz = new TimeSlotsJazz(
                $row["timeSlotID"],
                $row['eventID'],
                $row['price'],
                $row['startTime'],
                $row['endTime'],
                $row['maximumAmountTickets'],
                $artist->getArtistID(),
                $row['hallID']
            );
            array_push($timeSlots, $timeSlotJazz);
        }
        return $timeSlots;
    } catch (PDOException $e) {
        throw new ErrorException("It seems something went wrong with our database! Please try again later.");
    }
}
function getAllLocations()
{
    try {
        $stmt = $this->connection->prepare("SELECT locationID,`locationName`,`address`,`locationImage`, `toAndFromText`, `accessibillityText` FROM JazzLocations");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $locations = [];
        foreach ($results as $row) {
            $jazzLocation = new JazzLocation(
                $row["locationID"],
                $row['locationName'],
                $row['address'],
                $row['locationImage'],
                $row['toAndFromText'],
                $row['accessibillityText'],
            );
            array_push($locations, $jazzLocation);
        }
        return $locations;

    } catch (PDOException $e) {
        throw new ErrorException("It seems something went wrong with our database! Please try again later.");
    }
}
}