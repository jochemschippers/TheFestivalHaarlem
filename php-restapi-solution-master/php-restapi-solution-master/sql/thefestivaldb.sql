-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 13, 2023 at 04:02 PM
-- Server version: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thefestivaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `APIs`
--

CREATE TABLE `APIs` (
  `ApiID` int(11) NOT NULL,
  `APIName` varchar(45) NOT NULL,
  `APIKEY` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `APIs`
--

INSERT INTO `APIs` (`ApiID`, `APIName`, `APIKEY`) VALUES
(1, 'Mollie', 'test_wJ4ga3MgMbww8yk3S3Hb98EUxDebuN');

-- --------------------------------------------------------

--
-- Table structure for table `EventTickets`
--

CREATE TABLE `EventTickets` (
  `ticketID` int(11) NOT NULL,
  `timeSlotID` int(11) DEFAULT NULL,
  `programID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FestivalEvents`
--

CREATE TABLE `FestivalEvents` (
  `eventID` int(11) NOT NULL,
  `eventName` varchar(45) DEFAULT NULL,
  `bannerImage` varchar(90) DEFAULT NULL,
  `bannerDescription` varchar(1500) DEFAULT NULL,
  `eventTitle` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `FestivalEvents`
--

INSERT INTO `FestivalEvents` (`eventID`, `eventName`, `bannerImage`, `bannerDescription`, `eventTitle`) VALUES
(1, 'Jazz', '/image/home/Jazz-picture.jpg', 'Haarlem Jazz is a premier annual event for all jazz lovers. With more than 10 years of experience in showcasing the best in local and international jazz talent, you’d be certain to experience a vibrant and lively atmosphere for music fans! ', 'The Haarlem Jazz Event'),
(2, 'Yummy', '/image/home/history-picture.jpg', 'Explore every Food and Drink in this years Haarlem Yummy! event. Here its Eat first Talk later.\r\nCome and enjoy all culinary options Haarlem has to offer in this cities most versitile Food and Drink Festival.', 'Explore the TASTE of Haarlem'),
(3, 'Stroll Through History', '/image/home/yummy-picture.jpg', 'See what cultural monuments the city of Haarlem has to offer and walk with one of our guides to get to know the stories behind them during our guided tour through the streets of Haarlem.', 'A Stroll Through History');

-- --------------------------------------------------------

--
-- Table structure for table `FestivalInformation`
--

CREATE TABLE `FestivalInformation` (
  `festivalID` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `reservationFee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FoodTypes`
--

CREATE TABLE `FoodTypes` (
  `foodTypeID` int(11) NOT NULL,
  `foodTypeName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `FoodTypes`
--

INSERT INTO `FoodTypes` (`foodTypeID`, `foodTypeName`) VALUES
(0, 'Dutch'),
(1, 'Seafood'),
(2, 'French'),
(3, 'European'),
(4, 'international');

-- --------------------------------------------------------

--
-- Table structure for table `Guides`
--

CREATE TABLE `Guides` (
  `guideID` int(11) NOT NULL,
  `guideName` varchar(45) DEFAULT NULL,
  `languageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Halls`
--

CREATE TABLE `Halls` (
  `hallID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `hallName` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Halls`
--

INSERT INTO `Halls` (`hallID`, `locationID`, `hallName`) VALUES
(0, 1, 'Main hall'),
(0, 2, 'Grote Markt'),
(1, 1, 'Second hall'),
(2, 1, 'Third hall');

-- --------------------------------------------------------

--
-- Table structure for table `History`
--

CREATE TABLE `History` (
  `eventID` int(11) NOT NULL,
  `landMarkID` int(11) DEFAULT NULL,
  `practicalDescription` varchar(1500) DEFAULT NULL,
  `guideDescription` varchar(1500) DEFAULT NULL,
  `scheduleDescription` varchar(1500) DEFAULT NULL,
  `locationMap` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `HistoryDetailPages`
--

CREATE TABLE `HistoryDetailPages` (
  `landMarkID` int(11) NOT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `scheduleDescription` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `JazzAlbums`
--

CREATE TABLE `JazzAlbums` (
  `artistID` int(11) NOT NULL,
  `albumID` int(11) NOT NULL,
  `image` varchar(90) DEFAULT NULL,
  `title` varchar(120) DEFAULT NULL,
  `spotifyLink` varchar(120) DEFAULT NULL,
  `appleLink` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `JazzArtists`
--

CREATE TABLE `JazzArtists` (
  `artistID` int(11) NOT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL,
  `imageSmall` varchar(45) NOT NULL,
  `name` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `JazzArtists`
--

INSERT INTO `JazzArtists` (`artistID`, `description`, `image`, `imageSmall`, `name`) VALUES
(1, 'Hans and Candy Dulfer are as a father-daughter duo both inseparable from their saxophones. Hans is a renowned saxophonist, known for his soulful and energetic performances, while Candy is a skilled saxophonist and flautist in her own right. Together, they have had multiple successful albums and have performed at some of the most prestigious jazz festivals around the world! ', '/image/jazz/candyAndHansDulfer.png', '/image/jazz/artist1.png', 'Candy and Hans Dulfer'),
(2, 'Myles Sanko is a dynamic jazz singer and songwriter based in the city of London, England. Born in the coast of Ghana, Myles Sanko has quickly established himself as a force to be reckoned with on the local and global jazz scene with his unique Ghanian soul/jazz songs. Myles Sanko has already played at major jazz festivals around the Netherlands!', '/image/jazz/MylesSanko.png', '/image/jazz/artist2.png', 'Myles sanko'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist3.png', 'Gumbo Kings'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist4.png', 'Evolve'),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist5.png', 'Ntjam Rosie'),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist6.png', 'Wicked Jazz Sounds'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist7.png', 'Tom Thomsom Assemble'),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist8.png', 'Jonna Frazer'),
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist9.png', 'Fox & The Mayors'),
(10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist10.png', 'Uncle Sue'),
(11, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist11.png', 'Ruis Soundsystem'),
(12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist12.png', 'The Family XL'),
(13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist13.png', 'Gare du Nord'),
(14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist14.png', 'Rilan & The Bombadiers'),
(15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist15.png', 'Soul Six'),
(16, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist16.png', 'Han Bennink'),
(17, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist17.png', 'The Nordanians'),
(18, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist18.png', 'Lilith Merlot'),
(20, 'test', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `JazzLocations`
--

CREATE TABLE `JazzLocations` (
  `locationID` int(11) NOT NULL,
  `locationName` varchar(45) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `locationImage` varchar(90) DEFAULT NULL,
  `toAndFromText` varchar(1500) DEFAULT NULL,
  `accessibillityText` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `JazzLocations`
--

INSERT INTO `JazzLocations` (`locationID`, `locationName`, `address`, `locationImage`, `toAndFromText`, `accessibillityText`) VALUES
(1, 'Patronaat', 'Zijlsingel 2, 2013 DN Haarlem', '/image/jazz/location-patronaat.png', ' Patronaat is about <span>15 minutes walking distance</span> from Haarlem station <br>(a 1km distance)\n          </p>\n          <p>\n            Alternatively, you can take ride <span>buses 340, 346 or 356 one stop</span> to the Raaksburg. From there, it’ll be a minute on foot<br></p>\n          <p>\n            There are also <span>several parking options available</span>, like the parking garage RAAKS, which is a 5 minute walk away from the Patronaat\n          </p>', 'Do you have a disability? We and our partners at the Patronaat strive to make your visit as comfortable and enjoyable as possible<br>\n      </p><p> To see the facilities the patronaat has to offer, please download the <span>\'Ongehinderd\' mobile app here</span> and/or contact the patronaat through mail on info@patronaat.nl to discuss the options'),
(2, 'Grote Markt', 'Grote Markt 2011 RD Haarlem\r\n', '/image/jazz/location-grote-markt.png', 'Grote Markt is easily accessible <span>by foot</span> within just 10 minutes from the station (800m distance)</p>\r\n<p>It is also accessible with <span>buses 3, 73 or 300</span>. Ride <span>two stops</span> for busses <span>3 and 73</span> to Ruychaverstraat, which is right next to the Grote Markt</p>\r\n<p>There are also <span>several parking options</span> available, like the parking garage De Appelaar', 'Do you have a disability? The square is located at ground level and is <span>easily accessible by wheelchair or other assistive devices</span></p>\n<p>Many of the shops and restaurants around the square have <span>wheelchair ramps</span> and other accessibility features</p>\n<p>Also <span>special toilets</span> have been placed around the square in order to accommodate for people with disabilities');

-- --------------------------------------------------------

--
-- Table structure for table `LandMarks`
--

CREATE TABLE `LandMarks` (
  `landMarkID` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Languages`
--

CREATE TABLE `Languages` (
  `languageID` int(11) NOT NULL,
  `language` varchar(45) DEFAULT NULL,
  `languageFlag` varchar(90) DEFAULT NULL,
  `guideID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PersonalPrograms`
--

CREATE TABLE `PersonalPrograms` (
  `programID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `paymentMethod` int(11) NOT NULL,
  `isPaid` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `RestaurantFoodTypes`
--

CREATE TABLE `RestaurantFoodTypes` (
  `foodType` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RestaurantFoodTypes`
--

INSERT INTO `RestaurantFoodTypes` (`foodType`, `restaurantID`) VALUES
(0, 1),
(1, 1),
(3, 1),
(1, 2),
(2, 2),
(3, 2),
(0, 3),
(2, 3),
(3, 3),
(3, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `RestaurantImages`
--

CREATE TABLE `RestaurantImages` (
  `imageID` int(11) NOT NULL,
  `restaurantID` int(11) DEFAULT NULL,
  `imageLink` varchar(90) DEFAULT NULL,
  `imageIndex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RestaurantImages`
--

INSERT INTO `RestaurantImages` (`imageID`, `restaurantID`, `imageLink`, `imageIndex`) VALUES
(1, 1, 'yummy/detail/mr&mrs/mr&mrsTitleImg.jpg', 1),
(2, 1, 'yummy/detail/mr&mrs/mr&mrsLogo.jpg', 2),
(3, 1, 'yummy/detail/mr&mrs/mr&mrsBottom.jpg', 3),
(4, 1, 'yummy/detail/mr&mrs/mr&mrs1.jpg', 4),
(5, 1, 'yummy/detail/mr&mrs/mr&mrs2.jpg', 5),
(6, 2, 'yummy/detail/ratatouille/rataTitleImg.jpg', 1),
(7, 2, 'yummy/detail/ratatouille/rataLogo.png', 2),
(8, 2, 'yummy/detail/ratatouille/rataBottom.jpg', 3),
(9, 2, 'yummy/detail/ratatouille/rata1.jpg', 4),
(10, 2, 'yummy/detail/ratatouille/rata2.jpg', 5),
(11, 2, 'yummy/detail/ratatouille/rata3.jpg', 6),
(12, 3, 'yummy/detail/fris/frisTitleImg.jpg', 1),
(13, 3, 'yummy/detail/fris/frisLogo.jpg', 2),
(14, 3, 'yummy/detail/fris/frisBottom.jpg', 3),
(15, 3, 'yummy/detail/fris/fris1.jpg', 4),
(16, 3, 'yummy/detail/fris/fris2.jpg', 5),
(17, 4, 'yummy/detail/specktakel/speckTitleImg.jpg', 1),
(18, 4, 'yummy/detail/specktakel/speckLogo.jpg', 2),
(19, 4, 'yummy/detail/specktakel/speckBottom.jpg', 3),
(20, 4, 'yummy/detail/specktakel/speck1.jpg', 4),
(21, 4, 'yummy/detail/specktakel/speck2.jpg', 5),
(22, 4, 'yummy/detail/specktakel/speck3.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `RestaurantMenuItems`
--

CREATE TABLE `RestaurantMenuItems` (
  `menuItemID` int(11) NOT NULL,
  `restaurantID` int(11) DEFAULT NULL,
  `courseID` int(11) DEFAULT NULL,
  `name` varchar(90) DEFAULT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `specialty` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RestaurantMenuItems`
--

INSERT INTO `RestaurantMenuItems` (`menuItemID`, `restaurantID`, `courseID`, `name`, `description`, `price`, `specialty`) VALUES
(1, 1, 0, 'Corvina', 'papaja salad, yuzu, olive oil, black olive crumble', 12, NULL),
(2, 1, 0, 'Softshell krab', 'harissa, pumpkin, mango, dill', 15, NULL),
(3, 1, 0, 'Eggplant', 'potato, sjalot, paprika, seavegetables', 10, '0'),
(4, 1, 1, 'Pearlcouscous', 'orange, Schartong', 17.5, NULL),
(5, 1, 1, 'Octopus', 'potato, chimichurri, chorizo', 16.24, NULL),
(6, 1, 1, 'Gnocchi', 'manchego, pomodori', 22.2, '0'),
(7, 1, 1, 'Steak tartar', 'almond, olive oil', 26.8, NULL),
(8, 1, 2, 'Passionfruit mousse', 'raspberry, white chocolate', 18.5, '0'),
(9, 1, 2, 'Cheese from Kaasfort Amsterdam', 'with figcompote', 22.25, NULL),
(10, 2, 0, 'Dutch Oysters each ', NULL, 6.5, NULL),
(11, 2, 0, 'Irish Móre NO 3 each ', NULL, 6.5, NULL),
(12, 2, 0, 'Jamón Ibérico Bellota 35 GR ', NULL, 16, NULL),
(13, 2, 0, 'Perle imperial caviar 30 Gram', ' Blini, Creme Fraîche, Chives, Shallot', 69, NULL),
(14, 2, 0, 'Northsea crab', 'Perle Imperial Caviar, Lemon, Celeriac', 39, NULL),
(15, 2, 0, 'Coquille', 'Basmati, Celeriac, Fenugreek', 32, NULL),
(16, 2, 1, 'Tarbot', 'Lemon, Parsley, Almond', 29, 'Vegan'),
(17, 2, 1, 'Ratatouille', 'Molasse, Gnocchi, Parmesan', 29, NULL),
(18, 2, 2, 'Alfredo Linguini', 'Lemon, Strawberry, Champagne', 19.5, NULL),
(19, 2, 2, 'Auguste Gusteau', 'Blanc Manger, Starwberry, Meringue, Valrhona Orelys', 19.5, NULL),
(20, 2, 2, 'Emile', 'Soufflé, Time, Red Fruit, Bahibe Chocolate', 19.5, NULL),
(21, 2, 2, 'Django (Remy’s & Emile’s father)', 'Cheese - Choose From The Trolley', 19.5, NULL),
(22, 3, 0, 'OYSTERS a piece', 'Zeeland Creuse with lemon and candied shallot ', 4, NULL),
(23, 3, 0, 'BEETROOT', '‘Dry Aged’ with fennel and Jan Hagel', 18, NULL),
(24, 3, 0, 'GAMBA', 'Our interpretation of the well-known Spanish classic with aioli and chili pepper ', 20, NULL),
(25, 3, 1, 'CELERIAC', 'With Waldorf Salad, Amsterdam pickle and broth of roasted celeriac (winter truffle supplement 15 p.p. ) ', 35, NULL),
(26, 3, 1, 'TURBOT', 'Roasted with eel in green and Beurre Blanc with herbs ', 40, '0'),
(27, 3, 1, 'WAGYU A5 100 gr.', 'rosé roast with oxheart cabbage, roasted shallot and own gravy ', 70, '1'),
(28, 3, 2, 'TANGERINE', 'Several preparations of tangerine, ginger beer and ice cream of verbena', 18, NULL),
(29, 3, 2, 'LEMONCURD', 'With dulce de leche, sorbet of Radler and lemon broth with pink pepper', 18, NULL),
(30, 4, 0, 'NEW ZEALAND SEARED MINI SCALLOP SALAD', 'Wasabi wakamé, Yuzu mayo, Lotus root, Little gem\r\n', 17, NULL),
(31, 4, 0, 'HAWAIIAN TUNA TATAKI', 'Red tuna, Spring onion, Pickled cucumber, Cashew crumble', 15, NULL),
(32, 4, 0, 'JAPANESE MUSHROOM DASHI BOUILLION', 'Pork dimsum, Wild mushroom, Tamago omelette, Quail egg', 18, NULL),
(33, 4, 0, 'KOREAN CROCODILE NUGGETS', 'Kimchi, Chili garlic sauce, Pepper leaf, Soy infused sesame', 15, NULL),
(34, 4, 1, 'ITALIAN SLOW COOKED VEAL BRASATO', 'Truffle ravioli, Green Asparagus, Barolo jus, Pancetta crumble', 40, NULL),
(35, 4, 1, 'JAPANESE MISO CHICKEN BENTO BOX', 'Chicken kara-age, Edamame, Sticky rice, Miso mayo', 25, '1'),
(36, 4, 1, 'SCANDINAVIAN LAX', 'baked salmon, Smoked beetroot, Celeriac pureé, Mustard beurre blanc', 36, NULL),
(37, 4, 1, 'SPANISH CONFIT DUCK LEG', 'Chorizo chucrut, Saffron mashed potatoes, Smoked Aioli, Pickled onions', 26, NULL),
(38, 4, 2, 'SOUTH AFRICAN MALVA CAKE', 'Sticky toffee pudding, Walnut ahorn ice cream, Brandy Syrup, Almond crumble', 18, NULL),
(39, 4, 2, 'INDONESIAN COCONUT PANNA COTTA', 'Pandan cream, Coconut crumble, Mango sorbet, Pineapple chips', 18, NULL),
(40, 4, 2, 'USA SNICKERS FONDANT', 'Prosecco, lemon & lychee sorbet, rose sirup, Thai basil', 18, NULL),
(41, 4, 2, 'FILIPINO CALAMANSI BANANA PIE', 'Banana biscuit, Calamansi mousse, Caramalised banana cream, Peanut ice Cream', 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `RestaurantReservation`
--

CREATE TABLE `RestaurantReservation` (
  `ticketID` int(11) NOT NULL,
  `timeSlotID` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `reservationName` varchar(255) NOT NULL,
  `phoneNumber` int(30) NOT NULL,
  `numberAdults` int(11) NOT NULL,
  `numberChildren` int(11) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `isActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `RestaurantReservation`
--

INSERT INTO `RestaurantReservation` (`ticketID`, `timeSlotID`, `restaurantID`, `reservationName`, `phoneNumber`, `numberAdults`, `numberChildren`, `remark`, `isActive`) VALUES
(1, 500, 1, 'luukie', 987654338, 1, 2, 'lekker bij het raampje', b'1'),
(501, 2, 2, 'ad', 13, 1, 1, '1', b'0'),
(502, 2, 2, 'ad', 13, 1, 1, '1', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `StaticPage`
--

CREATE TABLE `StaticPage` (
  `pageID` int(11) NOT NULL,
  `bannerImage` varchar(90) DEFAULT NULL,
  `title` varchar(90) DEFAULT NULL,
  `secondTitle` varchar(250) DEFAULT NULL,
  `description` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TimeSlots`
--

CREATE TABLE `TimeSlots` (
  `timeSlotID` int(11) NOT NULL,
  `eventID` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `maximumAmountTickets` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TimeSlots`
--

INSERT INTO `TimeSlots` (`timeSlotID`, `eventID`, `price`, `startTime`, `endTime`, `maximumAmountTickets`) VALUES
(500, 2, 10, '2023-07-26 17:00:00', '2023-07-26 18:30:00', 50),
(501, 2, 10, '2023-07-26 18:30:00', '2023-07-26 20:00:00', 50),
(502, 2, 10, '2023-07-26 20:00:00', '2023-07-26 21:30:00', 50),
(503, 2, 10, '2023-07-27 17:30:00', '2023-07-27 18:30:00', 50),
(504, 2, 10, '2023-07-27 18:30:00', '2023-07-27 20:00:00', 50),
(505, 2, 10, '2023-07-27 20:00:00', '2023-07-27 21:30:00', 50),
(506, 2, 10, '2023-07-28 17:00:00', '2023-07-28 18:30:00', 50),
(507, 2, 10, '2023-07-28 18:30:00', '2023-07-28 20:00:00', 50),
(508, 2, 10, '2023-07-28 20:00:00', '2023-07-28 21:30:00', 50),
(509, 2, 10, '2023-07-29 17:00:00', '2023-07-29 18:30:00', 50),
(510, 2, 10, '2023-07-29 18:30:00', '2023-07-29 20:00:00', 50),
(511, 2, 10, '2023-07-29 20:00:00', '2023-07-29 21:30:00', 50),
(512, 2, 10, '2023-07-26 17:00:00', '2023-07-26 19:00:00', 40),
(513, 2, 10, '2023-07-26 19:00:00', '2023-07-26 21:00:00', 40),
(514, 2, 10, '2023-07-26 21:00:00', '2023-07-26 23:00:00', 40),
(515, 2, 10, '2023-07-27 17:00:00', '2023-07-26 19:00:00', 40),
(516, 2, 10, '2023-07-27 19:00:00', '2023-07-27 21:00:00', 40),
(517, 2, 10, '2023-07-27 21:00:00', '2023-07-27 23:00:00', 40),
(518, 2, 10, '2023-07-28 17:00:00', '2023-07-28 19:00:00', 40),
(519, 2, 10, '2023-07-28 19:00:00', '2023-07-28 21:00:00', 40),
(520, 2, 10, '2023-07-28 21:00:00', '2023-07-28 23:00:00', 40),
(521, 2, 10, '2023-07-29 17:00:00', '2023-07-29 19:00:00', 40),
(522, 2, 10, '2023-07-29 19:00:00', '2023-07-29 21:00:00', 40),
(523, 2, 10, '2023-07-29 21:00:00', '2023-07-26 23:00:00', 40),
(524, 2, 10, '2023-07-26 17:30:00', '2023-07-26 19:00:00', 45),
(525, 2, 10, '2023-07-26 19:00:00', '2023-07-26 20:30:00', 45),
(526, 2, 10, '2023-07-26 20:30:00', '2023-07-26 22:00:00', 45),
(527, 2, 10, '2023-07-27 17:30:00', '2023-07-27 19:00:00', 45),
(528, 2, 10, '2023-07-27 19:00:00', '2023-07-27 20:30:00', 45),
(529, 2, 10, '2023-07-27 20:30:00', '2023-07-27 22:00:00', 45),
(530, 2, 10, '2023-07-28 17:30:00', '2023-07-28 19:00:00', 45),
(531, 2, 10, '2023-07-28 19:00:00', '2023-07-28 20:30:00', 45),
(532, 2, 10, '2023-07-28 20:30:00', '2023-07-28 22:00:00', 45),
(533, 2, 10, '2023-07-29 17:30:00', '2023-07-29 19:00:00', 45),
(534, 2, 10, '2023-07-29 19:00:00', '2023-07-29 20:30:00', 45),
(535, 2, 10, '2023-07-29 20:30:00', '2023-07-29 22:00:00', 45),
(536, 2, 10, '2023-07-26 17:00:00', '2023-07-26 18:30:00', 35),
(537, 2, 10, '2023-07-26 18:30:00', '2023-07-26 20:00:00', 35),
(538, 2, 10, '2023-07-26 20:00:00', '2023-07-26 21:30:00', 35),
(539, 2, 10, '2023-07-27 17:00:00', '2023-07-27 18:30:00', 35),
(540, 2, 10, '2023-07-27 18:30:00', '2023-07-27 20:00:00', 35),
(541, 2, 10, '2023-07-27 20:00:00', '2023-07-27 21:30:00', 35),
(542, 2, 10, '2023-07-28 17:00:00', '2023-07-28 18:30:00', 35),
(543, 2, 10, '2023-07-28 18:30:00', '2023-07-28 20:00:00', 35),
(544, 2, 10, '2023-07-28 20:00:00', '2023-07-28 21:30:00', 35),
(545, 2, 10, '2023-07-29 17:00:00', '2023-07-29 18:30:00', 35),
(546, 2, 10, '2023-07-29 18:30:00', '2023-07-29 20:00:00', 35),
(547, 2, 10, '2023-07-29 20:00:00', '2023-07-29 21:30:00', 35),
(1000, 1, 15, '2023-07-27 18:00:00', '2023-07-27 19:00:00', 300),
(1001, 1, 15, '2023-07-27 19:30:00', '2023-07-27 20:30:00', 300),
(1002, 1, 15, '2023-07-27 21:00:00', '2023-07-27 22:00:00', 300),
(1003, 1, 10, '2023-07-27 18:00:00', '2023-07-27 19:00:00', 200),
(1004, 1, 10, '2023-07-27 19:30:00', '2023-07-27 20:30:00', 200),
(1005, 1, 10, '2023-07-27 21:00:00', '2023-07-27 22:00:00', 200),
(1006, 1, 15, '2023-07-28 18:00:00', '2023-07-28 19:00:00', 300),
(1007, 1, 15, '2023-07-28 19:30:00', '2023-07-28 20:30:00', 300),
(1008, 1, 15, '2023-07-28 21:00:00', '2023-07-28 22:00:00', 300),
(1009, 1, 10, '2023-07-28 18:00:00', '2023-07-28 19:00:00', 200),
(1010, 1, 10, '2023-07-28 19:30:00', '2023-07-28 20:30:00', 200),
(1011, 1, 10, '2023-07-28 21:00:00', '2023-07-28 22:00:00', 200),
(1012, 1, 15, '2023-07-29 18:00:00', '2023-07-29 19:00:00', 300),
(1013, 1, 15, '2023-07-29 19:30:00', '2023-07-29 20:30:00', 300),
(1014, 1, 15, '2023-07-29 21:00:00', '2023-07-29 22:00:00', 300),
(1015, 1, 10, '2023-07-29 18:00:00', '2023-07-29 19:00:00', 150),
(1016, 1, 10, '2023-07-29 19:30:00', '2023-07-29 20:30:00', 150),
(1017, 1, 10, '2023-07-29 21:00:00', '2023-07-29 22:00:00', 150),
(1018, 1, 0, '2023-07-30 15:00:00', '2023-07-30 16:00:00', 0),
(1019, 1, 0, '2023-07-30 16:00:00', '2023-07-30 17:00:00', 0),
(1020, 1, 0, '2023-07-30 17:00:00', '2023-07-30 18:00:00', 0),
(1021, 1, 0, '2023-07-30 18:00:00', '2023-07-30 19:00:00', 0),
(1022, 1, 0, '2023-07-30 19:00:00', '2023-07-30 20:00:00', 0),
(1023, 1, 0, '2023-07-30 20:00:00', '2023-07-30 21:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `TimeSlotsJazz`
--

CREATE TABLE `TimeSlotsJazz` (
  `timeSlotID` int(11) NOT NULL,
  `artistID` int(11) DEFAULT NULL,
  `locationID` int(11) DEFAULT NULL,
  `hallID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TimeSlotsJazz`
--

INSERT INTO `TimeSlotsJazz` (`timeSlotID`, `artistID`, `locationID`, `hallID`) VALUES
(1000, 3, 1, 0),
(1001, 4, 1, 0),
(1002, 5, 1, 0),
(1003, 6, 1, 1),
(1004, 7, 1, 1),
(1005, 8, 1, 1),
(1006, 9, 1, 0),
(1007, 10, 1, 0),
(1008, 1, 1, 0),
(1009, 2, 1, 1),
(1010, 11, 1, 1),
(1011, 12, 1, 1),
(1012, 13, 1, 0),
(1013, 14, 1, 0),
(1014, 15, 1, 0),
(1015, 16, 1, 2),
(1016, 17, 1, 2),
(1017, 18, 1, 2),
(1018, 9, 2, 0),
(1019, 18, 2, 0),
(1020, 15, 2, 0),
(1021, 11, 2, 0),
(1022, 3, 2, 0),
(1023, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `TimeSlotsStrollThroughHistory`
--

CREATE TABLE `TimeSlotsStrollThroughHistory` (
  `timeSlotID` int(11) NOT NULL,
  `languageID` int(11) DEFAULT NULL,
  `GuideID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TimeSlotsYummy`
--

CREATE TABLE `TimeSlotsYummy` (
  `timeSlotID` int(11) NOT NULL,
  `restaurantID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TimeSlotsYummy`
--

INSERT INTO `TimeSlotsYummy` (`timeSlotID`, `restaurantID`) VALUES
(500, 1),
(501, 1),
(502, 1),
(503, 1),
(504, 1),
(505, 1),
(506, 1),
(507, 1),
(508, 1),
(509, 1),
(510, 1),
(511, 1),
(512, 2),
(513, 2),
(514, 2),
(515, 2),
(516, 2),
(517, 2),
(518, 2),
(519, 2),
(520, 2),
(521, 2),
(522, 2),
(523, 2),
(524, 3),
(525, 3),
(526, 3),
(527, 3),
(528, 3),
(529, 3),
(530, 3),
(531, 3),
(532, 3),
(533, 3),
(534, 3),
(535, 3),
(536, 4),
(537, 4),
(538, 4),
(539, 4),
(540, 4),
(541, 4),
(542, 4),
(543, 4),
(544, 4),
(545, 4),
(546, 4),
(547, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `userID` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `userRole` int(11) NOT NULL,
  `fullName` varchar(90) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `password` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`userID`, `email`, `userRole`, `fullName`, `phoneNumber`, `password`) VALUES
(13, 'john.doe@example.com', 1, 'john.doe@example.com', '4545454545', '$2y$10$cXg37zWeGgb56l7JMoudT.8.5ONfdYgRRNxp1AEdf3EJSdvUrsnq6'),
(18, 'regularUser@gmail.com', 0, 'Harry', '0615335353', '$2y$10$okCM8QH82kYm4qhq.yoobeurw2UyP5YKAn287f.TDcvTiZSEV.rYe'),
(19, 'adminUser@gmail.com', 1, 'Tayam', '0615151515', '$2y$10$uYAlMthlE8ZJ74qUHZmPKO7BbGihg3ADjE5RTM.xWLsdiomEVBAnO');

-- --------------------------------------------------------

--
-- Table structure for table `YummyRestaurants`
--

CREATE TABLE `YummyRestaurants` (
  `restaurantID` int(11) NOT NULL,
  `restaurantName` varchar(90) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `cardDescription` varchar(255) NOT NULL,
  `description` varchar(250) NOT NULL,
  `amountOfStars` int(11) NOT NULL,
  `bannerImage` varchar(90) NOT NULL,
  `headChef` varchar(90) NOT NULL,
  `amountSessions` int(11) NOT NULL,
  `adultPrice` float NOT NULL,
  `childPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `YummyRestaurants`
--

INSERT INTO `YummyRestaurants` (`restaurantID`, `restaurantName`, `address`, `contact`, `cardDescription`, `description`, `amountOfStars`, `bannerImage`, `headChef`, `amountSessions`, `adultPrice`, `childPrice`) VALUES
(1, 'Mr & Mrs', 'Lange Veerstraat 4,2011 DB / Haarlem', 'Tel: 023-2071006,info@mrandmrs.nl', 'Mr & Mrs is known for its quality Dutch cuisine and seafood. Interested?', 'Here you can enjoy a extensive lunch, grab a drink at the bar or a delicious diner! In the summer you can enjoy a delicious meal under the sun on their spacious terrace.', 4, 'yummy/detail/mr&mrs/mr&mrsLogo.jpg\n', 'Marcel Huisman', 3, 45, 22.5),
(2, 'Ratatouille', 'Spaarne 96, 2011 CL Haarlem / Netherlands', 'Tel: 023-5321699,info@ratatouille.nl', 'This is the place to be for a chic French dining experience. Serving dinner A La Carte, here at Ratatouille you will experience a whole new level of dining.', 'For a intimate, cosy and great dinner experience with friends and family take place in our beautiful restaurant area. What are our signature dishes? That are the Côte de Boeuf and the lobster.', 4, 'yummy/detail/ratatouille/rataLogo.png\n', 'Fillipe Eqlair', 3, 45, 22.5),
(3, 'Restaurant Fris', 'Twijnderslaan 7, 2012 BG / Haarlem', 'Tel: 023-2071006,info@restaurantfris.nl', 'Known for its authentic Dutch and French dishes, at Fris you can relax  with friends and family over unique dishes.', 'Our passion for food and drink is in the choices in the menu. No incomprehensible hassle with the food, but honest, recognizable dishes based on natural ingrediënts. Completely with excelent wine, a selection of Jopen Beer and delicious Peeze koffie.', 4, 'yummy/detail/fris/frisLogo.jpg\n', 'Thomas Klaploper', 3, 45, 22.5),
(4, 'Specktakel', 'Spekstraat 4, 2011 HM / Haarlem', 'Tel: 023-2071006,info@specktakel.nl', 'With its rustic decor, the food stands out even more. Get a delecious steak or try out their famous burger. They offer a variaty of dishes from around the world.', 'Here at Specktakel we focus on pure and quality products, in the kitchen as behind the bar and in our service, accessable but of high quality. A table full dilicious foods and wines, thats what we think a great evening out looks like.', 3, 'yummy/detail/specktakel/speckLogo.jpg\n', 'Piet Weghorst', 3, 35, 17.5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `APIs`
--
ALTER TABLE `APIs`
  ADD PRIMARY KEY (`ApiID`);

--
-- Indexes for table `EventTickets`
--
ALTER TABLE `EventTickets`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `timeSlotID` (`timeSlotID`);

--
-- Indexes for table `FestivalEvents`
--
ALTER TABLE `FestivalEvents`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `FestivalInformation`
--
ALTER TABLE `FestivalInformation`
  ADD PRIMARY KEY (`festivalID`);

--
-- Indexes for table `FoodTypes`
--
ALTER TABLE `FoodTypes`
  ADD PRIMARY KEY (`foodTypeID`);

--
-- Indexes for table `Guides`
--
ALTER TABLE `Guides`
  ADD PRIMARY KEY (`guideID`),
  ADD KEY `languageID` (`languageID`);

--
-- Indexes for table `Halls`
--
ALTER TABLE `Halls`
  ADD PRIMARY KEY (`hallID`,`locationID`) USING BTREE,
  ADD KEY `locationID` (`locationID`);

--
-- Indexes for table `History`
--
ALTER TABLE `History`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `HistoryDetailPages`
--
ALTER TABLE `HistoryDetailPages`
  ADD PRIMARY KEY (`landMarkID`);

--
-- Indexes for table `JazzAlbums`
--
ALTER TABLE `JazzAlbums`
  ADD PRIMARY KEY (`albumID`),
  ADD KEY `artistID` (`artistID`);

--
-- Indexes for table `JazzArtists`
--
ALTER TABLE `JazzArtists`
  ADD PRIMARY KEY (`artistID`);

--
-- Indexes for table `JazzLocations`
--
ALTER TABLE `JazzLocations`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `LandMarks`
--
ALTER TABLE `LandMarks`
  ADD PRIMARY KEY (`landMarkID`);

--
-- Indexes for table `Languages`
--
ALTER TABLE `Languages`
  ADD PRIMARY KEY (`languageID`);

--
-- Indexes for table `PersonalPrograms`
--
ALTER TABLE `PersonalPrograms`
  ADD PRIMARY KEY (`programID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `RestaurantFoodTypes`
--
ALTER TABLE `RestaurantFoodTypes`
  ADD PRIMARY KEY (`restaurantID`,`foodType`),
  ADD KEY `foodType` (`foodType`);

--
-- Indexes for table `RestaurantImages`
--
ALTER TABLE `RestaurantImages`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexes for table `RestaurantMenuItems`
--
ALTER TABLE `RestaurantMenuItems`
  ADD PRIMARY KEY (`menuItemID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexes for table `RestaurantReservation`
--
ALTER TABLE `RestaurantReservation`
  ADD PRIMARY KEY (`ticketID`);

--
-- Indexes for table `StaticPage`
--
ALTER TABLE `StaticPage`
  ADD PRIMARY KEY (`pageID`);

--
-- Indexes for table `TimeSlots`
--
ALTER TABLE `TimeSlots`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `TimeSlotsJazz`
--
ALTER TABLE `TimeSlotsJazz`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `artistID` (`artistID`),
  ADD KEY `locationID` (`locationID`),
  ADD KEY `hallID` (`hallID`);

--
-- Indexes for table `TimeSlotsStrollThroughHistory`
--
ALTER TABLE `TimeSlotsStrollThroughHistory`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `languageID` (`languageID`);

--
-- Indexes for table `TimeSlotsYummy`
--
ALTER TABLE `TimeSlotsYummy`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `YummyRestaurants`
--
ALTER TABLE `YummyRestaurants`
  ADD PRIMARY KEY (`restaurantID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `APIs`
--
ALTER TABLE `APIs`
  MODIFY `ApiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `EventTickets`
--
ALTER TABLE `EventTickets`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `FestivalEvents`
--
ALTER TABLE `FestivalEvents`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `FestivalInformation`
--
ALTER TABLE `FestivalInformation`
  MODIFY `festivalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Guides`
--
ALTER TABLE `Guides`
  MODIFY `guideID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `JazzAlbums`
--
ALTER TABLE `JazzAlbums`
  MODIFY `albumID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `JazzArtists`
--
ALTER TABLE `JazzArtists`
  MODIFY `artistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `JazzLocations`
--
ALTER TABLE `JazzLocations`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `LandMarks`
--
ALTER TABLE `LandMarks`
  MODIFY `landMarkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Languages`
--
ALTER TABLE `Languages`
  MODIFY `languageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PersonalPrograms`
--
ALTER TABLE `PersonalPrograms`
  MODIFY `programID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `RestaurantImages`
--
ALTER TABLE `RestaurantImages`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `RestaurantMenuItems`
--
ALTER TABLE `RestaurantMenuItems`
  MODIFY `menuItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `RestaurantReservation`
--
ALTER TABLE `RestaurantReservation`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `StaticPage`
--
ALTER TABLE `StaticPage`
  MODIFY `pageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TimeSlots`
--
ALTER TABLE `TimeSlots`
  MODIFY `timeSlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1025;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `YummyRestaurants`
--
ALTER TABLE `YummyRestaurants`
  MODIFY `restaurantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `EventTickets`
--
ALTER TABLE `EventTickets`
  ADD CONSTRAINT `EventTickets_ibfk_1` FOREIGN KEY (`timeSlotID`) REFERENCES `TimeSlots` (`timeSlotID`);

--
-- Constraints for table `Guides`
--
ALTER TABLE `Guides`
  ADD CONSTRAINT `Guides_ibfk_1` FOREIGN KEY (`languageID`) REFERENCES `Languages` (`languageID`);

--
-- Constraints for table `Halls`
--
ALTER TABLE `Halls`
  ADD CONSTRAINT `Halls_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `JazzLocations` (`locationID`);

--
-- Constraints for table `History`
--
ALTER TABLE `History`
  ADD CONSTRAINT `History_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `FestivalEvents` (`eventID`);

--
-- Constraints for table `HistoryDetailPages`
--
ALTER TABLE `HistoryDetailPages`
  ADD CONSTRAINT `HistoryDetailPages_ibfk_1` FOREIGN KEY (`landMarkID`) REFERENCES `LandMarks` (`landMarkID`);

--
-- Constraints for table `JazzAlbums`
--
ALTER TABLE `JazzAlbums`
  ADD CONSTRAINT `JazzAlbums_ibfk_1` FOREIGN KEY (`artistID`) REFERENCES `JazzArtists` (`artistID`);

--
-- Constraints for table `PersonalPrograms`
--
ALTER TABLE `PersonalPrograms`
  ADD CONSTRAINT `PersonalPrograms_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);

--
-- Constraints for table `RestaurantFoodTypes`
--
ALTER TABLE `RestaurantFoodTypes`
  ADD CONSTRAINT `RestaurantFoodTypes_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`),
  ADD CONSTRAINT `RestaurantFoodTypes_ibfk_2` FOREIGN KEY (`foodType`) REFERENCES `FoodTypes` (`foodTypeID`);

--
-- Constraints for table `RestaurantImages`
--
ALTER TABLE `RestaurantImages`
  ADD CONSTRAINT `RestaurantImages_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`);

--
-- Constraints for table `RestaurantMenuItems`
--
ALTER TABLE `RestaurantMenuItems`
  ADD CONSTRAINT `RestaurantMenuItems_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`);

--
-- Constraints for table `TimeSlots`
--
ALTER TABLE `TimeSlots`
  ADD CONSTRAINT `TimeSlots_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `FestivalEvents` (`eventID`);

--
-- Constraints for table `TimeSlotsJazz`
--
ALTER TABLE `TimeSlotsJazz`
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_1` FOREIGN KEY (`timeSlotID`) REFERENCES `TimeSlots` (`timeSlotID`),
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_2` FOREIGN KEY (`artistID`) REFERENCES `JazzArtists` (`artistID`),
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_3` FOREIGN KEY (`locationID`) REFERENCES `JazzLocations` (`locationID`),
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_4` FOREIGN KEY (`hallID`) REFERENCES `Halls` (`hallID`);

--
-- Constraints for table `TimeSlotsStrollThroughHistory`
--
ALTER TABLE `TimeSlotsStrollThroughHistory`
  ADD CONSTRAINT `TimeSlotsStrollThroughHistory_ibfk_1` FOREIGN KEY (`languageID`) REFERENCES `Languages` (`languageID`);

--
-- Constraints for table `TimeSlotsYummy`
--
ALTER TABLE `TimeSlotsYummy`
  ADD CONSTRAINT `TimeSlotsYummy_ibfk_1` FOREIGN KEY (`timeSlotID`) REFERENCES `TimeSlots` (`timeSlotID`),
  ADD CONSTRAINT `TimeSlotsYummy_ibfk_2` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
