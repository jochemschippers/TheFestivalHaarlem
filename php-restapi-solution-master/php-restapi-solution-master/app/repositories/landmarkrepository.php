<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/landmark.php';

class LandmarkRepository extends Repository 
{
    function getAllLandmarks()
    {
        try {
            $stmt = $this->connection->prepare("SELECT landMarkID, 'title', 'description', 'image' FROM LandMarks");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $landmarks = [];
            foreach ($results as $row) {
                $landmark = new Landmark(
                    $row["landMarkID"],
                    $row['title'],
                    $row['description'],
                    $row['image']
                );
                array_push($landmarks, $landmark);
            }
            return $landmarks;
            
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // Create a new landmark
    function createLandmark($landmark)
    {
        try {
          $stmt = $this->connection->prepare("INSERT INTO `LandMarks` (`landMarkID`, `title`, `description`, `image`) VALUES (null, ?, ?, ?)");
          $stmt->execute([$landmark->getTitle(), $landmark->getDescription(), $landmark->getImage()]);

        } catch (PDOException $e) {
          echo $e;
        }
    }

    // Update a landmark
    function updateLandmark($landmark) 
    {
        try {
          $stmt = $this->connection->prepare("UPDATE LandMarks SET 'title' = ?, 'description' = ?, 'image' = ? WHERE landMarkID = ?");
          $stmt->execute([$landmark->getTitle(), $landmark->getDescription(), $landmark->getImage(), $landmark->getLandmarkID()]);
        } catch (PDOException $e) {
          echo $e;
        }
    }

    // Delete a landmark
    function deleteLandmark($landmarkID) 
    {
        try {
          $stmt = $this->connection->prepare("DELETE FROM LandMarks WHERE landMarkID = ?");
          $stmt->execute([$landmarkID]);
        } catch (PDOException $e) {
          echo $e;
        }
    }

    // Get a landmark by ID
    function getLandmark($landmarkID) 
    {
        try {
          $stmt = $this->connection->prepare("SELECT * FROM LandMarks WHERE landMarkID = ?");
          $stmt->execute([$landmarkID]);
          $stmt->setFetchMode(PDO::FETCH_CLASS, 'Landmark');
          return $stmt->fetch();

        } catch (PDOException $e) {
          echo $e;
        }
    }
}

?>