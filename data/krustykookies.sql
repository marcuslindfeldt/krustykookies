-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: krusty
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blocked`
--

DROP TABLE IF EXISTS `blocked`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocked` (
  `block_id` smallint(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `cookie` varchar(64) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`block_id`),
  UNIQUE KEY `cookie` (`cookie`,`start`,`end`),
  CONSTRAINT `blocked_ibfk_1` FOREIGN KEY (`cookie`) REFERENCES `cookies` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocked`
--

LOCK TABLES `blocked` WRITE;
/*!40000 ALTER TABLE `blocked` DISABLE KEYS */;
INSERT INTO `blocked` VALUES (00001,'Nut cookie','2013-04-02','2013-04-06');
/*!40000 ALTER TABLE `blocked` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cookies`
--

DROP TABLE IF EXISTS `cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cookies` (
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cookies`
--

LOCK TABLES `cookies` WRITE;
/*!40000 ALTER TABLE `cookies` DISABLE KEYS */;
INSERT INTO `cookies` VALUES ('Almond delight','Simply delightful'),('Amneris','To good to resist'),('Berliner','Jawohl'),('Nut cookie','Mmm, nutty'),('Nut ring',''),('Tango','Let\'s tango');
/*!40000 ALTER TABLE `cookies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer` varchar(128) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES ('Bjudkakor AB','Ystad'),('Finkakor AB','Helsingborg'),('Gästkakor AB','Hässleholm'),('Kaffebröd AB','Landskrona'),('Kalaskakor AB','Trelleborg'),('Partykakor AB','Kristianstad'),('Skånekakor AB','Perstorp'),('Småbröd AB','Malmö');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `ingredient` varchar(64) NOT NULL DEFAULT '',
  `quantity` bigint(20) unsigned NOT NULL,
  `description` varchar(255) DEFAULT '',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latest_withdrawal` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES ('Bread crumbs',10000,'','2013-04-05 17:52:46',0),('Butter',10000,'','2013-04-05 17:52:46',0),('Chocolate',10000,'','2013-04-05 17:52:46',0),('Chopped almonds',10000,'','2013-04-05 17:52:46',0),('Cinnamon',10000,'','2013-04-05 17:52:46',0),('Egg whites',10000,'','2013-04-05 17:52:46',0),('Eggs',10000,'','2013-04-05 17:52:46',0),('Fine-ground nuts',10000,'','2013-04-05 17:52:46',0),('Flour',10000,'','2013-04-05 17:52:46',0),('Ground, roasted nuts',10000,'','2013-04-05 17:52:46',0),('Icing sugar',10000,'','2013-04-05 17:52:46',0),('Marzipan',10000,'','2013-04-05 17:52:46',0),('Potato starch',10000,'','2013-04-05 17:52:46',0),('Roasted, chopped nuts',10000,'','2013-04-05 17:52:46',0),('Sodium bicarbonate',10000,'','2013-04-05 17:52:46',0),('Sugar',10000,'','2013-04-05 17:52:46',0),('Vanilla',10000,'','2013-04-05 17:52:46',0),('Vanilla sugar',10000,'','2013-04-05 17:52:46',0),('Wheat flour',10000,'','2013-04-05 17:52:46',0);
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordered_pallets`
--

DROP TABLE IF EXISTS `ordered_pallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordered_pallets` (
  `order_id` smallint(5) unsigned NOT NULL,
  `cookie` varchar(64) NOT NULL DEFAULT '',
  `quantity` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`,`cookie`,`quantity`),
  KEY `cookie` (`cookie`),
  CONSTRAINT `ordered_pallets_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `ordered_pallets_ibfk_2` FOREIGN KEY (`cookie`) REFERENCES `cookies` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordered_pallets`
--

LOCK TABLES `ordered_pallets` WRITE;
/*!40000 ALTER TABLE `ordered_pallets` DISABLE KEYS */;
INSERT INTO `ordered_pallets` VALUES (1,'Berliner',2),(1,'Nut cookie',7),(1,'Tango',4);
/*!40000 ALTER TABLE `ordered_pallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` smallint(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `customer` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `deadline` date NOT NULL,
  `delivered` date DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `customer` (`customer`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`customer`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (00001,'Finkakor AB','2013-04-05 19:52:46','2013-04-07',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produced_pallets`
--

DROP TABLE IF EXISTS `produced_pallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produced_pallets` (
  `pallet_id` smallint(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `order_id` smallint(5) unsigned DEFAULT NULL,
  `cookie` varchar(64) NOT NULL,
  `produced` datetime NOT NULL,
  PRIMARY KEY (`pallet_id`),
  KEY `order_id` (`order_id`),
  KEY `cookie` (`cookie`),
  CONSTRAINT `produced_pallets_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `produced_pallets_ibfk_2` FOREIGN KEY (`cookie`) REFERENCES `cookies` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produced_pallets`
--

LOCK TABLES `produced_pallets` WRITE;
/*!40000 ALTER TABLE `produced_pallets` DISABLE KEYS */;
INSERT INTO `produced_pallets` VALUES (00001,NULL,'Nut ring','2013-04-05 19:52:46'),(00002,NULL,'Nut ring','2013-04-01 19:52:46'),(00003,NULL,'Nut ring','2013-04-01 19:52:46'),(00004,NULL,'Nut ring','2013-04-05 19:52:46'),(00005,NULL,'Nut ring','2013-04-05 19:52:46'),(00006,NULL,'Nut cookie','2013-03-22 19:52:46'),(00007,NULL,'Nut cookie','2013-03-26 19:52:46'),(00008,NULL,'Nut cookie','2013-03-27 19:52:46'),(00009,NULL,'Nut cookie','2013-03-27 19:52:46'),(00010,NULL,'Nut cookie','2013-03-27 19:52:46'),(00011,NULL,'Nut cookie','2013-03-27 19:52:46'),(00012,NULL,'Nut cookie','2013-03-27 19:52:46'),(00013,NULL,'Nut cookie','2013-03-28 19:52:46'),(00014,NULL,'Nut cookie','2013-03-29 19:52:46'),(00015,NULL,'Nut cookie','2013-03-29 19:52:46'),(00016,NULL,'Nut cookie','2013-03-29 19:52:46'),(00017,NULL,'Nut cookie','2013-03-30 19:52:46'),(00018,NULL,'Nut cookie','2013-03-31 19:52:46'),(00019,NULL,'Nut cookie','2013-04-01 19:52:46'),(00020,NULL,'Nut cookie','2013-04-02 19:52:46'),(00021,NULL,'Nut cookie','2013-04-03 19:52:46'),(00022,NULL,'Nut cookie','2013-04-03 19:52:46'),(00023,NULL,'Nut cookie','2013-04-04 19:52:46'),(00024,NULL,'Nut cookie','2013-04-05 19:52:46'),(00025,NULL,'Nut cookie','2013-04-05 19:52:46'),(00026,NULL,'Amneris','2013-04-04 19:52:46'),(00027,NULL,'Amneris','2013-04-04 19:52:46'),(00028,NULL,'Amneris','2013-04-05 19:52:46'),(00029,NULL,'Tango','2013-04-02 19:52:46'),(00030,NULL,'Tango','2013-04-02 19:52:46'),(00031,NULL,'Tango','2013-04-04 19:52:46'),(00032,NULL,'Tango','2013-04-05 19:52:46'),(00033,NULL,'Tango','2013-04-05 19:52:46'),(00034,NULL,'Tango','2013-04-05 19:52:46'),(00035,NULL,'Tango','2013-04-05 19:52:46'),(00036,NULL,'Almond delight','2013-04-05 19:52:46'),(00037,NULL,'Almond delight','2013-04-05 19:52:46'),(00038,NULL,'Berliner','2013-03-29 19:52:46'),(00039,NULL,'Berliner','2013-04-01 19:52:46'),(00040,NULL,'Berliner','2013-04-01 19:52:46'),(00041,NULL,'Berliner','2013-04-01 19:52:46'),(00042,NULL,'Berliner','2013-04-04 19:52:46'),(00043,NULL,'Berliner','2013-04-04 19:52:46'),(00044,NULL,'Berliner','2013-04-04 19:52:46'),(00045,NULL,'Berliner','2013-04-05 19:52:46'),(00046,NULL,'Berliner','2013-04-05 19:52:46'),(00047,NULL,'Berliner','2013-04-05 19:52:46'),(00048,NULL,'Berliner','2013-04-05 19:52:46');
/*!40000 ALTER TABLE `produced_pallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipes` (
  `cookie` varchar(64) NOT NULL DEFAULT '',
  `ingredient` varchar(64) NOT NULL DEFAULT '',
  `quantity` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`cookie`,`ingredient`),
  KEY `ingredient` (`ingredient`),
  CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`cookie`) REFERENCES `cookies` (`name`),
  CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`ingredient`) REFERENCES `ingredients` (`ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES ('Almond delight','Butter',350),('Almond delight','Chopped almonds',279),('Almond delight','Cinnamon',10),('Almond delight','Flour',400),('Almond delight','Sugar',270),('Amneris','Butter',250),('Amneris','Eggs',250),('Amneris','Marzipan',750),('Amneris','Potato starch',25),('Amneris','Wheat flour',25),('Berliner','Butter',250),('Berliner','Chocolate',50),('Berliner','Eggs',50),('Berliner','Flour',350),('Berliner','Icing sugar',100),('Berliner','Vanilla sugar',5),('Nut cookie','Bread crumbs',125),('Nut cookie','Chocolate',50),('Nut cookie','Egg whites',1800),('Nut cookie','Fine-ground nuts',750),('Nut cookie','Ground, roasted nuts',625),('Nut cookie','Sugar',375),('Nut ring','Butter',450),('Nut ring','Flour',450),('Nut ring','Icing sugar',190),('Nut ring','Roasted, chopped nuts',225),('Tango','Butter',200),('Tango','Flour',300),('Tango','Sodium bicarbonate',4),('Tango','Sugar',250),('Tango','Vanilla',2);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-05 19:53:38
