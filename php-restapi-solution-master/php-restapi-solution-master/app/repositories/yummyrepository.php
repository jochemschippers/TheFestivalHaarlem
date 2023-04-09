<?php
include_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/foodType.php';
require_once __DIR__ . '/../models/timeSlot.php';
require_once __DIR__ . '/../models/timeSlotsYummy.php';
require_once __DIR__ . '/../models/yummyRestaurant.php';
require_once __DIR__ . '/../models/restaurantImage.php';
require_once __DIR__ . '/../models/restaurantMenuItem.php';
require_once __DIR__ . '/../models/restaurantFoodType.php';
require_once __DIR__ . '/../models/restaurantReservation.php';

class YummyRepository extends Repository
{
    function getAll()
    {
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
            foreach ($results as $row) {
                $restaurant = new YummyRestaurant(

                    $row["restaurantID"],
                    $row['restaurantName'],
                    $row['address'],
                    $row['contact'],
                    $row['cardDescription'],
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
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($restaurantId)
    {
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
            foreach ($results as $row) {
                $restaurant = new YummyRestaurant(

                    $row["restaurantID"],
                    $row['restaurantName'],
                    $row['address'],
                    $row['contact'],
                    $row['cardDescription'],
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
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllMenuItems()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT * FROM `RestaurantMenuItems`
            ");


            // SELECT r.*, m.-----, m.----
            // FROM yummyRestaurants r
            // JOIN restaurantMenuItems m ON r.restaurantId = m.restaurantId

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $menus = [];
            foreach ($results as $row) {
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
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getMenuItems($restaurantId)
    {
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
            foreach ($results as $row) {
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
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAllImages()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT * FROM `RestaurantImages`
            ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $images = [];
            foreach ($results as $row) {
                $image = new RestaurantImage(

                    $row["imageID"],
                    $row["restaurantID"],
                    $row['imageLink'],
                    $row['imageIndex']
                );
                array_push($images, $image);
            }
            return $images;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getImages($restaurantId)
    {
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
            foreach ($results as $row) {
                $image = new RestaurantImage(

                    $row["imageID"],
                    $row["restaurantID"],
                    $row['imageLink'],
                    $row['imageIndex']
                );
                array_push($images, $image);
            }
            return $images;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAllFoodTypes()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT *
            FROM `FoodTypes`
            ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $types = [];
            foreach ($results as $row) {
                $type = new FoodType(
                    $row["foodTypeID"],
                    $row['foodTypeName']
                );
                array_push($types, $type);
            }
            return $types;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAllRestaurantFoodTypes()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT r.*, f.foodTypeName
            FROM RestaurantFoodTypes r
            JOIN FoodTypes f ON r.foodType = f.foodTypeId
            ");

            // Bind the parameter value to the placeholder

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $types = [];
            foreach ($results as $row) {
                $type = new RestaurantFoodType(

                    $row["foodType"],
                    $row["restaurantID"],
                    $row['foodTypeName']
                );
                array_push($types, $type);
            }
            return $types;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getRestaurantReservationInfo($restaurantId)
    {
        try {

            /**ZO GAAT HET NU WERKEN
             * 1. FILTER TIMESLOTS OP EVENT ID
             * 2. TIMESLOTSRESTAURANT
             * 3. WHERE EVENTID = 2
             * 4. AND WHERE RESTAURANTID = ?
             * 5. GEBRUIK DEZE ARRAY OM DE TIMESLOT EN SESSION TE FILTEREN.
             */

            // query
            $stmt = $this->connection->prepare("
            SELECT s.timeSlotID, s.eventID, s.price, s.startTime, s.endTime, s.maximumAmountTickets,
            r.restaurantID FROM TimeSlots AS s JOIN TimeSlotsYummy AS r ON r.timeSlotID = s.timeSlotID
            WHERE r.restaurantID = ?");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute([$restaurantId]);
            $results = $stmt->fetchAll();

            $restaurantSlots = [];
            foreach ($results as $row) {
                $restaurantSlot = new TimeSlotsYummy(
                    $row["timeSlotID"],
                    $row['restaurantID'],
                    $row['eventID'],
                    $row['price'],
                    $row['startTime'],
                    $row['endTime'],
                    $row['maximumAmountTickets'],
                );
                array_push($restaurantSlots, $restaurantSlot);
            }
            return $restaurantSlots;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function createReservation($reservation)
    {
        // creates a new reservation

        //stap 1 werkend   >>>>>>> //INSERT INTO `timeSlots` (`timeSlotID`, `eventID`, `price`, `startTime`, `endTime`, `maximumAmountTickets`) VALUES ('5', '2', '10', '2023-07-26 17:00:00', '2023-07-26 18:30:00', '1');
        //stap 2 werkend   >>>>>>> //INSERT INTO `RestaurantReservations` (`timeSlotID`, `restaurantID`, `customerName`, `phoneNumber`, `numberAdults`, `numberChildren`, `remark`) VALUES ('5', '2', 'mark', '85675654', '1', '3', 'ik wil graag in een hoekje zitten');
        //stap 3 werkend  auto increment programID? of foreign key maken? >>>>>>> // INSERT INTO `eventTickets` (`ticketID`, `timeSlotID`, `programID`) VALUES ('6', '5', '2');
        // personal program kan ik niks aan doen. heeft namelijk nog eeen klass nodig.

        // $modelReservation = "'timeSlotID', 'restaurantID', 'customerName', 'phoneNumber', 'numberAdults', 'numberChildren', 'remark'";

        // gebruik restaurantReservation, Timeslots, eventTickets en personalProgram. gebruik join
        try {
            // query
            $stmt = $this->connection->prepare("
            INSERT INTO TimeSlotsYummy (`timeSlotID`, `restaurantID`, `reservationName`, `phoneNumber`, `numberAdults`, `numberChildren`, `remark`, `isActive`)
            VALUES (?,?,?,?,?,?,?,?)
            ");
            // input
            // Bind the parameter value to the placeholder
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($reservation->getTimeSlotID(), $reservation->getRestaurantID(), $reservation->getCustomerName(),
            $reservation->getPhoneNumber(), $reservation->getNumberAdults(), $reservation->getNumberChildren(), $reservation->getRemark(), 1);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // ----------------------  ADMINISTRATOR -------------------------

    // ---------------------- YUMMYRESTAURANT ------------------------

    public function createRestaurant($restaurant)
    {
        // creates a new restaurant
        try {
            // query
            $stmt = $this->connection->prepare("INSERT INTO `YummyRestaurants` (`restaurantName`, `address`, `contact`,
            `cardDescription`, `description`, `amountOfStars`, `bannerImage`, `headChef`, `amountSessions`,
            `adultPrice`, `childPrice`, `startTime`, `duration`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

            // input
            $stmt->execute([
                $restaurant->getRestaurantName(), $restaurant->getAddress(), $restaurant->getContact(),
                $restaurant->getCardDescription(), $restaurant->getDescription(), $restaurant->getAmountOfStars(),
                $restaurant->getBannerImage(), $restaurant->getHeadChef(), $restaurant->getAmountSessions(),
                $restaurant->getAdultPrice(), $restaurant->getChildPrice(), $restaurant->getStartTime()->format('Y-m-d H:i:s'), $restaurant->getDuration()->format('H:i:s')
            ]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateRestaurant($update)
    {
        // this updates a existing restaurant
        try {
            // query
            $stmt = $this->connection->prepare("UPDATE `YummyRestaurants` SET 'restaurantName' = ?, 'address' = ?,
            'contact' = ?, 'cardDescription' = ?, 'description' = ?, 'amountOfStars' = ?, 'bannerImage' = ?,
            'headChef' = ?, 'amountSessions' = ?, 'adultPrice' = ?, 'childPrice' = ?, 'startTime' = ?,
            'duration' = ? WHERE restaurantID = ?");


            // input
            $stmt->execute([
                $update->getRestaurantName(), $update->getAddress(), $update->getContact(),
                $update->getCardDescription(), $update->getDescription(), $update->getAmountOfStars(),
                $update->getBannerImage(), $update->getHeadChef(), $update->getAmountSessions(),
                $update->getAdultPrice(), $update->getChildPrice(), $update->getStartTime()->format('Y-m-d H:i:s'),
                $update->getDuration()->format('H:i:s'), $update->getRestaurantID()
            ]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteRestaurant($delete)
    {
        // this will delete a existing restaurant
        try {
            $stmt = $this->connection->prepare("DELETE FROM `YummyRestaurants` WHERE restaurantID = ?");
            $stmt->execute([$delete]);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
