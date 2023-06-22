<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/festivalevent.php';
require_once __DIR__ . '/../models/festivalinformation.php';


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
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    
    function getFestivalInformation()
    {
        try {
            $stmt = $this->connection->prepare("SELECT startDate, endDate FROM FestivalInformation ORDER BY festivalID DESC LIMIT 0, 1");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'FestivalInformation');
            $festivalInformation = $stmt->fetch(PDO::FETCH_ASSOC);
            if (count($festivalInformation) > 0) {
                $festivalInformationObject = new FestivalInformation(
                    new DateTime($festivalInformation["startDate"]),
                    new DateTime($festivalInformation["endDate"]),
                );
                return $festivalInformationObject;
            } else {
                throw new ErrorException("No festival information found. Please try again later.");
            }
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
}
