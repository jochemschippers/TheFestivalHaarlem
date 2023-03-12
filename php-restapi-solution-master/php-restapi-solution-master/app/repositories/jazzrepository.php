<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/jazzArtist.php';


class JazzRepository extends Repository
{
    function getAllArtists()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM landmark");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Landmark');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // function getAll()
    // {
    //     try {
    //         $stmt = $this->connection->prepare("SELECT * FROM festivalEvent");
    //         $stmt->execute();

    //         $stmt->setFetchMode(PDO::FETCH_CLASS, 'FestivalEvent');
    //         $festivalevents = $stmt->fetchAll();

    //         return $festivalevents;
    //     } catch (PDOException $e) {
    //         echo $e;
    //     }
    // }

    // function insert($article) {
    //     try {
    //         $stmt = $this->connection->prepare("INSERT into article (title, content, author, posted_at) VALUES (?,?,?, NOW())");
            
    //         $stmt->execute([$article->getTitle(), $article->getContent(), $article->getAuthor()]);

    //     } catch (PDOException $e) {
    //         echo $e;
    //     }
    // }
}