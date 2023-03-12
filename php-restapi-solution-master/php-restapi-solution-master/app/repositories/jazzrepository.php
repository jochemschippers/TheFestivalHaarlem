<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/jazzArtist.php';


class JazzRepository extends Repository
{
    function getAllArtists()
    {
        try {
            $stmt = $this->connection->prepare("SELECT artistID,`description`,`image`,`name` FROM JazzArtists");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'jazzArtist');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}