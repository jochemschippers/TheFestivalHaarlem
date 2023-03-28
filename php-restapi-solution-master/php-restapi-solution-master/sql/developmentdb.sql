-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 30, 2021 at 02:48 PM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

-- CREATE TABLE `article` (
--   `id` int(11) NOT NULL,
--   `title` varchar(255) NOT NULL,
--   `content` varchar(10000) NOT NULL,
--   `author` varchar(255) NOT NULL,
--   `posted_at` datetime NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE DATABASE thefestivaldb;
USE thefestivaldb;
CREATE TABLE `FestivalInformation` (
	`festivalID` INT NOT NULL AUTO_INCREMENT,
	`startDate` DATETIME NOT NULL,
	`endDate` DATETIME NOT NULL,
	`reservationFee` FLOAT NOT NULL,
	PRIMARY KEY (`festivalID`)
);

CREATE TABLE `Users` (
	`userID` INT NOT NULL AUTO_INCREMENT,
	`userName` VARCHAR(45) NOT NULL,
	`email` VARCHAR(45) NOT NULL,
	`userRole` INT NOT NULL,
	`fullName` VARCHAR(90) NOT NULL,
	`phoneNumber` VARCHAR(20) NOT NULL,
	`password` VARCHAR(90) NOT NULL,
	PRIMARY KEY (`userID`)
);
CREATE TABLE `PersonalPrograms` (
	`programID` INT NOT NULL AUTO_INCREMENT,
	`userID` INT,
	`paymentMethod` INT NOT NULL,
	`isPaid` BIT NOT NULL,
	PRIMARY KEY (`programID`),
  	FOREIGN KEY (userID) REFERENCES Users(userID)

);
CREATE TABLE `YummyRestaurants` (
	`restaurantID` INT NOT NULL AUTO_INCREMENT,
	`restaurantName` VARCHAR(90) NOT NULL,
	`address` VARCHAR(250) NOT NULL,
	`description` VARCHAR(250) NOT NULL,
	`amountOfStars` INT NOT NULL,
	`bannerImage` VARCHAR(90) NOT NULL,
	`headChef` VARCHAR(90) NOT NULL,
	`startTime` DATETIME,
	`duration` DATETIME NOT NULL,
	`amountSessions` INT NOT NULL,
	`adultPrice` FLOAT NOT NULL,
	`childPrice` FLOAT NOT NULL,
	PRIMARY KEY (`restaurantID`)
);
CREATE TABLE `FoodTypes`(
	`FoodTypeID` INT NOT NULL,
	`FoodTypeName` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`FoodTypeID`)
);
INSERT INTO `FoodTypes` (`FoodTypeID`, `FoodTypeName`) VALUES
(0, 'Dutch'),
(1, 'Seafood'),
(2, 'French'),
(3, 'European');
CREATE TABLE `RestaurantFoodTypes` (
	`foodType` INT,
	`restaurantID` INT,

	PRIMARY KEY (`restaurantID`, `foodType`),
  	FOREIGN KEY (restaurantID) REFERENCES YummyRestaurants(restaurantID),
	FOREIGN KEY (`foodType`) REFERENCES FoodTypes(FoodTypeID)
);
CREATE TABLE `RestaurantImages` (
	`imageID` INT NOT NULL AUTO_INCREMENT,
	`restaurantID` INT,
	`imageLink` VARCHAR(90),
	`imageIndex` INT,
	PRIMARY KEY (`imageID`),
  	FOREIGN KEY (restaurantID) REFERENCES YummyRestaurants(restaurantID)
);
CREATE TABLE `RestaurantMenuItems` (
	`menuItemID` INT NOT NULL AUTO_INCREMENT,
	`restaurantID` INT,
	`courseID` INT,
	`name` VARCHAR(90),
	`description` VARCHAR(1500),
	`price` FLOAT,
	`foodType` INT,
	PRIMARY KEY (`menuItemID`),
  	FOREIGN KEY (restaurantID) REFERENCES YummyRestaurants(restaurantID)
);




CREATE TABLE `JazzArtists` (
	`artistID` INT NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(1500),
	`image` VARCHAR(90),
	`name` VARCHAR(90),
	PRIMARY KEY (`artistID`)
);
CREATE TABLE `JazzLocations` (
	`locationID` INT NOT NULL AUTO_INCREMENT,
	`locationName` VARCHAR(45) NOT NULL,
	`address` VARCHAR(250),
	`locationImage` VARCHAR(90),
	`toAndFromText` VARCHAR(1500),
	`accessibillityText` VARCHAR(1500),
	PRIMARY KEY (`locationID`)
);
CREATE TABLE `Halls`(
	`hallID` INT NOT NULL,
	`locationID` INT,
	`hallName` VARCHAR(90),
	PRIMARY KEY (`hallID`),
	FOREIGN KEY (`locationID`) REFERENCES JazzLocations(locationID)
);

ALTER TABLE `thefestivaldb`.`Halls` DROP PRIMARY KEY, ADD PRIMARY KEY (`hallID`, `locationID`) USING BTREE; 


CREATE TABLE `FestivalEvents` (
	`eventID` INT NOT NULL AUTO_INCREMENT,
	`eventTitle` VARCHAR(45),
	`bannerImage` VARCHAR(90),
	`bannerDescription` VARCHAR(1500),
	PRIMARY KEY (`eventID`)
);



CREATE TABLE `timeSlots` (
	`timeSlotID` INT NOT NULL AUTO_INCREMENT,
	`eventID` INT,
	`price` FLOAT,
	`startTime` DATETIME,
	`endTime` DATETIME,
	`maximumAmountTickets` INT,
	PRIMARY KEY (`timeSlotID`),
	FOREIGN KEY (`eventID`) REFERENCES FestivalEvents(`eventID`)
);
CREATE TABLE `eventTickets` (
	`ticketID` INT NOT NULL AUTO_INCREMENT,
	`timeSlotID` INT,
	`programID` INT,
	PRIMARY KEY (`ticketID`),
  	FOREIGN KEY (timeSlotID) REFERENCES timeSlots(timeSlotID)
);
CREATE TABLE `RestaurantReservations` (
	`timeSlotID` INT NOT NULL,
	`restaurantID` INT,
	`customerName` VARCHAR(45),
	`phoneNumber` VARCHAR(20),
	`numberAdults` int,
	`numberChildren` int,
	`remark` VARCHAR(300),
	PRIMARY KEY (`timeSlotID`),
  	FOREIGN KEY (timeSlotID) REFERENCES timeSlots(timeSlotID),
  	FOREIGN KEY (restaurantID) REFERENCES YummyRestaurants(restaurantID)
);
CREATE TABLE `TimeSlotsJazz` (
	`timeSlotID` INT NOT NULL,
	`artistID` INT,
	`locationID` INT,
	`hallID` INT,
	PRIMARY KEY (`timeSlotID`),
  	FOREIGN KEY (timeSlotID) REFERENCES timeSlots(timeSlotID),
  	FOREIGN KEY (artistID) REFERENCES JazzArtists(artistID),
	FOREIGN KEY (locationID) REFERENCES JazzLocations(locationID),
	FOREIGN KEY (hallID) REFERENCES Halls(`hallID`)
);
CREATE TABLE `JazzAlbums` (
	`artistID` INT NOT NULL,
	`albumID` INT NOT NULL AUTO_INCREMENT,
	`image` VARCHAR(90),
	`title` VARCHAR(120),
	`spotifyLink` VARCHAR(120),
	`appleLink` VARCHAR(120),
	PRIMARY KEY (`albumID`),
  	FOREIGN KEY (artistID) REFERENCES JazzArtists(artistID)
);



CREATE TABLE `Languages` (
	`languageID` INT NOT NULL AUTO_INCREMENT,
	`language` VARCHAR(45),
	`languageFlag` VARCHAR(90),
	`guideID` INT,
	PRIMARY KEY (`languageID`)
);
CREATE TABLE `TimeSlotsStrollThroughHistory` (
	`timeSlotID` INT NOT NULL,
	`languageID` INT,
	`GuideID` INT,
	PRIMARY KEY (`timeSlotID`),
  	FOREIGN KEY (languageID) REFERENCES Languages(languageID)
);
CREATE TABLE `Guides` (
	`guideID` INT NOT NULL AUTO_INCREMENT,
	`guideName` VARCHAR(45),
	`languageID` INT,
	PRIMARY KEY (`guideID`),
  	FOREIGN KEY (languageID) REFERENCES Languages(languageID)
);




CREATE TABLE `StaticPage` (
	`pageID` INT NOT NULL AUTO_INCREMENT,
	`bannerImage` VARCHAR(90),
	`title` VARCHAR(90),
	`secondTitle` VARCHAR(250),
	`description` VARCHAR(1500),
	PRIMARY KEY (`pageID`)
);





CREATE TABLE `History` (
	`eventID` INT NOT NULL,
	`landMarkID` INT,
	`practicalDescription` VARCHAR(1500),
	`guideDescription` VARCHAR(1500),
	`scheduleDescription` VARCHAR(1500),
    `locationMap` VARCHAR(250),
	PRIMARY KEY (`eventID`),
	FOREIGN KEY (`eventID`) REFERENCES FestivalEvents(`eventID`)
);
CREATE TABLE `LandMarks` (
	`landMarkID` INT NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(45),
	`description` VARCHAR(1500),
	`image` VARCHAR(90),
	PRIMARY KEY (`landMarkID`)
);
CREATE TABLE `HistoryDetailPages` (
	`landMarkID` INT NOT NULL,
	`description` VARCHAR(1500),
	`image` VARCHAR(45),
	`scheduleDescription` VARCHAR(1500),
	PRIMARY KEY (`landMarkID`),
	FOREIGN KEY (`landMarkID`) REFERENCES LandMarks(`landMarkID`)
);


ALTER TABLE `FestivalEvents` CHANGE `eventTitle` `eventName` VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;
ALTER TABLE `FestivalEvents` ADD `EventTitle` VARCHAR(150) NOT NULL AFTER `bannerDescription`;

INSERT INTO `FestivalEvents` (`eventName`, `bannerImage`, `bannerDescription`, `EventTitle`) VALUES ('Jazz', 'FILE HERE!', 'Haarlem Jazz is a premier annual event for all jazz lovers. With more than 10 years of experience in showcasing the best in local and international jazz talent, you’d be certain to experience a vibrant and lively atmosphere for music fans! ', 'The Haarlem Jazz Event'), ('Yummy', 'FILE HERE!', 'Explore every Food and Drink in this years Haarlem Yummy! event. Here its Eat first Talk later.\r\nCome and enjoy all culinary options Haarlem has to offer in this cities most versitile Food and Drink Festival.', 'Explore the TASTE of Haarlem'), ('Stroll Through History', 'FILE HERE!', 'See what cultural monuments the city of Haarlem has to offer and walk with one of our guides to get to know the stories behind them during our guided tour through the streets of Haarlem.', 'A Stroll Through History');

INSERT INTO `JazzLocations` (`locationName`, `address`, `locationImage`, `toAndFromText`, `accessibillityText`) VALUES
('Patronaat', 'Zijlsingel 2, 2013 DN Haarlem', '!FILE HERE', 'Patronaat is about 15 minutes walking distance from Haarlem station (a 1 km distance)\r\nAlternatively, you can take ride buses 340, 346 or 356 one stop to the Raaksburg. From there, it’ll be a minute on foot\r\nThere are also several parking options available, like the parking garage RAAKS, which is a 5 minute walk away from the Grote Markt.', 'Do you have a disability? We and our partners at the Patronaat strive to make your visit as comfortable and enjoyable as possible. \r\nTo see the facilities the patronaat has to offer, please download the \'Ongehinderd\' mobile app here and/or contact the patronaat through mail on info@patronaat.nl to discuss the options.'),
('Grote Markt', 'Grote Markt 2011 RD Haarlem\r\n', '!FILE HERE', 'Grote Markt is easily accessible by foot within just 10 minutes from the station (800m distance)\r\nIt is also accessible with buses 3, 73 or 300. Ride two stops for busses 3 and 73 to Ruychaverstraat, which is right next to the Grote Markt. For busline 300, ride one stop to Haarlem Centre/Verwulft\r\nThere are also several parking options available, like the parking garage De Appelaar, which is a 5 minute walk away from the Grote Markt', '\r\nDo you have a disability? The square is located at ground level and is easily accessible by wheelchair or other assistive devices\r\nMany of the shops and restaurants around the square have wheelchair ramps and other accessibility features\r\nAlso special toilets have been placed around the square in order to accommodate for people with disabilities');

ALTER TABLE `thefestivaldb`.`Halls` DROP PRIMARY KEY, ADD PRIMARY KEY (`hallID`, `locationID`) USING BTREE;

INSERT INTO `Halls` (`hallID`, `locationID`, `hallName`) VALUES
(0, 1, 'Main hall'),
(0, 2, 'Grote Markt'),
(1, 1, 'Second hall'),
(2, 1, 'Third hall');


INSERT INTO `JazzArtists` (`artistID`, `description`, `image`, `name`) VALUES
(0, 'Hans and Candy Dulfer are as a father-daughter duo both inseparable from their saxophones. Hans is a renowned saxophonist, known for his soulful and energetic performances, while Candy is a skilled saxophonist and flautist in her own right. Together, they have had multiple successful albums and have performed at some of the most prestigious jazz festivals around the world. ', '/image/jazz/candyAndHansDulfer.png', 'Candy and Hans Dulfer');


INSERT INTO `timeSlots` (`timeSlotID`, `eventID`, `price`, `startTime`, `endTime`, `maximumAmountTickets`) VALUES
(0, 1, 15, '2023-07-27 15:00:00', '2023-07-27 16:00:00', 300);


INSERT INTO `Users` (`userID`, `userName`, `email`, `userRole`, `fullName`, `phoneNumber`, `password`) VALUES
(1, 'harry', 'harry@harrymail.com', 1, 'harry', '0615448333', '$2y$10$7TTsjOmq2UJhFLY/6yoXCeE8cEnR5ddg3UmUI/tvsTCPvU5z5scUS');

INSERT INTO `TimeSlotsJazz` (`timeSlotID`, `artistID`, `locationID`, `hallID`) VALUES ('1', '1', '1', '0');







--
-- Dumping data for table `article`
--

-- INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
-- (1, 'test title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris porta mauris nisl, vel iaculis quam venenatis quis. Quisque id efficitur dui, eget tempor erat. Fusce hendrerit, sem non porttitor semper, nunc metus pharetra sem, a ultrices lorem leo nec arcu. Vestibulum at interdum velit. Suspendisse vulputate rutrum libero, id placerat ipsum lacinia eu. Fusce vel orci eget augue maximus rhoncus eu non nisl. Cras id sodales risus. Mauris sed ullamcorper lacus, a tempus orci. Donec dignissim ipsum at varius commodo. Nulla a sapien aliquam, maximus neque non, vehicula libero. Nulla a varius purus, at tincidunt diam. Morbi sed urna a diam pretium tincidunt nec at neque. Aliquam consectetur at turpis at consequat. Sed dapibus, quam vel faucibus malesuada, dui lectus lacinia felis, porta posuere dui odio id enim. Vivamus molestie pharetra leo, vitae mattis sapien congue non. Etiam dapibus, diam at interdum tempus, ligula augue commodo nulla, vel fermentum elit est vel justo.', 'test author', '2021-11-30 13:09:55');

-- INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
-- (2, 'test title', 'Donec fermentum porttitor metus, quis pulvinar elit ornare congue. Donec dapibus est ut metus fermentum ultricies. Ut eu turpis facilisis, dignissim sem porttitor, congue libero. Fusce volutpat facilisis interdum. Mauris vulputate ultricies mauris a facilisis. Maecenas tincidunt efficitur tincidunt. Etiam tempor maximus tincidunt.', 'test author', '2021-11-30 13:09:55');

-- INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
-- (3, 'test title', 'Mauris id feugiat lectus, ut efficitur tellus. Phasellus a arcu vel urna venenatis laoreet. Nullam congue sem ac erat aliquet, ac pulvinar felis fermentum. Sed rutrum nulla sit amet porta suscipit. Etiam consectetur mauris ac arcu scelerisque, ut blandit lectus porta. Pellentesque at ligula a lacus mattis laoreet. Nulla finibus volutpat velit a finibus. In nec condimentum erat. Aliquam erat volutpat. Vestibulum molestie finibus lorem quis egestas. Fusce id mi ac nisl vehicula laoreet. Cras molestie dolor eget nunc laoreet, et sodales velit mollis. Aliquam dignissim leo quis dolor varius, at molestie est hendrerit. Sed lorem tellus, rhoncus at dignissim ac, euismod id sem. Quisque facilisis felis eget ex mattis, sed pretium magna pulvinar. Etiam tincidunt sodales ultrices.', 'test author', '2021-11-30 13:09:55');

-- INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
-- (4, 'test title', 'Curabitur ultricies est malesuada ante laoreet condimentum. Nam ullamcorper, mi at dignissim dignissim, turpis tortor tristique ligula, sed rhoncus ipsum sapien sit amet lacus. Curabitur ligula risus, vulputate vel urna ac, gravida maximus erat. Nunc odio urna, sagittis non mi eu, semper tristique magna. Cras vitae mi nec ex sollicitudin hendrerit et vitae urna. Praesent posuere sem in lectus dignissim viverra. Vivamus neque metus, rhoncus ac arcu vel, eleifend molestie neque. Fusce eget varius massa. Praesent eleifend nunc leo, et pretium sapien volutpat a. Nulla consectetur facilisis sapien, at rhoncus nibh cursus maximus. Donec at eleifend lacus, quis mollis eros. Fusce dui augue, rutrum sit amet ipsum porttitor, convallis congue sapien.', 'test author', '2021-11-30 13:09:55');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
-- ALTER TABLE `article`
--   ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
-- ALTER TABLE `article`
--   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
