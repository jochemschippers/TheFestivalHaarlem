<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/PDF.php';

class PDFRepository extends Repository
{
    // function getAll()
    // {
    //     try {
    //         $stmt = $this->connection->prepare("SELECT * FROM article");
    //         $stmt->execute();

    //         $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
    //         $PDF = $stmt->fetchAll();

    //         return $PDF;
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
