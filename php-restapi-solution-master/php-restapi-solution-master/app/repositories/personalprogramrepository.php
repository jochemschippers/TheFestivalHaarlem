<?php
require __DIR__ . '/../models/personalprogram.php';

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
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
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
        throw new ErrorException("It seems something went wrong with our database! Please try again later.");
    }
}

    public function createEventTicket($timeSlotID, $programID)
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO EventTickets (timeSlotID, programID) VALUES (?, ?)"
            );
            $stmt->execute([$timeSlotID, $programID]);
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    public function getMostRecentPersonalProgramByUserId($userId) {
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
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
}
