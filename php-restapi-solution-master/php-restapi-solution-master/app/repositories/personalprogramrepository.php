<?php
class PersonalProgramRepository extends Repository
{
    public function createPersonalProgram($userId)
    {
        try {

            $stmt = $this->connection->prepare(
                "INSERT INTO PersonalPrograms (userID) VALUES (?)"
            );
            $stmt->execute([$userId]);

            // Return the id of the newly created program
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
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
