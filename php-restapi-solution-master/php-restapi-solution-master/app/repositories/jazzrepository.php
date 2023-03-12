<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/JazzArtist.php';


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
        $stmt = $this->connection->prepare("SELECT timeSlotID FROM TimeSlotsJazz WHERE artistID =" . $artist->getArtistID());
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $timeSlots = [];
        foreach ($results as $row) {
            array_push($timeSlots, $row["timeSlotID"]);
        }
        return $timeSlots;
    } catch (PDOException $e) {
        echo $e;
    }
}
}