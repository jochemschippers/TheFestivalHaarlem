<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/festivalinformation.php';
require_once __DIR__ . '/../models/strollthroughhistory.php';
require_once __DIR__ . '/../models/landmark.php';


class HistoryRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM history");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'StrollThroughHistory');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($strollThroughHistory) {
        try {
            $stmt = $this->connection->prepare("INSERT into history (title, content, author, posted_at) VALUES (?,?,?, NOW())");
            
            $stmt->execute([$strollThroughHistory->getTitle(), $strollThroughHistory->getContent(), $strollThroughHistory->getAuthor()]);

        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM history WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function update($strollThroughHistory) {
        try {
            $stmt = $this->connection->prepare("UPDATE history SET title = ?, content = ?, author = ? WHERE id = ?");
            $stmt->execute([$strollThroughHistory->getTitle(), $strollThroughHistory->getContent(), $strollThroughHistory->getAuthor(), $strollThroughHistory->getId()]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function get($id) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM history WHERE id = ?");
            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'History');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
