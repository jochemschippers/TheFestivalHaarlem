<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/timeslot.php';
require_once __DIR__ . '/../models/jazzartist.php';
require_once __DIR__ . '/../models/timeslotsjazz.php';
require_once __DIR__ . '/../models/timeslotsyummy.php';
require_once __DIR__ . '/../models/jazzlocation.php';
require_once __DIR__ . '/../models/timeslotreservationyummy.php';



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
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: ABC123");
        }
    }
    function getAmountSoldAndMaximum($timeSlotID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(*) AS boughtTicketsCount, T.maximumAmountTickets
            FROM EventTickets AS ET
            INNER JOIN TimeSlots AS T ON T.timeSlotID = ET.timeSlotID 
            WHERE T.timeSlotID = ?");
            $stmt->execute([$timeSlotID]);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: DEF456");
        }
    }
    public function getJazzTimeSlotById($timeslotID)
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
            h.hallName,
            (SELECT COUNT(*) FROM EventTickets WHERE timeSlotID = ts.timeSlotID) AS boughtTicketsCount
           FROM
                TimeSlots AS ts
            INNER JOIN TimeSlotsJazz AS tsj ON ts.timeSlotID = tsj.timeSlotID
            INNER JOIN JazzArtists AS ja ON tsj.artistID = ja.artistID
            INNER JOIN JazzLocations AS jl ON tsj.locationID = jl.locationID
            INNER JOIN Halls AS h ON tsj.hallID = h.hallID AND h.locationID = jl.locationID
            WHERE
            ts.eventID = 1 AND ts.timeSlotID = ?
            GROUP BY
            ts.timeSlotID
            ORDER BY
            ts.timeSlotID;
            ");
            $stmt->bindParam(1, $timeslotID);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($result) {
                $timeSlotJazz = new TimeSlotsJazz(
                    $result["timeSlotID"],
                    $result['eventID'],
                    $result['price'],
                    $result['startTime'],
                    $result['endTime'],
                    $result['maximumAmountTickets'],
                    new JazzArtist($result['artistID'], '', $result['imageSmall'], $result['name']),
                    new JazzLocation($result['locationID'], $result['locationName']),
                    new Hall($result['hallID'], $result['locationID'], $result['hallName'])
                );
                $timeSlotJazz->setCurrentlyBoughtTickets($result['boughtTicketsCount']);
                return $timeSlotJazz;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: GHI789");
        }
    }
    public function retrieveTimeSlotIfItIsDayTicket($timeSlotID)
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT 
                    ts.timeSlotID, ts.eventID, ts.price, ts.startTime, ts.endTime, ts.maximumAmountTickets,
                    (SELECT COUNT(*) FROM EventTickets WHERE timeSlotID = ts.timeSlotID) AS boughtTicketsCount
                FROM
                    TimeSlots AS ts
                LEFT JOIN TimeSlotsJazz AS tsj ON ts.timeSlotID = tsj.timeSlotID
                WHERE
                    ts.eventID = 1 AND tsj.timeSlotID IS NULL AND ts.timeSlotID = ?
                GROUP BY
                    ts.timeSlotID
                ORDER BY
                    ts.timeSlotID
            ");
            $stmt->execute([$timeSlotID]);
            $result = $stmt->fetch();

            if ($result) {
                $timeSlot = new TimeSlot(
                    $result["timeSlotID"],
                    $result['eventID'],
                    $result['price'],
                    new DateTime($result['startTime']),
                    new DateTime($result['endTime']),
                    $result['maximumAmountTickets']
                );
                $timeSlot->setCurrentlyBoughtTickets($result['boughtTicketsCount']);
                return $timeSlot;
            }
            return false;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: JKL012");
        }
    }
    public function getRestaurantReservationById($timeslotID)
    {
        try {
            $stmt = $this->connection->prepare("
        SELECT 
        ts.timeSlotID, ts.eventID, ts.price, ts.startTime, ts.endTime, ts.maximumAmountTickets,
        yr.restaurantID,
        yr.restaurantName,
        (SELECT COUNT(*) FROM EventTickets WHERE timeSlotID = ts.timeSlotID) AS boughtTicketsCount
        FROM
            TimeSlots AS ts
        INNER JOIN TimeSlotsYummy AS tsy ON ts.timeSlotID = tsy.timeSlotID
        INNER JOIN YummyRestaurants AS yr ON tsy.restaurantID = yr.restaurantID
        WHERE
        ts.eventID = 2 AND ts.timeSlotID = ?
        GROUP BY
        ts.timeSlotID
        ORDER BY
        ts.timeSlotID;
        ");
            $stmt->bindParam(1, $timeslotID);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($result) {
                $timeSlotYummy = new TimeSlotReservationYummy(
                    $result["timeSlotID"],
                    $result['eventID'],
                    $result['price'],
                    $result['startTime'],
                    $result['endTime'],
                    $result['maximumAmountTickets'],
                    $result['restaurantName'],
                );
                $timeSlotYummy->setCurrentlyBoughtTickets($result['boughtTicketsCount']);
                return $timeSlotYummy;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: MNO345");
        }
    }
}
