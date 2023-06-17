<?php
include_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/api.php';

class ApiRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT `ApiID`, `APIName`, `APIKEY`
            FROM APIs
            ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $apis = [];
            foreach ($results as $row) {
                $api = new Api(

                    $row["ApiID"],
                    $row['APIName'],
                    $row['APIKEY']
                );
                array_push($apis, $api);
            }
            return $apis;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function getMollie(){
         try {
            // query
            $stmt = $this->connection->prepare("SELECT APIKEY FROM APIs WHERE APIName = ?");

            return $stmt->execute(['Mollie']);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    
    public function create($data)
    {
        // creates a new api
        try {
            // query
            $stmt = $this->connection->prepare("INSERT INTO `APIs` (`APIName`, `APIKEY`) VALUES (?,?)");

            // input
            $stmt->execute([
                $data->getApiName(), $data->getApiKey()
            ]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function update($data)
    {
        // this updates an existing api
        try {
            // query
            $stmt = $this->connection->prepare("UPDATE `APIs` SET `APIName` = ?, `APIKEY` = ? WHERE `ApiID` = ?");

            // input
            $stmt->execute([
                $data->getApiName(), $data->getApiKey(), $data->getApiID()
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function delete($data)
    {
        // this will delete a existing api
        try {
            $stmt = $this->connection->prepare("DELETE FROM `APIs` WHERE ApiID = ?");
            $stmt->execute([$data]);

            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
}