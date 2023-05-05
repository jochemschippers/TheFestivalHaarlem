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
            $stmt = $this->connection->prepare("SELECT artistID,`description`,`image`,`imageSmall`,`name` FROM JazzArtists");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $artists = [];
            foreach ($results as $row) {
                $artist = new JazzArtist(
                    $row["artistID"],
                    $row['description'],
                    $row['image'],
                    $row['name'],
                    $row['imageSmall']
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
                    new JazzArtist($row['artistID'], '', $row['imageSmall'], $row['name']),
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
    function getAllHalls()
    {
        try {
            $stmt = $this->connection->prepare("SELECT hallID,`locationID`,`hallName` FROM Halls");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $halls = [];
            foreach ($results as $row) {
                $hall = new Hall(
                    $row["hallID"],
                    $row['locationID'],
                    $row['hallName']
                );
                array_push($halls, $hall);
            }
            return $halls;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function checkArtistIDExists($artistID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT artistID FROM JazzArtists WHERE artistID = ?");
            $stmt->execute([$artistID]);
            $result = $stmt->fetch();

            return $result !== false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function updateArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE JazzArtists SET `name` = ?, `description` = ?, `image` = ?, `imageSmall` = ? WHERE artistID = ?");
            $stmt->execute([
                $artist->getName(),
                $artist->getDescription(),
                $artist->getImage(),
                $artist->getImageSmall(),
                $artist->getArtistID()
            ]);
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function deleteArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM `JazzArtists` WHERE artistID = ?");
            $stmt->execute([$artist->getArtistID()]);
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function deleteLocation($location)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM `JazzLocations` WHERE locationID = ?");
            $stmt->execute([$location->getLocationID()]);
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function createArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO JazzArtists (`name`, `description`, `image`, `imageSmall`) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $artist->getName(),
                $artist->getDescription(),
                $artist->getImage(),
                $artist->getImageSmall()
            ]);
            $artist->setArtistID($this->connection->lastInsertId());
            return $artist;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

    function checkLocationIDExists($locationID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT locationID FROM JazzLocations WHERE locationID = ?");
            $stmt->execute([$locationID]);
            $result = $stmt->fetch();

            return $result !== false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function checkTimeSlotIDExists($timeSlotID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT J.timeSlotID, eventID 
            FROM TimeSlotsJazz AS J 
            INNER JOIN TimeSlots T ON J.timeSlotID = T.timeSlotID 
            WHERE J.timeSlotID = ? 
            AND eventID = 1;");
            $stmt->execute([$timeSlotID]);
            $result = $stmt->fetch();

            return $result !== false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function checkHallIDExists($hallID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT hallID FROM Halls WHERE hallID = ?");
            $stmt->execute([$hallID]);
            $result = $stmt->fetch();

            return $result !== false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }

    function checkHallAndLocationCombiExists($hallID, $locationID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT hallID FROM Halls WHERE hallID = ? AND locationID = ?");
            $stmt->execute([$hallID, $locationID]);
            $result = $stmt->fetch();

            return $result !== false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function updateLocation($location)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE JazzLocations SET `locationName` = ?, `address` = ?, `locationImage` = ?, `toAndFromText` = ?, `accessibillityText` = ? WHERE locationID = ?");
            $stmt->execute([
                $location->getLocationName(),
                $location->getAddress(),
                $location->getLocationImage(),
                $location->getToAndFromText(),
                $location->getAccesibillityText(),
                $location->getLocationID()
            ]);
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function createLocation($location)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO JazzLocations (`locationName`, `address`, `locationImage`, `toAndFromText`, `accessibillityText`) VALUES (?,?,?,?,?)");
            $stmt->execute([
                $location->getLocationName(),
                $location->getAddress(),
                $location->getLocationImage(),
                $location->getToAndFromText(),
                $location->getAccesibillityText(),
            ]);
            $location->setLocationID($this->connection->lastInsertId());
            return $location;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function updateTimeSlotJazz($timeslot)
    {
        try {
            // Update TimeSlots table
            $stmt1 = $this->connection->prepare("UPDATE TimeSlots SET `price` = ?, `startTime` = ?, `endTime` = ?, `maximumAmountTickets` = ? WHERE timeSlotID = ?");
            $stmt1->execute([
                $timeslot->getPrice(),
                $timeslot->getStartTime()->format('Y-m-d H:i:s'),
                $timeslot->getEndTime()->format('Y-m-d H:i:s'),
                $timeslot->getMaximumAmountTickets(),
                $timeslot->getTimeSlotID()
            ]);

            // Update TimeSlotsJazz table
            $stmt2 = $this->connection->prepare("UPDATE TimeSlotsJazz SET `artistID` = ?, `locationID` = ?, `hallID` = ? WHERE timeSlotID = ?");
            $stmt2->execute([
                $timeslot->getArtist()->getArtistID(),
                $timeslot->getJazzLocation()->getLocationID(),
                $timeslot->getHall()->getHallID(),
                $timeslot->getTimeSlotID()
            ]);
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function createAndPopulateTimeSlotJazz($timeslot)
    {
        $createdTimeslot = $this->createTimeSlotJazz($timeslot);
        $populatedTimeslot = $this->getTimeSlotInformation($createdTimeslot);
        return $populatedTimeslot;
    }
    private function createTimeSlotJazz($timeslot)
    {
        try {
            // Insert into TimeSlots table
            $stmt1 = $this->connection->prepare("INSERT INTO TimeSlots (`price`, `eventID`, `startTime`, `endTime`, `maximumAmountTickets`) VALUES (?,1,?,?,?)");
            $stmt1->execute([
                $timeslot->getPrice(),
                $timeslot->getStartTime()->format('Y-m-d H:i:s'),
                $timeslot->getEndTime()->format('Y-m-d H:i:s'),
                $timeslot->getMaximumAmountTickets(),
            ]);

            $timeslot->setTimeSlotID($this->connection->lastInsertId());

            // Insert into TimeSlotsJazz table
            $stmt2 = $this->connection->prepare("INSERT INTO TimeSlotsJazz (`timeSlotID`, `artistID`, `locationID`, `hallID`) VALUES (?,?,?,?)");
            $stmt2->execute([
                $timeslot->getTimeSlotID(),
                $timeslot->getArtist()->getArtistID(),
                $timeslot->getJazzLocation()->getLocationID(),
                $timeslot->getHall()->getHallID(),
            ]);

            return $timeslot;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    private function getTimeSlotInformation($timeslot)
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT
                    ja.name AS artistName,
                    jl.locationName,
                    h.hallName
                FROM
                    TimeSlotsJazz AS tsj
                INNER JOIN JazzArtists AS ja ON tsj.artistID = ja.artistID
                INNER JOIN JazzLocations AS jl ON tsj.locationID = jl.locationID
                INNER JOIN Halls AS h ON tsj.hallID = h.hallID AND h.locationID = jl.locationID
                WHERE
                    tsj.timeSlotID = ?
            ");
            $stmt->execute([$timeslot->getTimeSlotID()]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $timeslot->getArtist()->setName($result['artistName']);
            $timeslot->getJazzLocation()->setLocationName($result['locationName']);
            $timeslot->getHall()->setHallName($result['hallName']);


            return $timeslot;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function deleteTimeslotJazz($timeslot)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM `TimeSlots` WHERE timeSlotID = ?");
            $stmt->execute([$timeslot->getTimeSlotID()]);
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
}
