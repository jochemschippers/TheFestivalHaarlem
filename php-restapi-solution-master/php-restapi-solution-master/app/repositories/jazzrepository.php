<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/JazzArtist.php';
require_once __DIR__ . '/../models/TimeSlotsJazz.php';
require_once __DIR__ . '/../models/TimeSlot.php';


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
            echo $e;
        }
    }

function getAllTimeSlots($artist)
{
    try {
        $stmt = $this->connection->prepare("
        SELECT J.timeSlotID , J.locationID, J.hallID, T.eventID, T.price, T.startTime, T.endTime, T.maximumAmountTickets 
        FROM TimeSlotsJazz J 
        INNER JOIN timeSlots T ON J.timeSlotID = T.timeSlotID 
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
        echo $e;
    }
//         public function __construct(int $timeSlotID, int $eventID, float $priceID, DateTime $startTime, DateTime $endTime, int $maximmumAmountTickets, int $artistID, int $hallID) {
//             parent::__construct($timeSlotID, $eventID, $priceID, $startTime, $endTime, $maximmumAmountTickets);
//             $this->artistID = $artistID;
//             $this->hallID = $hallID;
//         }
//         public function getArtistID(): int {
//             return $this->artistID;
//         }
//         public function setArtistID(int $artistID): void {
//             $this->artistID = $artistID;
//         }
    
//         public function getHallID(): int {
//             return $this->hallID;
//         }
    
//         public function setHallID(int $hallID): void {
//             $this->hallID = $hallID;
//         }
}
}