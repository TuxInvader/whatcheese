-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: whatcheese
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `beer`
--

DROP TABLE IF EXISTS `beer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY(`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beer`
--

LOCK TABLES `beer` WRITE;
/*!40000 ALTER TABLE `beer` DISABLE KEYS */;
INSERT INTO `beer` VALUES (1,'Ghost Ship','England','Adnams is a regional brewery founded in 1872 in Southwold, Suffolk, England, by George and Ernest Adnams. It produces cask ale and pasteurised bottled beers. Annual production is around 85,000 barrels.');
INSERT INTO `beer` VALUES (2,'Abbot Ale','England','Greene King is the UK\'s largest pub retailer and brewer.[2] It is based in Bury St Edmunds, Suffolk, England. The company owns pubs, restaurants and hotels. It was listed on the London Stock Exchange until it was acquired by CK Assets in October 2019.');
/*!40000 ALTER TABLE `beer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cheese`
--

DROP TABLE IF EXISTS `cheese`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cheese` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY(`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cheese`
--

LOCK TABLES `cheese` WRITE;
/*!40000 ALTER TABLE `cheese` DISABLE KEYS */;
INSERT INTO `cheese` VALUES (1,'Cheddar','England','Cheddar cheese is a relatively hard, off-white (or orange if colourings such as annatto are added), sometimes sharp-tasting, natural cheese. Originating in the English village of Cheddar in Somerset');
INSERT INTO `cheese` VALUES (2,'Gouda','Netherlands','Gouda is a mild-flavored, yellow cow\'s milk cheese originating from the Netherlands.');
/*!40000 ALTER TABLE `cheese` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pickle`
--

DROP TABLE IF EXISTS `pickle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pickle` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY(`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pickle`
--

LOCK TABLES `pickle` WRITE;
/*!40000 ALTER TABLE `pickle` DISABLE KEYS */;
INSERT INTO `pickle` VALUES (1,'Branston','England','Branston is a British food brand best known for the original Branston Pickle, a jarred pickled chutney first made in 1922 in the village of Branston near Burton upon Trent, Staffordshire by Crosse & Blackwell');
/*!40000 ALTER TABLE `pickle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wine`
--

DROP TABLE IF EXISTS `wine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wine` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY(`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wine`
--

LOCK TABLES `wine` WRITE;
/*!40000 ALTER TABLE `wine` DISABLE KEYS */;
INSERT INTO `wine` VALUES (1,'Merlot','France','The earliest recorded mention of Merlot (under the synonym of Merlau) was in the notes of a local Bordeaux official who in 1784 labeled wine made from the grape in the Libournais region as one of the area\'s best.');
/*!40000 ALTER TABLE `wine` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-28 17:39:06

