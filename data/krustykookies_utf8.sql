-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: puccini.cs.lth.se    Database: db65
-- ------------------------------------------------------
-- Server version	5.5.18
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocked`
--

LOCK TABLES `blocked` WRITE;
/*!40000 ALTER TABLE `blocked` DISABLE KEYS */;
INSERT INTO `blocked` VALUES (00002,'Almond delight','2013-04-08','2013-04-10');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cookies`
--

LOCK TABLES `cookies` WRITE;
/*!40000 ALTER TABLE `cookies` DISABLE KEYS */;
INSERT INTO `cookies` VALUES ('Almond delight','Simply delightful');
INSERT INTO `cookies` VALUES ('Amneris','To good to resist');
INSERT INTO `cookies` VALUES ('Berliner','Jawohl');
INSERT INTO `cookies` VALUES ('Nut cookie','Mmm, nutty');
INSERT INTO `cookies` VALUES ('Nut ring','');
INSERT INTO `cookies` VALUES ('Tango','Let\'s tango');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES ('Bjudkakor AB','Ystad');
INSERT INTO `customers` VALUES ('Finkakor AB','Helsingborg');
INSERT INTO `customers` VALUES ('Gästkakor AB','Hässleholm');
INSERT INTO `customers` VALUES ('Kaffebröd AB','Landskrona');
INSERT INTO `customers` VALUES ('Kalaskakor AB','Trelleborg');
INSERT INTO `customers` VALUES ('Partykakor AB','Kristianstad');
INSERT INTO `customers` VALUES ('Skånekakor AB','Perstorp');
INSERT INTO `customers` VALUES ('Småbröd AB','Malmö');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES ('Bread crumbs',10075,'','2013-04-05 23:40:11',125);
INSERT INTO `ingredients` VALUES ('Butter',5250,'','2013-04-05 23:40:23',450);
INSERT INTO `ingredients` VALUES ('Chocolate',9900,'','2013-04-05 23:40:11',50);
INSERT INTO `ingredients` VALUES ('Chopped almonds',8047,'','2013-04-05 22:35:48',837);
INSERT INTO `ingredients` VALUES ('Cinnamon',9930,'','2013-04-05 22:35:48',30);
INSERT INTO `ingredients` VALUES ('Egg whites',8200,'','2013-04-05 23:40:11',1800);
INSERT INTO `ingredients` VALUES ('Eggs',8450,'','2013-04-05 23:39:49',50);
INSERT INTO `ingredients` VALUES ('Fine-ground nuts',9250,'','2013-04-05 23:40:11',750);
INSERT INTO `ingredients` VALUES ('Flour',5500,'','2013-04-05 23:40:23',450);
INSERT INTO `ingredients` VALUES ('Ground, roasted nuts',9375,'','2013-04-05 23:40:11',625);
INSERT INTO `ingredients` VALUES ('Icing sugar',9710,'','2013-04-05 23:40:23',190);
INSERT INTO `ingredients` VALUES ('Marzipan',5500,'','2013-04-05 22:24:37',1500);
INSERT INTO `ingredients` VALUES ('Potato starch',9850,'','2013-04-05 22:24:37',50);
INSERT INTO `ingredients` VALUES ('Roasted, chopped nuts',9775,'','2013-04-05 23:40:23',225);
INSERT INTO `ingredients` VALUES ('Sodium bicarbonate',9988,'','2013-04-05 22:25:01',4);
INSERT INTO `ingredients` VALUES ('Sugar',6985,'','2013-04-05 23:40:11',375);
INSERT INTO `ingredients` VALUES ('Vanilla',9994,'','2013-04-05 22:25:01',2);
INSERT INTO `ingredients` VALUES ('Vanilla sugar',9995,'','2013-04-05 23:39:49',5);
INSERT INTO `ingredients` VALUES ('Wheat flour',9850,'','2013-04-05 22:24:37',50);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordered_pallets`
--

LOCK TABLES `ordered_pallets` WRITE;
/*!40000 ALTER TABLE `ordered_pallets` DISABLE KEYS */;
INSERT INTO `ordered_pallets` VALUES (2,'Almond delight',2);
INSERT INTO `ordered_pallets` VALUES (3,'Almond delight',12);
INSERT INTO `ordered_pallets` VALUES (4,'Almond delight',1);
INSERT INTO `ordered_pallets` VALUES (5,'Almond delight',2);
INSERT INTO `ordered_pallets` VALUES (1,'Berliner',2);
INSERT INTO `ordered_pallets` VALUES (1,'Nut cookie',7);
INSERT INTO `ordered_pallets` VALUES (2,'Nut cookie',14);
INSERT INTO `ordered_pallets` VALUES (2,'Nut ring',2);
INSERT INTO `ordered_pallets` VALUES (5,'Nut ring',4);
INSERT INTO `ordered_pallets` VALUES (1,'Tango',4);
INSERT INTO `ordered_pallets` VALUES (2,'Tango',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (00001,'Finkakor AB','2013-04-05 19:52:46','2013-04-07','2013-04-05');
INSERT INTO `orders` VALUES (00002,'Bjudkakor AB','2013-04-05 21:02:35','2013-04-09',NULL);
INSERT INTO `orders` VALUES (00003,'Bjudkakor AB','2013-04-05 21:15:17','2013-04-10',NULL);
INSERT INTO `orders` VALUES (00004,'Kalaskakor AB','2013-04-05 21:16:18','2013-04-16','2013-04-05');
INSERT INTO `orders` VALUES (00005,'Kaffebröd AB','2013-04-06 01:36:35','2013-04-07','2013-04-06');
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produced_pallets`
--

LOCK TABLES `produced_pallets` WRITE;
/*!40000 ALTER TABLE `produced_pallets` DISABLE KEYS */;
INSERT INTO `produced_pallets` VALUES (00001,5,'Nut ring','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00002,5,'Nut ring','2013-04-01 19:52:46');
INSERT INTO `produced_pallets` VALUES (00003,5,'Nut ring','2013-04-01 19:52:46');
INSERT INTO `produced_pallets` VALUES (00004,5,'Nut ring','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00005,NULL,'Nut ring','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00006,1,'Nut cookie','2013-03-22 19:52:46');
INSERT INTO `produced_pallets` VALUES (00007,1,'Nut cookie','2013-03-26 19:52:46');
INSERT INTO `produced_pallets` VALUES (00008,1,'Nut cookie','2013-03-27 19:52:46');
INSERT INTO `produced_pallets` VALUES (00009,1,'Nut cookie','2013-03-27 19:52:46');
INSERT INTO `produced_pallets` VALUES (00010,1,'Nut cookie','2013-03-27 19:52:46');
INSERT INTO `produced_pallets` VALUES (00011,1,'Nut cookie','2013-03-27 19:52:46');
INSERT INTO `produced_pallets` VALUES (00012,1,'Nut cookie','2013-03-27 19:52:46');
INSERT INTO `produced_pallets` VALUES (00013,NULL,'Nut cookie','2013-03-28 19:52:46');
INSERT INTO `produced_pallets` VALUES (00014,NULL,'Nut cookie','2013-03-29 19:52:46');
INSERT INTO `produced_pallets` VALUES (00015,NULL,'Nut cookie','2013-03-29 19:52:46');
INSERT INTO `produced_pallets` VALUES (00016,NULL,'Nut cookie','2013-03-29 19:52:46');
INSERT INTO `produced_pallets` VALUES (00017,NULL,'Nut cookie','2013-03-30 19:52:46');
INSERT INTO `produced_pallets` VALUES (00018,NULL,'Nut cookie','2013-03-31 19:52:46');
INSERT INTO `produced_pallets` VALUES (00019,NULL,'Nut cookie','2013-04-01 19:52:46');
INSERT INTO `produced_pallets` VALUES (00020,NULL,'Nut cookie','2013-04-02 19:52:46');
INSERT INTO `produced_pallets` VALUES (00021,NULL,'Nut cookie','2013-04-03 19:52:46');
INSERT INTO `produced_pallets` VALUES (00022,NULL,'Nut cookie','2013-04-03 19:52:46');
INSERT INTO `produced_pallets` VALUES (00023,NULL,'Nut cookie','2013-04-04 19:52:46');
INSERT INTO `produced_pallets` VALUES (00024,NULL,'Nut cookie','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00025,NULL,'Nut cookie','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00026,NULL,'Amneris','2013-04-04 19:52:46');
INSERT INTO `produced_pallets` VALUES (00027,NULL,'Amneris','2013-04-04 19:52:46');
INSERT INTO `produced_pallets` VALUES (00028,NULL,'Amneris','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00029,1,'Tango','2013-04-02 19:52:46');
INSERT INTO `produced_pallets` VALUES (00030,1,'Tango','2013-04-02 19:52:46');
INSERT INTO `produced_pallets` VALUES (00031,1,'Tango','2013-04-04 19:52:46');
INSERT INTO `produced_pallets` VALUES (00032,1,'Tango','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00033,NULL,'Tango','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00034,NULL,'Tango','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00035,NULL,'Tango','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00036,5,'Almond delight','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00037,5,'Almond delight','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00038,1,'Berliner','2013-03-29 19:52:46');
INSERT INTO `produced_pallets` VALUES (00039,1,'Berliner','2013-04-01 19:52:46');
INSERT INTO `produced_pallets` VALUES (00040,NULL,'Berliner','2013-04-01 19:52:46');
INSERT INTO `produced_pallets` VALUES (00041,NULL,'Berliner','2013-04-01 19:52:46');
INSERT INTO `produced_pallets` VALUES (00042,NULL,'Berliner','2013-04-04 19:52:46');
INSERT INTO `produced_pallets` VALUES (00043,NULL,'Berliner','2013-04-04 19:52:46');
INSERT INTO `produced_pallets` VALUES (00044,NULL,'Berliner','2013-04-04 19:52:46');
INSERT INTO `produced_pallets` VALUES (00045,NULL,'Berliner','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00046,NULL,'Berliner','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00047,NULL,'Berliner','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00048,NULL,'Berliner','2013-04-05 19:52:46');
INSERT INTO `produced_pallets` VALUES (00049,NULL,'Almond delight','2013-04-05 23:49:41');
INSERT INTO `produced_pallets` VALUES (00050,NULL,'Almond delight','2013-04-05 23:49:41');
INSERT INTO `produced_pallets` VALUES (00051,NULL,'Amneris','2013-04-06 00:13:21');
INSERT INTO `produced_pallets` VALUES (00052,NULL,'Amneris','2013-04-06 00:13:21');
INSERT INTO `produced_pallets` VALUES (00053,NULL,'Amneris','2013-04-06 00:23:19');
INSERT INTO `produced_pallets` VALUES (00054,NULL,'Amneris','2013-04-06 00:23:19');
INSERT INTO `produced_pallets` VALUES (00055,NULL,'Almond delight','2013-04-06 00:23:24');
INSERT INTO `produced_pallets` VALUES (00056,NULL,'Almond delight','2013-04-06 00:23:24');
INSERT INTO `produced_pallets` VALUES (00057,NULL,'Almond delight','2013-04-06 00:23:24');
INSERT INTO `produced_pallets` VALUES (00058,NULL,'Amneris','2013-04-06 00:24:37');
INSERT INTO `produced_pallets` VALUES (00059,NULL,'Amneris','2013-04-06 00:24:37');
INSERT INTO `produced_pallets` VALUES (00060,NULL,'Almond delight','2013-04-06 00:24:45');
INSERT INTO `produced_pallets` VALUES (00061,NULL,'Tango','2013-04-06 00:25:02');
INSERT INTO `produced_pallets` VALUES (00062,NULL,'Almond delight','2013-04-06 00:35:48');
INSERT INTO `produced_pallets` VALUES (00063,NULL,'Almond delight','2013-04-06 00:35:48');
INSERT INTO `produced_pallets` VALUES (00064,NULL,'Almond delight','2013-04-06 00:35:48');
INSERT INTO `produced_pallets` VALUES (00065,NULL,'Berliner','2013-04-06 01:39:50');
INSERT INTO `produced_pallets` VALUES (00066,NULL,'Nut cookie','2013-04-06 01:40:11');
INSERT INTO `produced_pallets` VALUES (00067,NULL,'Nut ring','2013-04-06 01:40:23');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES ('Almond delight','Butter',350);
INSERT INTO `recipes` VALUES ('Almond delight','Chopped almonds',279);
INSERT INTO `recipes` VALUES ('Almond delight','Cinnamon',10);
INSERT INTO `recipes` VALUES ('Almond delight','Flour',400);
INSERT INTO `recipes` VALUES ('Almond delight','Sugar',270);
INSERT INTO `recipes` VALUES ('Amneris','Butter',250);
INSERT INTO `recipes` VALUES ('Amneris','Eggs',250);
INSERT INTO `recipes` VALUES ('Amneris','Marzipan',750);
INSERT INTO `recipes` VALUES ('Amneris','Potato starch',25);
INSERT INTO `recipes` VALUES ('Amneris','Wheat flour',25);
INSERT INTO `recipes` VALUES ('Berliner','Butter',250);
INSERT INTO `recipes` VALUES ('Berliner','Chocolate',50);
INSERT INTO `recipes` VALUES ('Berliner','Eggs',50);
INSERT INTO `recipes` VALUES ('Berliner','Flour',350);
INSERT INTO `recipes` VALUES ('Berliner','Icing sugar',100);
INSERT INTO `recipes` VALUES ('Berliner','Vanilla sugar',5);
INSERT INTO `recipes` VALUES ('Nut cookie','Bread crumbs',125);
INSERT INTO `recipes` VALUES ('Nut cookie','Chocolate',50);
INSERT INTO `recipes` VALUES ('Nut cookie','Egg whites',1800);
INSERT INTO `recipes` VALUES ('Nut cookie','Fine-ground nuts',750);
INSERT INTO `recipes` VALUES ('Nut cookie','Ground, roasted nuts',625);
INSERT INTO `recipes` VALUES ('Nut cookie','Sugar',375);
INSERT INTO `recipes` VALUES ('Nut ring','Butter',450);
INSERT INTO `recipes` VALUES ('Nut ring','Flour',450);
INSERT INTO `recipes` VALUES ('Nut ring','Icing sugar',190);
INSERT INTO `recipes` VALUES ('Nut ring','Roasted, chopped nuts',225);
INSERT INTO `recipes` VALUES ('Tango','Butter',200);
INSERT INTO `recipes` VALUES ('Tango','Flour',300);
INSERT INTO `recipes` VALUES ('Tango','Sodium bicarbonate',4);
INSERT INTO `recipes` VALUES ('Tango','Sugar',250);
INSERT INTO `recipes` VALUES ('Tango','Vanilla',2);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-07 13:03:15
