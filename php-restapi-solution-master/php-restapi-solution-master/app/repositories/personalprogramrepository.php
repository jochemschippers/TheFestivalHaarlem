<?php
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
}
