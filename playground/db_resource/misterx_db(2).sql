-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Mrz 2013 um 10:13
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Daten für Tabelle `alleuser`
--

INSERT INTO `alleuser` (`UserID`, `Name`, `Vorname`, `Email`, `Passwort`) VALUES
(1, 'alex', 'test_test', 'alex_test@mail.com', '1c115776ec3071438831f26f472fbfbc'),


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
(1, 100, 100, 1, 1),
(2, 300, 100, NULL, NULL),
(3, 500, 100, NULL, NULL),
(4, 200, 300, NULL, NULL),
(5, 400, 300, NULL, NULL),
(6, 600, 300, NULL, NULL),
(7, 100, 500, NULL, NULL),
(8, 300, 500, NULL, NULL),
(9, 500, 500, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `neighbors`
--

INSERT INTO `neighbors` (`NeighborID`, `rot`, `gruen`, `blau`, `CoordID_Neighbor`, `coordID`) VALUES
(1, 1, NULL, NULL, 2, 1),
(2, 1, NULL, NULL, 4, 1),
(3, NULL, NULL, 1, 7, 1),
(5, NULL, NULL, NULL, 4, 2),
(6, NULL, NULL, NULL, 5, 2),
(7, NULL, NULL, NULL, 2, 3),
(8, NULL, NULL, NULL, 6, 3),
(9, NULL, NULL, NULL, 7, 4),
(10, NULL, NULL, NULL, 3, 5),
(11, NULL, NULL, NULL, 6, 5),
(12, NULL, NULL, NULL, 1, 5),
(13, NULL, NULL, NULL, 1, 6),
(14, NULL, NULL, NULL, 9, 6),
(15, NULL, NULL, NULL, 8, 3),
(16, NULL, NULL, NULL, 6, 7),
(17, NULL, NULL, NULL, 8, 7),
(18, NULL, NULL, NULL, 4, 8),
(19, NULL, NULL, NULL, 5, 8),
(20, NULL, NULL, NULL, 4, 9),
(21, NULL, NULL, NULL, 5, 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tablespieler`
--

CREATE TABLE IF NOT EXISTS `tablespieler` (
  `SpielerID` int(11) NOT NULL AUTO_INCREMENT,
  `Beschreibung` varchar(45) DEFAULT NULL,
  `MisterX` int(11) DEFAULT NULL,
  `Detectiv` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `coordID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SpielerID`),
  KEY `fk_tableSpieler_alleUser1_idx` (`UserID`),
  KEY `fk_tableSpieler_Coord1_idx` (`coordID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `tablespieler`
--

INSERT INTO `tablespieler` (`SpielerID`, `Beschreibung`, `MisterX`, `Detectiv`, `UserID`, `coordID`) VALUES
(1, 'rrrrr', NULL, NULL, 1, NULL),


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Daten für Tabelle `ticket`
--

INSERT INTO `ticket` (`idTicket`, `Color`, `Value`, `SpielerID`) VALUES
(1, 'gruen', '2', 1),
(2, 'blau', '1', 1),
(3, 'rot', '0', 1),
(4, 'schwarz', '1', 1);

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
