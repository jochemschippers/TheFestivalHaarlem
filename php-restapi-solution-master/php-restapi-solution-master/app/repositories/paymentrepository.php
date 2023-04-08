<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/ticketItem.php';
require_once __DIR__ . '/../models/JazzTickets.php';


class PaymentRepository extends Repository
{
    function GetJazzTickets()
{
    try {
        $stmt = $this->connection->prepare("SELECT EventTickets.ticketID, TimeSlots.startTime, TimeSlots.endTime, JazzArtists.name, JazzLocations.locationName, TimeSlotsJazz.hallID, TimeSlots.price
        FROM EventTickets
        JOIN TimeSlots ON EventTickets.timeSlotID = TimeSlots.timeSlotID
        JOIN TimeSlotsJazz ON TimeSlots.timeSlotID = TimeSlotsJazz.timeSlotID
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
                $row['hallID'],
                $row['price']
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
