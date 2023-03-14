<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/landmark.php';

class LandmarkRepository extends Repository 
{
    function getAllLandmarks()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM LandMarks");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Landmark');
            $landmarks = $stmt->fetchAll();
            
            return $landmarks;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // Create a new landmark
    function createLandmark($title, $description, $image)
    {
        try {
          $stmt = $this->connection->prepare("INSERT INTO LandMarks (title, description, image) VALUES (?,?,?)");
          $stmt->execute([$title, $description, $image]);
        } catch (PDOException $e) {
          echo $e;
        }
    }

    // Update a landmark
    function updateLandmark($landmarkID, $title, $description, $image) 
    {
        try {
          $stmt = $this->connection->prepare("UPDATE LandMarks SET title = ?, description = ?, image = ? WHERE landmarkID = ?");
          $stmt->execute([$title, $description, $image, $landmarkID]);
        } catch (PDOException $e) {
          echo $e;
        }
    }

    // Delete a landmark
    function deleteLandmark($landmarkID) 
    {
        try {
          $stmt = $this->connection->prepare("DELETE FROM LandMarks WHERE landmarkID = ?");
          $stmt->execute([$landmarkID]);
        } catch (PDOException $e) {
          echo $e;
        }
    }

    // Get a landmark by ID
    function getLandmark($landmarkID) 
    {
        try {
          $stmt = $this->connection->prepare("SELECT * FROM LandMarks WHERE landmarkID = ?");
          $stmt->execute([$landmarkID]);
          $stmt->setFetchMode(PDO::FETCH_CLASS, 'Landmark');
          return $stmt->fetch();
        } catch (PDOException $e) {
          echo $e;
        }
    }
}

?>