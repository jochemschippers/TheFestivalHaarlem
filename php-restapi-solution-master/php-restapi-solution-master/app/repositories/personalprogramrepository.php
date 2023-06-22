<?php
require __DIR__ . '/../models/personalprogram.php';
require __DIR__ . '/../models/personalprogramitemdto.php';


class PersonalProgramRepository extends Repository
{
    public function createPersonalProgram($userId)
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO PersonalPrograms (userID, isPaid) VALUES (?, false)"
            );
            $stmt->execute([$userId]);
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: VWX234");
        }
    }
    public function updatePaymentStatus($programId, $isPaid)
    {
        try {
            error_log($programId);
            $stmt = $this->connection->prepare(
                "UPDATE PersonalPrograms SET isPaid = ? WHERE programId = ?"
            );
            $stmt->execute([$isPaid, $programId]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: YZA567");
        }
    }

    public function createEventTicket($timeSlotID, $programID)
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO EventTickets (timeSlotID, programID) VALUES (?, ?)"
            );
            $stmt->execute([$timeSlotID, $programID]);
            //return id of last inserted row
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: BCD890");
        }
    }
    public function createRestaurantReservation($reservation, $eventTicketId, $timeSlotID)
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO RestaurantReservation 
            (ticketID, timeSlotID, reservationName, phoneNumber, numberAdults, numberChildren, remark, isActive) 
            VALUES (?, ?, ?, ?, ?, ?, ?, false)"
            );
            $stmt->execute([
                $eventTicketId,
                $timeSlotID,
                $reservation->getCustomerName(),
                $reservation->getPhoneNumber(),
                $reservation->getNrOfAdults(),
                $reservation->getNrOfChild() ?? 0,
                $reservation->getRemark() ?? 'no remarks',
            ]);

            //return id of last inserted row
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: EFG123");
        }
    }
    public function getMostRecentPersonalProgramByUserId($userId)
    {
        try {
            $stmt = $this->connection->prepare(
                "SELECT programId, isPaid FROM PersonalPrograms WHERE userID = ? ORDER BY programId DESC LIMIT 1"
            );
            $stmt->execute([$userId]);
            $result = $stmt->fetch();

            // Check if a result was found
            if ($result) {
                return new PersonalProgram($result['programId'], $result['isPaid']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: HIJ456");
        }
    }
    public function getPersonalProgramByIds($programId, $userId)
    {
        try {
            $stmt = $this->connection->prepare(
                "SELECT programId, isPaid FROM PersonalPrograms WHERE programId = ? AND userID = ?"
            );
            $stmt->execute([$programId, $userId]);
            $result = $stmt->fetch();

            // Check if a result was found
            if ($result) {
                return new PersonalProgram($result['programId'], $result['isPaid']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: KLM789");
        }
    }
    public function getItemsByPersonalProgramId($personalProgramId)
    {
        try {
            $query = "
            SELECT 
            COALESCE(JazzArtists.name, YummyRestaurants.restaurantName) as title, 
            TimeSlots.startTime, 
            TimeSlots.endTime, 
            TimeSlots.eventID,
            COUNT(EventTickets.ticketID) as quantity, 
            TimeSlots.price 
        FROM 
            EventTickets
        INNER JOIN 
            TimeSlots ON EventTickets.timeSlotID = TimeSlots.timeSlotID 
        LEFT JOIN 
            TimeSlotsJazz ON TimeSlots.timeSlotID = TimeSlotsJazz.timeSlotID 
        LEFT JOIN 
            JazzArtists ON TimeSlotsJazz.artistID = JazzArtists.artistID 
        LEFT JOIN 
            TimeSlotsYummy ON TimeSlots.timeSlotID = TimeSlotsYummy.timeSlotID 
        LEFT JOIN 
            YummyRestaurants ON TimeSlotsYummy.restaurantID = YummyRestaurants.restaurantID 
        WHERE 
            EventTickets.programID = ?
        GROUP BY 
            EventTickets.timeSlotID";

            $stmt = $this->connection->prepare($query);

            $stmt->execute([$personalProgramId]);

            $items = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $item = new PersonalProgramItem();
                $item->setTitle($row['title']);
                $item->setStartTime(new DateTime($row['startTime']));
                $item->setEndTime(new DateTime($row['endTime']));
                $item->setQuantity($row['quantity']);
                $item->setPrice($row['price']);
                $item->setEventID($row['eventID']);
                $items[] = $item;
            }

            return $items;
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later. If the issue persists, please contact support with error code: NOP012");
        }
    }
}
