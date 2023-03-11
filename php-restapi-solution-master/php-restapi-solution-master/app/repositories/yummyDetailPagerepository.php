<?php
include_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/yummyRestaurant.php';
require_once __DIR__ . '/../models/restaurantImage.php';
require_once __DIR__ . '/../models/restaurantMenuItem.php';

class YummyDetailPageRepository extends Repository
{
    function getAll() {
        try {
            $stmt = $this->connection->prepare(" 
            SELECT * 
            FROM YummyRestaurants
            ");

            // SELECT r.*, m.-----, m.----
            // FROM yummyRestaurants r
            // JOIN restaurantMenuItems m ON r.restaurantId = m.restaurantId

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();
    
            $restaurants = [];
            foreach($results as $row){
                $restaurant = new YummyRestaurant(

                    $row["restaurantID"],
                    $row['restaurantName'],
                    $row['address'],
                    $row['description'],
                    $row['amountOfStars'],
                    $row['bannerImage'],
                    $row['headChef'],
                    $row['amountSessions'],
                    $row['adultPrice'],
                    $row['childPrice'],
                    new DateTime($row['startTime']),
                    new DateTime($row['duration'])
                );
                array_push($restaurants, $restaurant);
            }
            return $restaurants;
    
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function getOne($restaurantId) {
        try {
            $stmt = $this->connection->prepare(" 
            SELECT * 
            FROM YummyRestaurants WHERE restaurantId = :_restaurantId
            ");

            // Bind the parameter value to the placeholder
            $stmt->bindParam(':_restaurantId', $restaurantId);

            // SELECT r.*, m.-----, m.----
            // FROM yummyRestaurants r
            // JOIN restaurantMenuItems m ON r.restaurantId = m.restaurantId

            
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();
    
            $restaurants = [];
            foreach($results as $row){
                $restaurant = new YummyRestaurant(

                    $row["restaurantID"],
                    $row['restaurantName'],
                    $row['address'],
                    $row['description'],
                    $row['amountOfStars'],
                    $row['bannerImage'],
                    $row['headChef'],
                    $row['amountSessions'],
                    $row['adultPrice'],
                    $row['childPrice'],
                    new DateTime($row['startTime']),
                    new DateTime($row['duration'])
                );                
                array_push($restaurants, $restaurant);
                
            }
            return $restaurants;
    
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    function getMenuItems($restaurantId) {
        try {
            $stmt = $this->connection->prepare(" 
            SELECT * FROM `RestaurantMenuItems` WHERE restaurantId = :_restaurantId
            ");

            // Bind the parameter value to the placeholder
            $stmt->bindParam(':_restaurantId', $restaurantId);

            // SELECT r.*, m.-----, m.----
            // FROM yummyRestaurants r
            // JOIN restaurantMenuItems m ON r.restaurantId = m.restaurantId

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();
    
            $menus = [];
            foreach($results as $row){
                $menu = new RestaurantMenuItem(

                    $row["menuItemID"],
                    $row["restaurantID"],
                    $row['courseID'],
                    $row['name'],
                    $row['description'],
                    $row['price'],
                    $row['specialty']  
                );
                array_push($menus, $menu);
            }
            return $menus;
    
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    function getImages($restaurantId) {
        try {
            $stmt = $this->connection->prepare(" 
            SELECT * FROM `RestaurantImages` WHERE restaurantId = :_restaurantId
            ");

            // Bind the parameter value to the placeholder
            $stmt->bindParam(':_restaurantId', $restaurantId);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();
    
            $images = [];
            foreach($results as $row){
                $image = new RestaurantImage(

                    $row["imageID"],
                    $row["restaurantID"],
                    $row['imageLink'],
                    $row['imageIndex']
                );
                array_push($images, $image);
            }
            return $images;
    
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
?>
