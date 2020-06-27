-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Jun 2020 um 11:00
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `fullstack111`
--
CREATE DATABASE IF NOT EXISTS `fullstack111` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fullstack111`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) DEFAULT NULL,
  `fk_smartphone` int(11) DEFAULT NULL,
  `fk_cover` int(11) DEFAULT NULL,
  `fk_headphone` int(11) DEFAULT NULL,
  `fk_charger` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `cart`
--

INSERT INTO `cart` (`id`, `fk_user`, `fk_smartphone`, `fk_cover`, `fk_headphone`, `fk_charger`) VALUES
(108, 18, NULL, NULL, NULL, NULL),
(109, 18, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charger`
--

CREATE TABLE `charger` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `brand` enum('Apple','Samsung','HTC') NOT NULL,
  `output_power` enum('12 watt','15 watt','18 watt','19.5 watt','27 watt','30 watt') NOT NULL,
  `price` float NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `amount_available` int(11) NOT NULL,
  `adding_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visible` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `charger`
--

INSERT INTO `charger` (`id`, `name`, `img`, `brand`, `output_power`, `price`, `discount`, `amount_available`, `adding_date`, `visible`) VALUES
(1, 'iPhone Charger', 'http://www.pngmart.com/files/5/Charger-PNG-Image.png', 'Apple', '18 watt', 4.99, NULL, 50, '2020-05-26 19:22:08', '1'),
(2, 'For Car', 'http://www.pngmart.com/files/5/Charger-PNG-HD.png', 'HTC', '12 watt', 30, NULL, 20, '2020-06-11 10:21:53', '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cover`
--

CREATE TABLE `cover` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `brand` enum('Apple','Samsung','HTC') NOT NULL,
  `type` enum('flip','back','book') NOT NULL,
  `price` float NOT NULL,
  `discount` tinyint(3) DEFAULT NULL,
  `amount_available` int(11) NOT NULL,
  `adding_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visible` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `cover`
--

INSERT INTO `cover` (`id`, `name`, `img`, `brand`, `type`, `price`, `discount`, `amount_available`, `adding_date`, `visible`) VALUES
(1, 'Red Cover', 'http://www.pngmart.com/files/7/Mobile-Cover-PNG-Image.png', 'HTC', 'book', 9.99, NULL, 100, '2020-05-31 08:37:16', '1'),
(2, 'Blue Cover', 'http://www.pngmart.com/files/7/Mobile-Cover-PNG-Free-Download.png', 'HTC', 'back', 15, NULL, 20, '2020-05-26 19:20:57', '1'),
(3, 'Pink Cover', 'http://www.pngmart.com/files/7/Mobile-Cover-PNG-Transparent.png', 'Samsung', 'back', 20, NULL, 20, '2020-05-26 19:21:11', '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `faq`
--

INSERT INTO `faq` (`id`, `topic`, `text`) VALUES
(1, 'Your Account', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 'Log In', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(3, 'Password', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `headphone`
--

CREATE TABLE `headphone` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `brand` enum('Apple','Samsung','HTC') NOT NULL,
  `type` enum('in-ear','on-ear') NOT NULL,
  `wireless` enum('yes','no','optional') NOT NULL,
  `electrical_impendance` enum('16 ohm','24 ohm','32 ohm','47 ohm') NOT NULL,
  `microphone` enum('yes','no') NOT NULL,
  `price` float NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `amount_available` int(11) NOT NULL,
  `adding_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `visible` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `headphone`
--

INSERT INTO `headphone` (`id`, `name`, `img`, `brand`, `type`, `wireless`, `electrical_impendance`, `microphone`, `price`, `discount`, `amount_available`, `adding_date`, `visible`) VALUES
(2, 'Small Headphones', 'https://purepng.com/public/uploads/medium/purepng.com-music-headphonemusicheadphoneearphoneslisteningearssounds-231519334626cxkws.png', 'HTC', 'on-ear', 'yes', '24 ohm', 'no', 100, 20, 200, '2020-05-26 19:21:32', '1'),
(3, 'Big Headphones', 'https://purepng.com/public/uploads/medium/purepng.com-headphoneelectronics-headset-headphone-941524669594nj2m3.png', 'Apple', 'on-ear', 'optional', '24 ohm', 'yes', 150, NULL, 100, '2020-05-26 19:21:42', '1'),
(5, 'Earphones', 'https://purepng.com/public/uploads/medium/purepng.com-music-headphonemusicheadphoneearphoneslisteningearssounds-231519334521p4b2l.png', 'Samsung', 'in-ear', 'no', '24 ohm', 'no', 30, NULL, 50, '2020-05-26 19:21:50', '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `fk_cart` int(11) NOT NULL,
  `fk_recipient` int(11) NOT NULL,
  `fk_payment` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `topic` varchar(100) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`id`, `fk_user`, `topic`, `msg`, `send_date`) VALUES
(3, 1, 'irgendwas', 'nachricht', '2020-04-30 14:59:16'),
(4, 1, 'new topic', 'my message', '2020-04-30 14:59:22'),
(5, 1, 'ökljv', 'Enter your message here', '2020-04-30 14:59:28'),
(6, 1, 'ökljv', 'Enter your message here', '2020-04-30 14:59:34'),
(7, 1, 'ökljv', 'Enter your message here', '2020-04-30 14:59:39'),
(8, 1, 'ökljv', 'Enter your message here', '2020-04-30 14:59:46'),
(9, 1, 'ökljv', 'Enter your message here', '2020-04-30 14:59:51'),
(10, 1, 'ökljv', 'Enter your message here', '2020-04-30 14:59:57'),
(11, 1, 'ökljv', 'Enter your message here', '2020-04-30 15:00:02'),
(12, 1, 'ökhug', 'blabla', '2020-04-30 15:00:08'),
(13, 1, 'ökhug', 'blabla', '2020-04-30 15:00:15'),
(14, 1, 'ökhug', 'blabla', '2020-04-30 15:00:20'),
(15, 1, 'ökhug', 'blabla', '2020-04-30 15:00:26'),
(16, 1, 'älökjj', 'blablabla', '2020-04-30 15:00:32'),
(17, 1, 'my topic', 'message', '2020-04-30 15:00:38'),
(18, 1, 'test', 'hallo', '2020-04-30 15:00:44'),
(19, 1, 'adsf', 'asdf', '2020-04-30 15:00:50'),
(20, 1, 'adsf', 'asdf', '2020-04-30 15:00:55'),
(21, 1, 'test2', 'hallo', '2020-04-30 15:01:00'),
(22, 1, 'testo233', 'Huhu', '2020-04-30 15:01:05'),
(23, 1, 'sdf', 'sdf', '2020-04-30 15:01:11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipient`
--

CREATE TABLE `recipient` (
  `id` int(11) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `recipient`
--

INSERT INTO `recipient` (`id`, `f_name`, `l_name`, `address`, `phone_number`) VALUES
(14, 'asdf', 'sdf', 'sdf', 'asdf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_smartphone` int(11) DEFAULT NULL,
  `fk_cover` int(11) DEFAULT NULL,
  `fk_headphone` int(11) DEFAULT NULL,
  `fk_charger` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `text_area` varchar(255) NOT NULL,
  `stars` tinyint(1) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `review`
--

INSERT INTO `review` (`id`, `fk_user`, `fk_smartphone`, `fk_cover`, `fk_headphone`, `fk_charger`, `title`, `text_area`, `stars`, `creation_date`) VALUES
(10, 7, 27, NULL, NULL, NULL, 'Einfach', 'Geeeeil!', 5, '2020-05-31 17:14:47'),
(12, 24, 25, NULL, NULL, NULL, 'Ein bemerkenswerter Ziegel', 'Einfach großartig. Ich weiß nicht was ich schreiben soll!!', 4, '2020-05-24 12:09:58'),
(13, 25, 27, NULL, NULL, NULL, 'Hält nichts aus!', 'Wollte damit ein paar Steine wuchten, aber das Display ist sofort gecrackt!!!elf', 2, '2020-05-24 12:08:32');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `smartphone`
--

CREATE TABLE `smartphone` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `brand` enum('Apple','Samsung','HTC') NOT NULL,
  `processor_frequency` varchar(10) NOT NULL,
  `processor_type` varchar(50) NOT NULL,
  `display_resolution` varchar(100) NOT NULL,
  `display_technology` varchar(50) NOT NULL,
  `camera_main` varchar(20) NOT NULL,
  `camera_front` varchar(20) NOT NULL,
  `ram` varchar(50) NOT NULL,
  `internal_memory` varchar(25) NOT NULL,
  `sim_card` varchar(10) NOT NULL,
  `sim_slot` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `discount` tinyint(3) DEFAULT NULL,
  `visible` enum('1','0') NOT NULL,
  `adding_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount_available` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `smartphone`
--

INSERT INTO `smartphone` (`id`, `name`, `img`, `brand`, `processor_frequency`, `processor_type`, `display_resolution`, `display_technology`, `camera_main`, `camera_front`, `ram`, `internal_memory`, `sim_card`, `sim_slot`, `price`, `discount`, `visible`, `adding_date`, `amount_available`) VALUES
(22, 'Superphone', 'https://via.placeholder.com/320x480.jpg', 'Apple', '2 GHz', '', 'amoled', '', '16 megapixel', '', '8 gb', '256 gb', '5g', '', 500, 0, '', '2020-05-26 19:17:34', 0),
(23, 'Black iPhone', 'http://www.pngmart.com/files/2/Smartphone-Transparent-Background.png', 'Apple', '2.3 GHz', 'quadcore', '1080 x 2636', 'Dynamic AMOLED', '12 MP', '', '8 GB', '256 GB', 'dual SIM', 'Sim 1 + eSim', 400, 5, '1', '2020-05-26 19:18:29', 80),
(24, 'Silver iPhone', 'http://www.pngmart.com/files/2/Smartphone-PNG-HD.png', 'Apple', '2.4 GHz', 'dualcore', '1080 x 2636', 'tn-panel', '12 MP', '', '8 GB', '256 GB', 'micro SIM', 'Sim 1', 300, 10, '1', '2020-05-26 19:18:57', 70),
(25, 'Lightsaber', 'http://www.pngmart.com/files/7/Mobile-Phone-Transparent-Images-PNG.png', 'Samsung', '2.4 GHz', 'dualcore', '1080 x 2636', 'Dynamic AMOLED', '12 MP', '', '8 GB', '256 GB', 'dual SIM', 'Sim 1 + eSim', 250, 15, '1', '2020-05-26 19:19:24', 90),
(27, 'Small Phone', 'https://purepng.com/public/uploads/medium/purepng.com-mobile-phone-with-touchmobilemobile-phonehandymobile-devicetouchscreenmobile-phone-device-231519332728jhjqr.png', 'Samsung', '2.4 GHz', 'er', 'sdf', 'sdf', 'sdf', 'sdf', '34 gb', '300gb', 'sdf', 'asdf', 200, 34, '1', '2020-05-31 08:36:29', 100);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('permitted','banned') DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `session` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `status`, `role`, `session`) VALUES
(1, 'testo', 'gicki@testo.com', '$2y$10$S6qHs/VVBNUILqGGaXeLIeO5fvs5bZeWyYJnJcEJqV4wPPS0S0qdm', 'banned', 'user', ''),
(3, 'tester', 'hallo@example.com', '$2y$10$/TS/5aYeqI4BC1xwY0EdduTDunBReIm6hPvBLMzFYIpAo9zOPhxde', NULL, 'admin', NULL),
(7, 'testuser', 'testuser@testuser.com', '$2y$10$UY1EmhQBtKloVooRhQVDoeUMjDOipXWxTIcxQDFD6izunxmeNvMKG', 'permitted', 'user', ''),
(18, 'ASC', 'alexander.schaedlich@gmail.com', '$2y$10$S6qHs/VVBNUILqGGaXeLIeO5fvs5bZeWyYJnJcEJqV4wPPS0S0qdm', 'permitted', 'user', '{\"cart\":{\"products\":[{\"id\":\"2\",\"name\":\"Blue Cover\",\"img\":\"http://www.pngmart.com/files/7/Mobile-Cover-PNG-Free-Download.png\",\"brand\":\"HTC\",\"type\":\"back\",\"price\":\"15\",\"discount\":\"\",\"amount_available\":\"20\",\"adding_date\":\"2020-05-26 21:20:57\",\"visible\":\"1\",\"category\":\"cover\",\"old_price\":\"0\",\"new_price\":\"15\",\"ratings\":\"\",\"stars\":\"0\"}],\"total_items\":0},\"user\":\"18\"}'),
(19, 'ASC', 'alexander.schaedlich@gmail.com', '$2y$10$ZzLxsa24FuU3antU9klvZ.xRh.auk4E0KY0mTNJq8xhfcx6G1LzOC', NULL, 'admin', NULL),
(23, 'testadmin', 'a@b.de', '$2y$10$/UwYr0igfbIvWH3SDu2REOT8HMf/8pGAThy/v2JuucCSLfh4wCbBC', NULL, 'user', NULL),
(24, 'Fritz', 'fritzpick@posteo.at', '$2y$10$CW6pIiSJD0i05u7Wy1qo4ub8bVvjt5DKo049mojOYmDX../m.B0iu', NULL, 'user', NULL),
(25, 'Gimli', 'fripick@gmail.com', '$2y$10$5F.8KssOrqBAUcBhlCFrYeNDSeJiKurnJeWrizU7JOl5RoSw/UcL6', NULL, 'user', NULL),
(26, 'test', 'test@gmail.com', '$2y$10$jw3pipJtNL5wQbHIExeOf.d89HgYzuiPx1XjJOgJ.nVJC1259SK76', NULL, 'user', '{\"user\":\"26\",\"cart\":{\"products\":[],\"total_items\":0}}');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_ibfk_2` (`fk_user`),
  ADD KEY `fk_smartphone` (`fk_smartphone`),
  ADD KEY `fk_cover` (`fk_cover`),
  ADD KEY `fk_headphone` (`fk_headphone`),
  ADD KEY `fk_charger` (`fk_charger`);

--
-- Indizes für die Tabelle `charger`
--
ALTER TABLE `charger`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `headphone`
--
ALTER TABLE `headphone`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart` (`fk_cart`),
  ADD KEY `fk_recipient` (`fk_recipient`),
  ADD KEY `fk_payment` (`fk_payment`);

--
-- Indizes für die Tabelle `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`) USING BTREE;

--
-- Indizes für die Tabelle `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_ibfk_1` (`fk_user`),
  ADD KEY `fk_smartphone` (`fk_smartphone`),
  ADD KEY `fk_cover` (`fk_cover`),
  ADD KEY `fk_headphone` (`fk_headphone`),
  ADD KEY `fk_charger` (`fk_charger`);

--
-- Indizes für die Tabelle `smartphone`
--
ALTER TABLE `smartphone`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT für Tabelle `charger`
--
ALTER TABLE `charger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `headphone`
--
ALTER TABLE `headphone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `recipient`
--
ALTER TABLE `recipient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `smartphone`
--
ALTER TABLE `smartphone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`fk_smartphone`) REFERENCES `smartphone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_4` FOREIGN KEY (`fk_cover`) REFERENCES `cover` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_5` FOREIGN KEY (`fk_headphone`) REFERENCES `headphone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_6` FOREIGN KEY (`fk_charger`) REFERENCES `charger` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`fk_cart`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`fk_recipient`) REFERENCES `recipient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`fk_payment`) REFERENCES `payment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`fk_smartphone`) REFERENCES `smartphone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`fk_cover`) REFERENCES `cover` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_4` FOREIGN KEY (`fk_headphone`) REFERENCES `headphone` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_5` FOREIGN KEY (`fk_charger`) REFERENCES `charger` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
