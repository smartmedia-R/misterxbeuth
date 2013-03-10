-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Mrz 2013 um 14:05
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `misterx_db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `alleuser`
--

CREATE TABLE IF NOT EXISTS `alleuser` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Vorname` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Passwort` varchar(45) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `alleuser`
--

INSERT INTO `alleuser` (`UserID`, `Name`, `Vorname`, `Email`, `Passwort`) VALUES
(1, 'alex', 'test_test', 'alex_test@mail.com', '1c115776ec3071438831f26f472fbfbc'),
(2, 'xcsyc', 'adss', 'sdcfs@mail.com', '1c115776ec3071438831f26f472fbfbc'),
(3, 'asd', 'asd', 'asd@mail.com', '1c115776ec3071438831f26f472fbfbc'),
(4, 'qwer', 'qwer', 'qwer@mail.com', '1c115776ec3071438831f26f472fbfbc'),
(5, 'qay', 'qay', 'qay@dsfdssd.qa', '1c115776ec3071438831f26f472fbfbc'),
(6, 'oooo', 'oooo', 'ooooo@oooo.com', '1c115776ec3071438831f26f472fbfbc'),
(7, 'rrrrr', 'rrrrr', 'rrrrr@rrrr.com', '1c115776ec3071438831f26f472fbfbc'),
(8, 'wwwww', 'wwwwww', 'wwwwww@mail.ru', '1c115776ec3071438831f26f472fbfbc'),
(9, 'rrrrr', 'rrrrr', 'rrrrr@rrrr1111.com', '1c115776ec3071438831f26f472fbfbc'),
(10, 'wsws', 'wsws', 'wsws@wswsw.com', '1c115776ec3071438831f26f472fbfbc'),
(11, 'qqqqqq', 'qqqqqq', 'qqqqqqq@mail.com', '1c115776ec3071438831f26f472fbfbc'),
(12, 'qayqay', 'qayqay', 'qayqay@qay.com', '1c115776ec3071438831f26f472fbfbc');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coord`
--

CREATE TABLE IF NOT EXISTS `coord` (
  `coordID` int(11) NOT NULL AUTO_INCREMENT,
  `xAchse` int(11) DEFAULT NULL,
  `yAchse` int(11) DEFAULT NULL,
  `statusmrx` int(11) DEFAULT NULL,
  `statusdet` int(11) DEFAULT NULL,
  PRIMARY KEY (`coordID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `coord`
--

INSERT INTO `coord` (`coordID`, `xAchse`, `yAchse`, `statusmrx`, `statusdet`) VALUES
(1, 100, 100, NULL, NULL),
(2, 300, 100, NULL, NULL),
(3, 500, 100, NULL, NULL),
(4, 200, 300, 1, NULL),
(5, 400, 300, NULL, NULL),
(6, 600, 300, NULL, NULL),
(7, 100, 500, NULL, NULL),
(8, 300, 500, NULL, NULL),
(9, 500, 500, NULL, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `neighbors`
--

CREATE TABLE IF NOT EXISTS `neighbors` (
  `NeighborID` int(11) NOT NULL AUTO_INCREMENT,
  `rot` int(11) DEFAULT NULL,
  `gruen` int(11) DEFAULT NULL,
  `blau` int(11) DEFAULT NULL,
  `CoordID_Neighbor` int(11) DEFAULT NULL,
  `coordID` int(11) NOT NULL,
  PRIMARY KEY (`NeighborID`),
  KEY `fk_Neighbors_Coord1_idx` (`coordID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `neighbors`
--

INSERT INTO `neighbors` (`NeighborID`, `rot`, `gruen`, `blau`, `CoordID_Neighbor`, `coordID`) VALUES
(1, 1, NULL, NULL, 2, 1),
(2, 1, NULL, NULL, 4, 1),
(3, NULL, NULL, 1, 8, 1),
(4, NULL, 1, NULL, 7, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tablespieler`
--

CREATE TABLE IF NOT EXISTS `tablespieler` (
  `SpielerID` int(11) NOT NULL AUTO_INCREMENT,
  `Beschreibung` varchar(45) DEFAULT NULL,
  `MisterX` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `coordID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SpielerID`),
  KEY `fk_tableSpieler_alleUser1_idx` (`UserID`),
  KEY `fk_tableSpieler_Coord1_idx` (`coordID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `tablespieler`
--

INSERT INTO `tablespieler` (`SpielerID`, `Beschreibung`, `MisterX`, `UserID`, `coordID`) VALUES
(2, 'rrrrr', NULL, 7, NULL),
(3, 'wwwww', NULL, 8, NULL),
(4, 'rrrrr', NULL, 9, NULL),
(5, 'wsws', NULL, 10, 1),
(6, 'qqqqqq', 1, 11, 1),
(7, 'qayqay', NULL, 12, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `idTicket` int(11) NOT NULL AUTO_INCREMENT,
  `Color` varchar(45) DEFAULT NULL,
  `Value` varchar(45) DEFAULT NULL,
  `SpielerID` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTicket`),
  KEY `fk_Ticket_tableSpieler1_idx` (`SpielerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Daten für Tabelle `ticket`
--

INSERT INTO `ticket` (`idTicket`, `Color`, `Value`, `SpielerID`) VALUES
(17, 'gruen', '222', 5),
(18, 'blau', '0', 5),
(19, 'rot', '0', 5),
(20, 'schwarz', '1', 5),
(21, 'gruen', '1', 7),
(22, 'blau', '3', 7),
(23, 'rot', '2', 7),
(24, 'schwarz', '1', 7),
(25, 'gruen', '1', 6),
(26, 'blau', '1', 6),
(27, 'rot', '2', 6),
(28, 'schwarz', '1', 6),
(29, 'gruen', '2', 6),
(30, 'blau', '1', 6),
(31, 'rot', '2', 6),
(32, 'schwarz', '1', 6);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `neighbors`
--
ALTER TABLE `neighbors`
  ADD CONSTRAINT `fk_Neighbors_Coord1` FOREIGN KEY (`coordID`) REFERENCES `coord` (`coordID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tablespieler`
--
ALTER TABLE `tablespieler`
  ADD CONSTRAINT `fk_tableSpieler_alleUser1` FOREIGN KEY (`UserID`) REFERENCES `alleuser` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tableSpieler_Coord1` FOREIGN KEY (`coordID`) REFERENCES `coord` (`coordID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_Ticket_tableSpieler1` FOREIGN KEY (`SpielerID`) REFERENCES `tablespieler` (`SpielerID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
