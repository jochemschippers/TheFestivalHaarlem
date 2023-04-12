<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/JazzArtist.php';
require_once __DIR__ . '/../models/TimeSlotsJazz.php';
require_once __DIR__ . '/../models/TimeSlot.php';
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
                );
                array_push($timeSlots, $timeSlotJazz);
            }
            return $timeSlots;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function getAllJazzTimeSlots()
    {
        try {
            $stmt = $this->connection->prepare("
              SELECT 
                ts.timeSlotID, ts.eventID, ts.price, ts.startTime, ts.endTime, ts.maximumAmountTickets,
                ja.artistID,
                ja.imageSmall,
                ja.name,
                jl.locationID,
                jl.locationName,
                h.hallID,
                h.hallName
               FROM
                    TimeSlots AS ts
                INNER JOIN TimeSlotsJazz AS tsj ON ts.timeSlotID = tsj.timeSlotID
                INNER JOIN JazzArtists AS ja ON tsj.artistID = ja.artistID
                INNER JOIN JazzLocations AS jl ON tsj.locationID = jl.locationID
                INNER JOIN Halls AS h ON tsj.hallID = h.hallID AND h.locationID = jl.locationID
                WHERE
                ts.eventID = 1
                GROUP BY
                ts.timeSlotID
                ORDER BY
                ts.timeSlotID;");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $timeSlotsJazz = [];
            foreach ($results as $row) {
                $timeSlotJazz = new TimeSlotsJazz(
                    $row["timeSlotID"],
                    $row['eventID'],
                    $row['price'],
                    $row['startTime'],
                    $row['endTime'],
                    $row['maximumAmountTickets'],
                    new JazzArtist($row['artistID'], '',$row['imageSmall'], $row['name']),
                    new JazzLocation($row['locationID'], $row['locationName']),
                    new Hall($row['hallID'], $row['locationID'], $row['hallName'])
                );
                array_push($timeSlotsJazz, $timeSlotJazz);
            }
            return $timeSlotsJazz;
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
