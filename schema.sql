-- --------------------------------------------------------
-- Host:                         91.208.99.2
-- Server version:               5.6.14-56 - Percona Server (GPL), Release rel62.0, Revision 483
-- Server OS:                    Linux
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table classinfo
CREATE TABLE IF NOT EXISTS `classinfo` (
  `id` int(10) NOT NULL DEFAULT '0',
  `Paladin` tinyint(2) NOT NULL DEFAULT '0',
  `Warrior` tinyint(2) NOT NULL DEFAULT '0',
  `Dark Knight` tinyint(2) NOT NULL DEFAULT '0',
  `Monk` tinyint(2) NOT NULL DEFAULT '0',
  `Dragoon` tinyint(2) NOT NULL DEFAULT '0',
  `Ninja` tinyint(4) NOT NULL DEFAULT '0',
  `Samurai` tinyint(2) NOT NULL DEFAULT '0',
  `White Mage` tinyint(2) NOT NULL DEFAULT '0',
  `Scholar` tinyint(2) NOT NULL DEFAULT '0',
  `Astrologian` tinyint(2) NOT NULL DEFAULT '0',
  `Bard` tinyint(2) NOT NULL DEFAULT '0',
  `Machinist` tinyint(2) NOT NULL DEFAULT '0',
  `Black Mage` tinyint(2) NOT NULL DEFAULT '0',
  `Summoner` tinyint(2) NOT NULL DEFAULT '0',
  `Red Mage` tinyint(2) NOT NULL DEFAULT '0',
  `Carpenter` tinyint(2) NOT NULL DEFAULT '0',
  `Blacksmith` tinyint(2) NOT NULL DEFAULT '0',
  `Armorer` tinyint(2) NOT NULL DEFAULT '0',
  `Goldsmith` tinyint(2) NOT NULL DEFAULT '0',
  `Leatherworker` tinyint(2) NOT NULL DEFAULT '0',
  `Weaver` tinyint(2) NOT NULL DEFAULT '0',
  `Alchemist` tinyint(2) NOT NULL DEFAULT '0',
  `Culinarian` tinyint(2) NOT NULL DEFAULT '0',
  `Miner` tinyint(2) NOT NULL DEFAULT '0',
  `Botanist` tinyint(2) NOT NULL DEFAULT '0',
  `Fisher` tinyint(2) NOT NULL DEFAULT '0',
  `Gladiator` tinyint(2) NOT NULL DEFAULT '0',
  `Pugilist` tinyint(2) NOT NULL DEFAULT '0',
  `Thaumaturge` tinyint(2) NOT NULL DEFAULT '0',
  `Arcanist` tinyint(2) NOT NULL DEFAULT '0',
  `Rogue` tinyint(2) NOT NULL DEFAULT '0',
  `Archer` tinyint(2) NOT NULL DEFAULT '0',
  `Lancer` tinyint(2) NOT NULL DEFAULT '0',
  `Marauder` tinyint(2) NOT NULL DEFAULT '0',
  `Conjurer` tinyint(2) NOT NULL DEFAULT '0'
); 
CREATE TABLE IF NOT EXISTS `characterinfo`(
  `id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `avatar_url` tinytext,
  `rank` tinytext,
  `rankicon_url` tinytext
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
