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
CREATE TABLE `RestaurantFoodTypes` (
	`foodType` INT,
	`restaurantID` INT,

	PRIMARY KEY (`restaurantID`, `foodType`),
  	FOREIGN KEY (restaurantID) REFERENCES YummyRestaurants(restaurantID)
);
CREATE TABLE `RestaurantImages` (
	`imageID` INT NOT NULL,
	`restaurantID` INT,
	`imageLink` VARCHAR(90),
	`imageIndex` INT,
	PRIMARY KEY (`imageID`),
  	FOREIGN KEY (restaurantID) REFERENCES YummyRestaurants(restaurantID)
);
CREATE TABLE `RestaurantMenuItems` (
	`menuItemID` INT NOT NULL,
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
	`artistID` INT NOT NULL,
	`description` VARCHAR(1500),
	`image` VARCHAR(90),
	`name` VARCHAR(90),
	PRIMARY KEY (`artistID`)
);
CREATE TABLE `JazzLocation` (
	`locationID` INT NOT NULL,
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
	FOREIGN KEY (`locationID`) REFERENCES JazzLocation(locationID)
);




CREATE TABLE `FestivalEvents` (
	`eventID` INT NOT NULL,
	`eventTitle` VARCHAR(45),
	`bannerImage` VARCHAR(90),
	`bannerDescription` VARCHAR(1500),
	PRIMARY KEY (`eventID`)
);



CREATE TABLE `timeSlots` (
	`timeSlotID` INT NOT NULL,
	`eventID` INT,
	`price` FLOAT,
	`startTime` DATETIME,
	`endTime` DATETIME,
	`maximumAmountTickets` INT,
	PRIMARY KEY (`timeSlotID`),
	FOREIGN KEY (`eventID`) REFERENCES FestivalEvents(`eventID`)
);
CREATE TABLE `eventTickets` (
	`ticketID` INT NOT NULL,
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
	`hallID` INT,
	PRIMARY KEY (`timeSlotID`),
  	FOREIGN KEY (timeSlotID) REFERENCES timeSlots(timeSlotID),
  	FOREIGN KEY (artistID) REFERENCES JazzArtists(artistID)
);
CREATE TABLE `JazzAlbums` (
	`artistID` INT NOT NULL,
	`albumID` INT NOT NULL,
	`image` VARCHAR(90),
	`title` VARCHAR(120),
	`spotifyLink` VARCHAR(120),
	`appleLink` VARCHAR(120),
	PRIMARY KEY (`albumID`),
  	FOREIGN KEY (artistID) REFERENCES JazzArtists(artistID)
);
CREATE TABLE `Languages` (
	`languageID` INT NOT NULL,
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
	`guideID` INT NOT NULL,
	`guideName` VARCHAR(45),
	`languageID` INT,
	PRIMARY KEY (`guideID`),
  	FOREIGN KEY (languageID) REFERENCES Languages(languageID)
);
CREATE TABLE `StaticPage` (
	`pageID` INT NOT NULL,
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
	`landMarkID` INT NOT NULL,
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
