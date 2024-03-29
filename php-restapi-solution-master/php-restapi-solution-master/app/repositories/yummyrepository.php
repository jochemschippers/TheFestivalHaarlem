<?php
include_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/timeslot.php';
require_once __DIR__ . '/../models/foodtype.php';
require_once __DIR__ . '/../models/timeslotsyummy.php';
require_once __DIR__ . '/../models/yummyrestaurant.php';
require_once __DIR__ . '/../models/restaurantimage.php';
require_once __DIR__ . '/../models/restaurantmenuitem.php';
require_once __DIR__ . '/../models/restaurantfoodtype.php';
require_once __DIR__ . '/../models/restaurantreservation.php';

class YummyRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT `restaurantID`, `restaurantName`, `address`, `contact`, `cardDescription`,
            `description`, `amountOfStars`, `bannerImage`, `headChef`, `amountSessions`,
            `adultPrice`, `childPrice`
            FROM YummyRestaurants
            ");

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
            SELECT `restaurantID`, `restaurantName`, `address`, `contact`, `cardDescription`, `description`,
            `amountOfStars`, `bannerImage`, `headChef`, `amountSessions`, `adultPrice`, `childPrice`
            FROM YummyRestaurants WHERE restaurantId = :_restaurantId
            ");

            // Bind the parameter value to the placeholder
            $stmt->bindParam(':_restaurantId', $restaurantId);

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
            SELECT `menuItemID`, `restaurantID`, `courseID`, `name`, `description`, `price`, `specialty`
            FROM `RestaurantMenuItems`
            ");

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
            SELECT `menuItemID`, `restaurantID`, `courseID`, `name`, `description`, `price`, `specialty`
            FROM `RestaurantMenuItems` WHERE restaurantId = :_restaurantId
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
            SELECT `imageID`, `restaurantID`, `imageLink`, `imageIndex`
            FROM `RestaurantImages`
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
            SELECT `imageID`, `restaurantID`, `imageLink`, `imageIndex`
            FROM `RestaurantImages` WHERE restaurantId = :_restaurantId
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

    public function getAllRestaurantReservations()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT `r.ticketID`, `r.timeSlotID`, `s.restaurantID` ,`r.reservationName`, `r.phoneNumber`, `r.numberAdults`,
            `r.numberChildren`, `r.remark`, `r.isActive` FROM `RestaurantReservation` AS r JOIN TimeSlotsYummy AS t ON t.timeSlotID = r.timeSlotID
            ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $reservations = [];
            foreach ($results as $row) {
                $reservation = new Restaurantreservation(
                    $row["ticketID"],
                    $row["timeSlotID"],
                    $row["restaurantID"],
                    $row["reservationName"],
                    $row["phoneNumber"],
                    $row["numberAdults"],
                    $row["numberChildren"],
                    $row["remark"],
                    $row["isActive"],
                );
                array_push($reservations, $reservation);
            }
            return $reservations;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllTimeSlots()
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT `timeSlotID`, `eventID`, `price`, `startTime`, `endTime`, `maximumAmountTickets` FROM `TimeSlots`
            ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $timeSlots = [];
            foreach ($results as $row) {
                $timeSlot = new TimeSlot(

                    $row["timeSlotID"],
                    $row["eventID"],
                    $row["price"],
                    new DateTime($row["startTime"]),
                    new DateTime($row["endTime"]),
                    $row["maximumAmountTickets"]
                );
                array_push($timeSlots, $timeSlot);
            }
            return $timeSlots;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllRestaurantTimeSlotsYummy(){
        try {
            // query
            $stmt = $this->connection->prepare("
            SELECT s.timeSlotID, r.restaurantID, s.eventID, s.price, s.startTime, s.endTime, s.maximumAmountTickets,
            r.restaurantID FROM TimeSlots AS s JOIN TimeSlotsYummy AS r ON r.timeSlotID = s.timeSlotID
            ");
 //HIER NU FF RESTAURANT ID FIXEN
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
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

    public function getRestaurantReservationInfo($restaurantId)
    {
        try {
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


    // --------------- C.R.U.D ADMINISTRATOR C.R.U.D.-----------------

    // ---------------------- YUMMYRESTAURANT ------------------------

    public function createRestaurant($restaurant)
    {
        // creates a new restaurant
        try {
            // query
            $stmt = $this->connection->prepare("INSERT INTO `YummyRestaurants` (`restaurantName`, `address`, `contact`,
            `cardDescription`, `description`, `amountOfStars`, `bannerImage`, `headChef`, `amountSessions`,
            `adultPrice`, `childPrice`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

            // input
            $stmt->execute([
                $restaurant->getRestaurantName(), $restaurant->getAddress(), $restaurant->getContact(),
                $restaurant->getCardDescription(), $restaurant->getDescription(), $restaurant->getAmountOfStars(),
                $restaurant->getBannerImage(), $restaurant->getHeadChef(), $restaurant->getAmountSessions(),
                $restaurant->getAdultPrice(), $restaurant->getChildPrice()
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

            $stmt = $this->connection->prepare("UPDATE `YummyRestaurants` SET `restaurantName` = ?, `address` = ?,
            `contact` = ?, `cardDescription` = ?, `description` = ?, `amountOfStars` = ?, `bannerImage` = ?,
            `headChef` = ?, `amountSessions` = ?, `adultPrice` = ?, `childPrice` = ? WHERE `restaurantID` = ?");

            // input
            $stmt->execute([
                $update->getRestaurantName(), $update->getAddress(), $update->getContact(),
                $update->getCardDescription(), $update->getDescription(), $update->getAmountOfStars(),
                $update->getBannerImage(), $update->getHeadChef(), $update->getAmountSessions(),
                $update->getAdultPrice(), $update->getChildPrice(), $update->getRestaurantID()
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function deleteRestaurant($delete)
    {
        // this will delete a existing restaurant
        try {
            $stmt = $this->connection->prepare("DELETE FROM `YummyRestaurants` WHERE restaurantID = ?");
            $stmt->execute([$delete]);

            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
    // ---------------------- END YUMMYRESTAURANT ------------------------

    // ---------------------- Reservations ------------------------

    public function createReservation($reservation)
    {
        // creates a new reservation
        try {
            // query
            $stmt = $this->connection->prepare("
            INSERT INTO `RestaurantReservation`(`timeSlotID`, `reservationName`, `phoneNumber`, `numberAdults`, `numberChildren`, `remark`, `isActive`) 
            VALUES (?,?,?,?,?,?,1)
            ");
            // input
            // Bind the parameter value to the placeholder
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute([
                $reservation->getTimeSlotID(),
                $reservation->getReservationName(),
                $reservation->getPhoneNumber(),
                $reservation->getNumberAdults(),
                $reservation->getNumberChildren(),
                $reservation->getRemark(),
                // Making a reservations is always active(in het begin). So we put bit 1
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function editReservation($update)
    {
        // this updates a existing reservation
        try {
            // query
            $stmt = $this->connection->prepare("UPDATE `RestaurantReservation` SET
            `timeSlotID`=?, `reservationName`=?, `phoneNumber`=?,
            `numberAdults`=?, `numberChildren`=?, `remark`=?, `isActive`=1 WHERE `ticketID`=?");

            // input
            $stmt->execute([
                $update->getTimeSlotID(), $update->getReservationName(), $update->getPhoneNumber(),
                $update->getNumberAdults(), $update->getNumberChildren(), $update->getRemark(), $update->getTicketID()
            ]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }


    public function activateReservation($activate)
    {
        // this will activate a existing reservation
        try {
            $stmt = $this->connection->prepare("UPDATE `RestaurantReservation` SET `isActive` = 1 WHERE `ticketID` = ?");
            $stmt->execute([$activate]);

            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function deactivateReservation($deactivate)
    {
        // this will deactivate a existing reservation
        try {
            $stmt = $this->connection->prepare("UPDATE `RestaurantReservation` SET `isActive` = 0 WHERE `ticketID` = ?");
            $stmt->execute([$deactivate]);

            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }
    // ---------------------- END Reservations ------------------------

    // ---------------------- TimeSlotsYummy------------------------

    public function getAllTimeSlotsYummy()
    {
        try {
            $stmt = $this->connection->prepare(" SELECT `timeSlotID`, `restaurantID` FROM `TimeSlotsYummy` ");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $results = $stmt->fetchAll();

            $timeSlots = [];
            foreach ($results as $row) {
                $timeSLot = new TimeSlotsYummy(
                    $row["timeSlotID"],
                    $row['restaurantID']
                );
                array_push($timeSlots, $timeSLot);
            }
            return $timeSlots;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneTimeSlotsYummy($restaurantID)
    {
        try {
            $stmt = $this->connection->prepare(" SELECT `timeSlotID`, `restaurantID` FROM `TimeSlotsYummy` WHERE `restaurantID = ?");

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($restaurantID);
            $results = $stmt->fetchAll();

            $timeSlots = [];
            foreach ($results as $row) {
                $timeSLot = new TimeSlotsYummy(
                    $row["timeSlotID"],
                    $row['restaurantID']
                );
                array_push($timeSlots, $timeSLot);
            }
            return $timeSlots;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function createTimeSlotsYummy()
    {
        /**Create per amount sessions?
         * Moet ik hier een foreach loop gebruiken om zo de variabelen er in te krijgen?
         * Zal ik de starttime en end time eerst moeten maken in TimeSlots? Zeker verwacht ik.
         */
    }

    public function editTimeSlotsYummy()
    {
        /**Gebruik zelfde logica als bij create */
    }

    private function deleteTimeSlotsYummy($restaurantID, $tsID)
    {
        /**Hier gewoon geselecteerde timeslots verwijderen.
         * Kan gewoon per 1 want de applicatie gaat niet dood als er 1 mist.
         * Dit werkt met delete session. Zodra er minder sessions zijn gaan de timeslots er uit.
         */

        //This deletes timeSlotsYummy where id =
        try {
            $stmt = $this->connection->prepare("DELETE FROM `TimeSlotsYummy` WHERE timeSlotID = ? AND WHERE restaurantID = ?");
            $stmt->execute([$tsID, $restaurantID]);

            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    // ---------------------- END TimeSlotsYummy ------------------------



}
