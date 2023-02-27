<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/FestivalEvent.php';

class EventRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM FestivalEvents");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'FestivalEvent');
            $events = $stmt->fetchAll();

            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
