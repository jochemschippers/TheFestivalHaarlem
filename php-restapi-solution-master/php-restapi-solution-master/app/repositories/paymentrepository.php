<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/ticketItem.php';
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
    public function storePaymentId($userId, $paymentId, $programID)
    {
        try {
            $sql = "INSERT INTO Payments (user_id, payment_id, programID) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$userId, $paymentId, $programID]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
    public function getPaymentIdByUserId($userId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT payment_id FROM Payments WHERE user_id = ? 
            ORDER BY created_at DESC
            LIMIT 1");
            $stmt->execute([$userId]);
            $result = $stmt->fetch();
            return $result['payment_id'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
    public function getProgramIdByPaymentId($paymentId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT programId FROM Payments WHERE payment_id = ?");
            $stmt->execute([$paymentId]);
            $result = $stmt->fetch();
            return $result['programId'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
    public function deletePaymentIdByPaymentId($paymentId)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM Payments WHERE payment_id = ?");
            $stmt->execute([$paymentId]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
}
