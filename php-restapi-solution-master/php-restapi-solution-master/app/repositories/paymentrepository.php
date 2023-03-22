<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/ticketItem.php';
require_once __DIR__ . '/../models/JazzTickets.php';


class PaymentRepository extends Repository
{
    function GetJazzTickets()
{
    try {
        $stmt = $this->connection->prepare("SELECT eventTickets.ticketID, timeSlots.startTime, timeSlots.endTime, JazzArtists.name, JazzLocations.locationName, TimeSlotsJazz.hallID
        FROM eventTickets
        JOIN timeSlots ON eventTickets.timeSlotID = timeSlots.timeSlotID
        JOIN TimeSlotsJazz ON timeSlots.timeSlotID = TimeSlotsJazz.timeSlotID
        JOIN JazzArtists ON JazzArtists.artistID = TimeSlotsJazz.artistID
        JOIN JazzLocations ON JazzLocations.locationID = TimeSlotsJazz.locationID");

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $results = $stmt->fetchAll();

        $JazzTickets = [];
        foreach ($results as $row) {
            $jazzTicket = new JazzTickets(
                $row["ticketID"],
                $row['startTime'],
                $row['endTime'],
                $row['name'],
                $row['locationName'],
                $row['hallID']
            );
            array_push($JazzTickets, $jazzTicket);
        }
        return $JazzTickets;

    } catch (PDOException $e) {
        echo $e;
    }
}
}
?>
