-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 24 jun 2023 om 16:05
-- Serverversie: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP-versie: 8.0.25

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
-- Tabelstructuur voor tabel `APIs`
--

CREATE TABLE `APIs` (
  `ApiID` int(11) NOT NULL,
  `APIName` varchar(45) NOT NULL,
  `APIKEY` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `APIs`
--

INSERT INTO `APIs` (`ApiID`, `APIName`, `APIKEY`) VALUES
(1, 'Mollie', 'test_wJ4ga3MgMbww8yk3S3Hb98EUxDebuN');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `EventTickets`
--

CREATE TABLE `EventTickets` (
  `ticketID` int(11) NOT NULL,
  `timeSlotID` int(11) DEFAULT NULL,
  `programID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `EventTickets`
--

INSERT INTO `EventTickets` (`ticketID`, `timeSlotID`, `programID`) VALUES
(1, 1001, 12),
(697, 1000, 108),
(698, 1000, 108),
(699, 1000, 108),
(700, 1000, 108),
(701, 1000, 108),
(702, 1000, 108),
(703, 1000, 108),
(704, 1000, 108),
(705, 1000, 108),
(706, 1000, 108),
(707, 1000, 108),
(708, 1000, 108),
(709, 1000, 108),
(710, 1000, 108),
(711, 1000, 108),
(712, 1000, 108),
(713, 1000, 108),
(714, 1000, 108),
(715, 1000, 108),
(716, 1000, 108),
(717, 1000, 108),
(718, 1000, 108),
(719, 1000, 108),
(720, 1000, 108),
(721, 1000, 108),
(722, 1000, 108),
(723, 1000, 108),
(724, 1000, 108),
(725, 1000, 108),
(726, 1000, 108),
(727, 1000, 108),
(728, 1000, 108),
(729, 1000, 108),
(730, 1000, 108),
(731, 1000, 108),
(732, 1000, 108),
(733, 1000, 108),
(734, 1000, 108),
(735, 1000, 108),
(736, 1000, 108),
(737, 1000, 108),
(738, 1000, 108),
(739, 1000, 108),
(740, 1000, 108),
(741, 1000, 108),
(742, 1000, 108),
(743, 1000, 108),
(744, 509, 108),
(819, 1000, 122),
(820, 1000, 122),
(821, 1000, 122),
(822, 1000, 122),
(823, 500, 122),
(824, 500, 122),
(825, 500, 122),
(826, 1997, 123),
(827, 1997, 123),
(828, 1999, 124),
(829, 1999, 124),
(830, 1000, 124),
(831, 1000, 124),
(832, 1997, 124),
(833, 1997, 124),
(1252, 1000, 145),
(1253, 1000, 145),
(1254, 1000, 145),
(1255, 1000, 145),
(1256, 1000, 145),
(1257, 1000, 145),
(1258, 1000, 145),
(1259, 1000, 145),
(1260, 1000, 145),
(1261, 1000, 145),
(1262, 1000, 145),
(1263, 1996, 145),
(1264, 1996, 145),
(1265, 1998, 145),
(1266, 1999, 145),
(1267, 500, 145),
(1268, 500, 145),
(1269, 500, 145),
(1270, 500, 145),
(1271, 500, 145),
(1272, 542, 146),
(1273, 542, 146),
(1274, 542, 146),
(1275, 542, 146),
(1276, 542, 146),
(1277, 1006, 146),
(1278, 1006, 146),
(1279, 1006, 146),
(1280, 1006, 146),
(1281, 1999, 146),
(1282, 1999, 146),
(1283, 1996, 146),
(1284, 1000, 147),
(1285, 1000, 147);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `FestivalEvents`
--

CREATE TABLE `FestivalEvents` (
  `eventID` int(11) NOT NULL,
  `eventName` varchar(45) DEFAULT NULL,
  `bannerImage` varchar(90) DEFAULT NULL,
  `bannerDescription` varchar(1500) DEFAULT NULL,
  `eventTitle` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `FestivalEvents`
--

INSERT INTO `FestivalEvents` (`eventID`, `eventName`, `bannerImage`, `bannerDescription`, `eventTitle`) VALUES
(1, 'Jazz', '/image/home/Jazz-picture.jpg', 'Haarlem Jazz is a premier annual event for all jazz lovers. With more than 10 years of experience in showcasing the best in local and international jazz talent, you’d be certain to experience a vibrant and lively atmosphere for music fans! ', 'The Haarlem Jazz Event'),
(2, 'Yummy', '/image/home/yummy-picture.jpg', 'Explore every Food and Drink in this years Haarlem Yummy! event. Here its Eat first Talk later.\r\nCome and enjoy all culinary options Haarlem has to offer in this cities most versitile Food and Drink Festival.', 'Explore the TASTE of Haarlem'),
(3, 'Stroll Through History', '/image/home/history-picture.jpg', 'See what cultural monuments the city of Haarlem has to offer and walk with one of our guides to get to know the stories behind them during our guided tour through the streets of Haarlem.', 'A Stroll Through History');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `FestivalInformation`
--

CREATE TABLE `FestivalInformation` (
  `festivalID` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `reservationFee` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `FestivalInformation`
--

INSERT INTO `FestivalInformation` (`festivalID`, `startDate`, `endDate`, `reservationFee`) VALUES
(1, '2023-07-27 00:00:00', '2023-07-30 23:59:59', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `FoodTypes`
--

CREATE TABLE `FoodTypes` (
  `foodTypeID` int(11) NOT NULL,
  `foodTypeName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `FoodTypes`
--

INSERT INTO `FoodTypes` (`foodTypeID`, `foodTypeName`) VALUES
(0, 'Dutch'),
(1, 'Seafood'),
(2, 'French'),
(3, 'European'),
(4, 'international');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Guides`
--

CREATE TABLE `Guides` (
  `guideID` int(11) NOT NULL,
  `guideName` varchar(45) DEFAULT NULL,
  `languageID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Halls`
--

CREATE TABLE `Halls` (
  `hallID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `hallName` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `Halls`
--

INSERT INTO `Halls` (`hallID`, `locationID`, `hallName`) VALUES
(0, 1, 'Main hall'),
(0, 2, 'Grote Markt'),
(1, 1, 'Second hall'),
(2, 1, 'Third hall');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `History`
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
-- Tabelstructuur voor tabel `HistoryDetailPages`
--

CREATE TABLE `HistoryDetailPages` (
  `landMarkID` int(11) NOT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `scheduleDescription` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `JazzAlbums`
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
-- Tabelstructuur voor tabel `JazzArtists`
--

CREATE TABLE `JazzArtists` (
  `artistID` int(11) NOT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL,
  `imageSmall` varchar(45) NOT NULL,
  `name` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `JazzArtists`
--

INSERT INTO `JazzArtists` (`artistID`, `description`, `image`, `imageSmall`, `name`) VALUES
(1, 'Hans and Candy Dulfer are as a father-daughter duo both inseparable from their saxophones. Hans is a renowned saxophonist, known for his soulful and energetic performances, while Candy is a skilled saxophonist and flautist in her own right. Together, they have had multiple successful albums and have performed at some of the most prestigious jazz festivals around the world!', '/image/jazz/candyAndHansDulfer.png', '/image/jazz/artist1.png', 'Candy and Hans Dulfer'),
(2, 'Myles Sanko is a dynamic jazz singer and songwriter based in the city of London, England. Born in the coast of Ghana, Myles Sanko has quickly established himself as a force to be reckoned with on the local and global jazz scene with his unique Ghanian soul/jazz songs. Myles Sanko has already played at major jazz festivals around the Netherlands!', '/image/jazz/MylesSanko.png', '/image/jazz/artist2.png', 'Myles sanko'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist3.png', 'Gumbo Kings'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist4.png', 'Evolve'),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist5.png', 'Ntjam Rosie'),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist6.png', 'Wicked Jazz Sounds'),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist7.png', 'Tom Thomsom Assemble'),
(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist8.png', 'Jonna Frazer'),
(9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist9.png', 'Fox & The Mayors'),
(10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480.png', '/image/jazz/artist10.png', 'Uncle Sue'),
(11, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist11.png', 'Ruis Soundsystem'),
(12, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist12.png', 'The Family XL'),
(13, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist13.png', 'Gare du Nord'),
(14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist14.png', 'Rilan & The Bombadiers'),
(15, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist15.png', 'Soul Six'),
(16, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist16.png', 'Han Bennink'),
(17, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae velit eget sem facilisis iaculis. Morbi euismod nulla eget massa tempor, a facilisis quam lacinia. Donec euismod orci vel quam hendrerit, ac dictum enim malesuada. Nulla facilisi. Vestibulum eu turpis vitae nisi consequat finibus. Nullam nec odio quis nunc euismod auctor. Curabitur eu sapien ac nisi consectetur imperdiet.', 'https://via.placeholder.com/470x480', '/image/jazz/artist17.png', 'The Nordanians'),
(18, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos \nsapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam\nrecusandae alias error harum maxime adipisc', 'https://via.placeholder.com/470x480.png', 'artist18.png', 'Lilith Merlot');

--
-- Triggers `JazzArtists`
--
DELIMITER $$
CREATE TRIGGER `delete_related_timeslots` BEFORE DELETE ON `JazzArtists` FOR EACH ROW BEGIN
  DELETE FROM TimeSlots
  WHERE timeSlotID IN (SELECT timeSlotID FROM TimeSlotsJazz WHERE artistID = OLD.artistID);
  
  DELETE FROM TimeSlotsJazz
  WHERE artistID = OLD.artistID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `JazzLocations`
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
-- Gegevens worden geëxporteerd voor tabel `JazzLocations`
--

INSERT INTO `JazzLocations` (`locationID`, `locationName`, `address`, `locationImage`, `toAndFromText`, `accessibillityText`) VALUES
(1, 'Patronaat', 'Zijlsingel 2, 2013 DN Haarlem', '/image/jazz/location-patronaat.png', ' Patronaat is about <span>15 minutes walking distance</span> from Haarlem station <br>(a 1km distance)\n          </p>\n          <p>\n            Alternatively, you can take ride <span>buses 340, 346 or 356 one stop</span> to the Raaksburg. From there, it’ll be a minute on foot<br></p>\n          <p>\n            There are also <span>several parking options available</span>, like the parking garage RAAKS, which is a 5 minute walk away from the Patronaat\n          </p>', ' Patronaat is about <span>15 minutes walking distance</span> from Haarlem station <br>(a 1km distance)\n          </p>\n          <p>\n            Alternatively, you can take ride <span>buses 340, 346 or 356 one stop</span> to the Raaksburg. From there, it’ll be a minute on foot<br></p>\n          <p>\n            There are also <span>several parking options available</span>, like the parking garage RAAKS, which is a 5 minute walk away from the Patronaat\n          </p>'),
(2, 'Grote Markt', 'Grote Markt 2011 RD Haarlem', '/image/jazz/location-grote-markt.png', 'Grote Markt is easily accessible <span>by foot</span> within just 10 minutes from the station (800m distance)</p>\n<p>It is also accessible with <span>buses 3, 73 or 300</span>. Ride <span>two stops</span> for busses <span>3 and 73</span> to Ruychaverstraat, which is right next to the Grote Markt</p>\n<p>There are also <span>several parking options</span> available, like the parking garage De Appelaar', 'Grote Markt is easily accessible <span>by foot</span> within just 10 minutes from the station (800m distance)</p>\n<p>It is also accessible with <span>buses 3, 73 or 300</span>. Ride <span>two stops</span> for busses <span>3 and 73</span> to Ruychaverstraat, which is right next to the Grote Markt</p>\n<p>There are also <span>several parking options</span> available, like the parking garage De Appelaar');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `LandMarks`
--

CREATE TABLE `LandMarks` (
  `landMarkID` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `image` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Languages`
--

CREATE TABLE `Languages` (
  `languageID` int(11) NOT NULL,
  `language` varchar(45) DEFAULT NULL,
  `languageFlag` varchar(90) DEFAULT NULL,
  `guideID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Payments`
--

CREATE TABLE `Payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `programID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `PersonalPrograms`
--

CREATE TABLE `PersonalPrograms` (
  `programID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `isPaid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `PersonalPrograms`
--

INSERT INTO `PersonalPrograms` (`programID`, `userID`, `isPaid`) VALUES
(12, 20, 1),
(108, 20, 1),
(122, 20, 1),
(123, 20, 1),
(124, 20, 1),
(145, 20, 1),
(146, 23, 1),
(147, 25, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `RestaurantFoodTypes`
--

CREATE TABLE `RestaurantFoodTypes` (
  `foodType` int(11) NOT NULL,
  `restaurantID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `RestaurantFoodTypes`
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
-- Tabelstructuur voor tabel `RestaurantImages`
--

CREATE TABLE `RestaurantImages` (
  `imageID` int(11) NOT NULL,
  `restaurantID` int(11) DEFAULT NULL,
  `imageLink` varchar(90) DEFAULT NULL,
  `imageIndex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `RestaurantImages`
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
-- Tabelstructuur voor tabel `RestaurantMenuItems`
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
-- Gegevens worden geëxporteerd voor tabel `RestaurantMenuItems`
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
-- Tabelstructuur voor tabel `RestaurantReservation`
--

CREATE TABLE `RestaurantReservation` (
  `ticketID` int(11) NOT NULL,
  `timeSlotID` int(11) NOT NULL,
  `reservationName` varchar(255) NOT NULL,
  `phoneNumber` int(30) NOT NULL,
  `numberAdults` int(11) NOT NULL,
  `numberChildren` int(11) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `isActive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `RestaurantReservation`
--

INSERT INTO `RestaurantReservation` (`ticketID`, `timeSlotID`, `reservationName`, `phoneNumber`, `numberAdults`, `numberChildren`, `remark`, `isActive`) VALUES
(823, 500, 'asdddddd', 615448399, 2, 1, '', b'0'),
(824, 500, 'asdddddd', 615448399, 2, 1, '', b'0'),
(825, 500, 'asdddddd', 615448399, 2, 1, '', b'0'),
(1267, 500, 'asdddddd', 615448329, 3, 2, '', b'0'),
(1268, 500, 'asdddddd', 615448329, 3, 2, '', b'0'),
(1269, 500, 'asdddddd', 615448329, 3, 2, '', b'0'),
(1270, 500, 'asdddddd', 615448329, 3, 2, '', b'0'),
(1271, 500, 'asdddddd', 615448329, 3, 2, '', b'0'),
(1272, 542, 'Luuk Bakkum', 622134514, 3, 2, '', b'0'),
(1273, 542, 'Luuk Bakkum', 622134514, 3, 2, '', b'0'),
(1274, 542, 'Luuk Bakkum', 622134514, 3, 2, '', b'0'),
(1275, 542, 'Luuk Bakkum', 622134514, 3, 2, '', b'0'),
(1276, 542, 'Luuk Bakkum', 622134514, 3, 2, '', b'0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `StaticPage`
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
-- Tabelstructuur voor tabel `TimeSlots`
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
-- Gegevens worden geëxporteerd voor tabel `TimeSlots`
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
(1001, 1, 15, '2023-07-27 19:30:00', '2023-07-27 20:30:00', 1),
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
(1020, 1, 0, '2023-07-30 17:00:00', '2023-07-30 18:00:00', 0),
(1021, 1, 0, '2023-07-30 18:00:00', '2023-07-30 19:00:00', 0),
(1022, 1, 0, '2023-07-30 19:00:00', '2023-07-30 20:00:00', 0),
(1023, 1, 1, '2023-07-30 20:00:00', '2023-07-30 21:00:00', 0),
(1996, 1, 35, '2023-07-27 00:00:00', '2023-07-27 23:59:59', 50),
(1997, 1, 35, '2023-07-28 00:00:00', '2023-07-28 23:59:59', 50),
(1998, 1, 35, '2023-07-29 00:00:00', '2023-07-29 23:59:59', 50),
(1999, 1, 80, '2023-07-27 00:00:00', '2023-07-29 23:59:59', 50);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `TimeSlotsJazz`
--

CREATE TABLE `TimeSlotsJazz` (
  `timeSlotID` int(11) NOT NULL,
  `artistID` int(11) DEFAULT NULL,
  `locationID` int(11) DEFAULT NULL,
  `hallID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `TimeSlotsJazz`
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
(1017, 8, 1, 2),
(1018, 9, 2, 0),
(1020, 11, 2, 0),
(1021, 15, 2, 0),
(1022, 2, 2, 0),
(1023, 3, 2, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `TimeSlotsStrollThroughHistory`
--

CREATE TABLE `TimeSlotsStrollThroughHistory` (
  `timeSlotID` int(11) NOT NULL,
  `languageID` int(11) DEFAULT NULL,
  `GuideID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `TimeSlotsYummy`
--

CREATE TABLE `TimeSlotsYummy` (
  `timeSlotID` int(11) NOT NULL,
  `restaurantID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `TimeSlotsYummy`
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
-- Tabelstructuur voor tabel `Users`
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
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`userID`, `email`, `userRole`, `fullName`, `phoneNumber`, `password`) VALUES
(13, 'john.doe@example.com', 1, 'john.doe@example.com', '4545454545', '$2y$10$IhjUAu37AKW/bQD5Rzw3wux0cVhGn8LfG5wdj11GvEGzi9oCQBLQO'),
(18, 'regularUser@gmail.com', 0, 'Harry', '0615335353', '$2y$10$okCM8QH82kYm4qhq.yoobeurw2UyP5YKAn287f.TDcvTiZSEV.rYe'),
(19, 'adminUser@gmail.com', 1, 'Tayam', '0615151515', '$2y$10$uYAlMthlE8ZJ74qUHZmPKO7BbGihg3ADjE5RTM.xWLsdiomEVBAnO'),
(20, 'admin@admin.com', 1, 'John William Theodorus Johannes Biggus Dickus The Second', '0615448322', '$2y$10$uYAlMthlE8ZJ74qUHZmPKO7BbGihg3ADjE5RTM.xWLsdiomEVBAnO'),
(21, 'Gebruiker1@gmail.com', 0, 'aaaaaaaa', '3298123982398', '$2y$10$hp3NOPqG8fKZaDkKtTmX9ewAorL7CpCEWM6Jq3AgP8ZXV59Ke4m8m'),
(22, 'Tayam0nline@gmail.com', 0, 'Tayam', '05216318753283129873', '$2y$10$g3Ur/6G.O7X40qbIoS/YM.3/PKNNKAwIcooaqzII82.dlUhhiAbh.'),
(23, 'admin@thefestival.com', 1, 'Tatsuro Yamashita', '0615151515', '$2y$10$q6Qq0gjgo2CTvcnqHXzkcO6SYJ52Mnvpp/Byd0yJZAgmja8eq8P9K'),
(24, 'testUser@testuser.com', 0, 'testUser@testuser.com', '0615151515', '$2y$10$h7hGQ.CXaO8u.wCHKGZNmOJGFylNWKwt2BUZckOjJMEa7TF4TkWim'),
(25, 'luuk.bakkum2000@gmail.com', 0, 'luuk.bakkum2000@gmail.com', '0616161616', '$2y$10$He90w4W2dLNm.Waa4M7F9O59lX.UW2Ru8m5eRQVGZ2YeLP.v.8ooa'),
(26, 'mark@gmail.com', 0, 'mark de haan', '0615151515', '$2y$10$V3gLwcnoyH//r6Hb55Bu9Oj/q.3AHArAz/6anSEOISvw5NGPEkdBe');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `YummyRestaurants`
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
-- Gegevens worden geëxporteerd voor tabel `YummyRestaurants`
--

INSERT INTO `YummyRestaurants` (`restaurantID`, `restaurantName`, `address`, `contact`, `cardDescription`, `description`, `amountOfStars`, `bannerImage`, `headChef`, `amountSessions`, `adultPrice`, `childPrice`) VALUES
(1, 'Mr & Mrs', 'Lange Veerstraat 4,2011 DB / Haarlem', 'Tel: 023-2071006,info@mrandmrs.nl', 'Mr & Mrs is known for its quality Dutch cuisine and seafood. Interested?', 'Here you can enjoy a extensive lunch, grab a drink at the bar or a delicious diner! In the summer you can enjoy a delicious meal under the sun on their spacious terrace.', 4, 'yummy/detail/mr&mrs/mr&mrsLogo.jpg\n', 'Marcel Huisman', 3, 45, 22.5),
(2, 'Ratatouille', 'Spaarne 96, 2011 CL Haarlem / Netherlands', 'Tel: 023-5321699,info@ratatouille.nl', 'This is the place to be for a chic French dining experience. Serving dinner A La Carte, here at Ratatouille you will experience a whole new level of dining.', 'For a intimate, cosy and great dinner experience with friends and family take place in our beautiful restaurant area. What are our signature dishes? That are the Côte de Boeuf and the lobster.', 4, 'yummy/detail/ratatouille/rataLogo.png\n', 'Fillipe Eqlair', 3, 45, 22.5),
(3, 'Restaurant Fris', 'Twijnderslaan 7, 2012 BG / Haarlem', 'Tel: 023-2071006,info@restaurantfris.nl', 'Known for its authentic Dutch and French dishes, at Fris you can relax  with friends and family over unique dishes.', 'Our passion for food and drink is in the choices in the menu. No incomprehensible hassle with the food, but honest, recognizable dishes based on natural ingrediënts. Completely with excelent wine, a selection of Jopen Beer and delicious Peeze koffie.', 4, 'yummy/detail/fris/frisLogo.jpg\n', 'Thomas Klaploper', 3, 45, 22.5),
(4, 'Specktakel', 'Spekstraat 4, 2011 HM / Haarlem', 'Tel: 023-2071006,info@specktakel.nl', 'With its rustic decor, the food stands out even more. Get a delecious steak or try out their famous burger. They offer a variaty of dishes from around the world.', 'Here at Specktakel we focus on pure and quality products, in the kitchen as behind the bar and in our service, accessable but of high quality. A table full dilicious foods and wines, thats what we think a great evening out looks like.', 3, 'yummy/detail/specktakel/speckLogo.jpg\n', 'Piet Weghorst', 3, 35, 17.5);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `APIs`
--
ALTER TABLE `APIs`
  ADD PRIMARY KEY (`ApiID`);

--
-- Indexen voor tabel `EventTickets`
--
ALTER TABLE `EventTickets`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `timeSlotID` (`timeSlotID`),
  ADD KEY `programID` (`programID`);

--
-- Indexen voor tabel `FestivalEvents`
--
ALTER TABLE `FestivalEvents`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexen voor tabel `FestivalInformation`
--
ALTER TABLE `FestivalInformation`
  ADD PRIMARY KEY (`festivalID`);

--
-- Indexen voor tabel `FoodTypes`
--
ALTER TABLE `FoodTypes`
  ADD PRIMARY KEY (`foodTypeID`);

--
-- Indexen voor tabel `Guides`
--
ALTER TABLE `Guides`
  ADD PRIMARY KEY (`guideID`),
  ADD KEY `languageID` (`languageID`);

--
-- Indexen voor tabel `Halls`
--
ALTER TABLE `Halls`
  ADD PRIMARY KEY (`hallID`,`locationID`) USING BTREE,
  ADD KEY `locationID` (`locationID`);

--
-- Indexen voor tabel `History`
--
ALTER TABLE `History`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexen voor tabel `HistoryDetailPages`
--
ALTER TABLE `HistoryDetailPages`
  ADD PRIMARY KEY (`landMarkID`);

--
-- Indexen voor tabel `JazzAlbums`
--
ALTER TABLE `JazzAlbums`
  ADD PRIMARY KEY (`albumID`),
  ADD KEY `artistID` (`artistID`);

--
-- Indexen voor tabel `JazzArtists`
--
ALTER TABLE `JazzArtists`
  ADD PRIMARY KEY (`artistID`);

--
-- Indexen voor tabel `JazzLocations`
--
ALTER TABLE `JazzLocations`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexen voor tabel `LandMarks`
--
ALTER TABLE `LandMarks`
  ADD PRIMARY KEY (`landMarkID`);

--
-- Indexen voor tabel `Languages`
--
ALTER TABLE `Languages`
  ADD PRIMARY KEY (`languageID`);

--
-- Indexen voor tabel `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `PersonalPrograms`
--
ALTER TABLE `PersonalPrograms`
  ADD PRIMARY KEY (`programID`),
  ADD KEY `userID` (`userID`);

--
-- Indexen voor tabel `RestaurantFoodTypes`
--
ALTER TABLE `RestaurantFoodTypes`
  ADD PRIMARY KEY (`restaurantID`,`foodType`),
  ADD KEY `foodType` (`foodType`);

--
-- Indexen voor tabel `RestaurantImages`
--
ALTER TABLE `RestaurantImages`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexen voor tabel `RestaurantMenuItems`
--
ALTER TABLE `RestaurantMenuItems`
  ADD PRIMARY KEY (`menuItemID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexen voor tabel `RestaurantReservation`
--
ALTER TABLE `RestaurantReservation`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `timeSlotID` (`timeSlotID`);

--
-- Indexen voor tabel `StaticPage`
--
ALTER TABLE `StaticPage`
  ADD PRIMARY KEY (`pageID`);

--
-- Indexen voor tabel `TimeSlots`
--
ALTER TABLE `TimeSlots`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexen voor tabel `TimeSlotsJazz`
--
ALTER TABLE `TimeSlotsJazz`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `artistID` (`artistID`),
  ADD KEY `locationID` (`locationID`),
  ADD KEY `hallID` (`hallID`);

--
-- Indexen voor tabel `TimeSlotsStrollThroughHistory`
--
ALTER TABLE `TimeSlotsStrollThroughHistory`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `languageID` (`languageID`);

--
-- Indexen voor tabel `TimeSlotsYummy`
--
ALTER TABLE `TimeSlotsYummy`
  ADD PRIMARY KEY (`timeSlotID`),
  ADD KEY `restaurantID` (`restaurantID`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexen voor tabel `YummyRestaurants`
--
ALTER TABLE `YummyRestaurants`
  ADD PRIMARY KEY (`restaurantID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `APIs`
--
ALTER TABLE `APIs`
  MODIFY `ApiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `EventTickets`
--
ALTER TABLE `EventTickets`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1286;

--
-- AUTO_INCREMENT voor een tabel `FestivalEvents`
--
ALTER TABLE `FestivalEvents`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `FestivalInformation`
--
ALTER TABLE `FestivalInformation`
  MODIFY `festivalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `Guides`
--
ALTER TABLE `Guides`
  MODIFY `guideID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `JazzAlbums`
--
ALTER TABLE `JazzAlbums`
  MODIFY `albumID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `JazzArtists`
--
ALTER TABLE `JazzArtists`
  MODIFY `artistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT voor een tabel `JazzLocations`
--
ALTER TABLE `JazzLocations`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT voor een tabel `LandMarks`
--
ALTER TABLE `LandMarks`
  MODIFY `landMarkID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Languages`
--
ALTER TABLE `Languages`
  MODIFY `languageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Payments`
--
ALTER TABLE `Payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT voor een tabel `PersonalPrograms`
--
ALTER TABLE `PersonalPrograms`
  MODIFY `programID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT voor een tabel `RestaurantImages`
--
ALTER TABLE `RestaurantImages`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `RestaurantMenuItems`
--
ALTER TABLE `RestaurantMenuItems`
  MODIFY `menuItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT voor een tabel `RestaurantReservation`
--
ALTER TABLE `RestaurantReservation`
  MODIFY `ticketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1277;

--
-- AUTO_INCREMENT voor een tabel `StaticPage`
--
ALTER TABLE `StaticPage`
  MODIFY `pageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `TimeSlots`
--
ALTER TABLE `TimeSlots`
  MODIFY `timeSlotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000;

--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT voor een tabel `YummyRestaurants`
--
ALTER TABLE `YummyRestaurants`
  MODIFY `restaurantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `EventTickets`
--
ALTER TABLE `EventTickets`
  ADD CONSTRAINT `EventTickets_ibfk_1` FOREIGN KEY (`timeSlotID`) REFERENCES `TimeSlots` (`timeSlotID`),
  ADD CONSTRAINT `EventTickets_ibfk_2` FOREIGN KEY (`programID`) REFERENCES `PersonalPrograms` (`programID`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `Guides`
--
ALTER TABLE `Guides`
  ADD CONSTRAINT `Guides_ibfk_1` FOREIGN KEY (`languageID`) REFERENCES `Languages` (`languageID`);

--
-- Beperkingen voor tabel `Halls`
--
ALTER TABLE `Halls`
  ADD CONSTRAINT `Halls_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `JazzLocations` (`locationID`);

--
-- Beperkingen voor tabel `History`
--
ALTER TABLE `History`
  ADD CONSTRAINT `History_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `FestivalEvents` (`eventID`);

--
-- Beperkingen voor tabel `HistoryDetailPages`
--
ALTER TABLE `HistoryDetailPages`
  ADD CONSTRAINT `HistoryDetailPages_ibfk_1` FOREIGN KEY (`landMarkID`) REFERENCES `LandMarks` (`landMarkID`);

--
-- Beperkingen voor tabel `JazzAlbums`
--
ALTER TABLE `JazzAlbums`
  ADD CONSTRAINT `JazzAlbums_ibfk_1` FOREIGN KEY (`artistID`) REFERENCES `JazzArtists` (`artistID`);

--
-- Beperkingen voor tabel `PersonalPrograms`
--
ALTER TABLE `PersonalPrograms`
  ADD CONSTRAINT `PersonalPrograms_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);

--
-- Beperkingen voor tabel `RestaurantFoodTypes`
--
ALTER TABLE `RestaurantFoodTypes`
  ADD CONSTRAINT `RestaurantFoodTypes_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`),
  ADD CONSTRAINT `RestaurantFoodTypes_ibfk_2` FOREIGN KEY (`foodType`) REFERENCES `FoodTypes` (`foodTypeID`);

--
-- Beperkingen voor tabel `RestaurantImages`
--
ALTER TABLE `RestaurantImages`
  ADD CONSTRAINT `RestaurantImages_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`);

--
-- Beperkingen voor tabel `RestaurantMenuItems`
--
ALTER TABLE `RestaurantMenuItems`
  ADD CONSTRAINT `RestaurantMenuItems_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`);

--
-- Beperkingen voor tabel `RestaurantReservation`
--
ALTER TABLE `RestaurantReservation`
  ADD CONSTRAINT `RestaurantReservation_ibfk_1` FOREIGN KEY (`timeSlotID`) REFERENCES `TimeSlots` (`timeSlotID`),
  ADD CONSTRAINT `RestaurantReservation_ibfk_2` FOREIGN KEY (`ticketID`) REFERENCES `EventTickets` (`ticketID`);

--
-- Beperkingen voor tabel `TimeSlots`
--
ALTER TABLE `TimeSlots`
  ADD CONSTRAINT `TimeSlots_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `FestivalEvents` (`eventID`);

--
-- Beperkingen voor tabel `TimeSlotsJazz`
--
ALTER TABLE `TimeSlotsJazz`
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_1` FOREIGN KEY (`timeSlotID`) REFERENCES `TimeSlots` (`timeSlotID`) ON DELETE CASCADE,
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_2` FOREIGN KEY (`artistID`) REFERENCES `JazzArtists` (`artistID`),
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_3` FOREIGN KEY (`locationID`) REFERENCES `JazzLocations` (`locationID`),
  ADD CONSTRAINT `TimeSlotsJazz_ibfk_4` FOREIGN KEY (`hallID`) REFERENCES `Halls` (`hallID`);

--
-- Beperkingen voor tabel `TimeSlotsStrollThroughHistory`
--
ALTER TABLE `TimeSlotsStrollThroughHistory`
  ADD CONSTRAINT `TimeSlotsStrollThroughHistory_ibfk_1` FOREIGN KEY (`languageID`) REFERENCES `Languages` (`languageID`);

--
-- Beperkingen voor tabel `TimeSlotsYummy`
--
ALTER TABLE `TimeSlotsYummy`
  ADD CONSTRAINT `TimeSlotsYummy_ibfk_1` FOREIGN KEY (`timeSlotID`) REFERENCES `TimeSlots` (`timeSlotID`),
  ADD CONSTRAINT `TimeSlotsYummy_ibfk_2` FOREIGN KEY (`restaurantID`) REFERENCES `YummyRestaurants` (`restaurantID`);

DELIMITER $$
--
-- Gebeurtenissen
--
CREATE DEFINER=`root`@`%` EVENT `delete_old_payments` ON SCHEDULE EVERY 1 HOUR STARTS '2023-06-19 11:35:36' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM payments WHERE created_at < (NOW() - INTERVAL 24 HOUR)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
