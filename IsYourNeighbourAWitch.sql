-- MySQL dump 10.13  Distrib 8.0.21, for osx10.15 (x86_64)
--
-- Host: localhost    Database: witch
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `score` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `response_question_id_fk` (`question_id`),
  CONSTRAINT `response_question_id_fk` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
INSERT INTO `answer` VALUES (1,'Yes, I\'ve seen the suspect boil newts !',1,100),(2,'Yes, I saw the suspect fly over me last night on a broomstick !',1,100),(3,'No, but this person annoy me.',1,5),(4,'Not really, but this person annoy me.',1,20),(5,'Yes, a scary black one !',2,30),(6,'Yes, a lovelly fluffy littlewhite cat.',2,5),(7,'No, no cats nor any other weird satanic animals.',2,-5),(8,'No, but the suspect has a domesticated toad !',2,60),(9,'No, I didn\'t see any.',2,-10),(10,'No, I didn\'t see any.',3,-10),(11,'1 to 3',3,10),(12,'3 to 5',3,30),(13,'So many I couldn\'t count !',3,50),(14,'Yes.',4,20),(15,'Not really, but this person don\'t maintain the lawn in a proper way.',4,10),(16,'No.',4,-5),(17,'Pretty good hygiene',5,20),(18,'Average to bad hygiene',5,-5),(19,'Terrible hygiene',5,20),(20,'Yes ! Witch !!',6,20),(21,'I don\'t know, I can\'t read..but surely yes ! Witch !!',6,30),(22,'No, I don\'t think so..',6,-10),(23,'The suspect cured someone with a potion !',7,100),(24,'The suspect is always sweet and kind ! It\'s Weird ! Witch !!',7,100),(25,'The suspect often wear black outfits !',7,50),(26,'I saw the suspect walk on water !',7,-100),(27,'The suspect never say hello !(me neither, but that\'s not the point)',7,20);
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bounty`
--

DROP TABLE IF EXISTS `bounty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bounty` (
  `inquisitor_id` int NOT NULL,
  `witch_id` int NOT NULL,
  `has_voted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`inquisitor_id`,`witch_id`),
  KEY `bounty_inquisitor_id_fk` (`inquisitor_id`),
  KEY `bounty_witch_id_fk` (`witch_id`),
  CONSTRAINT `bounty_inquisitor_id_fk` FOREIGN KEY (`inquisitor_id`) REFERENCES `inquisitor` (`id`),
  CONSTRAINT `bounty_witch_id_fk` FOREIGN KEY (`witch_id`) REFERENCES `witch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bounty`
--

LOCK TABLES `bounty` WRITE;
/*!40000 ALTER TABLE `bounty` DISABLE KEYS */;
/*!40000 ALTER TABLE `bounty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquisitor`
--

DROP TABLE IF EXISTS `inquisitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inquisitor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `registrationNumber` int NOT NULL,
  `password` varchar(260) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inquisitor_registrationNumber_uindex` (`registrationNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquisitor`
--

LOCK TABLES `inquisitor` WRITE;
/*!40000 ALTER TABLE `inquisitor` DISABLE KEYS */;
INSERT INTO `inquisitor` VALUES (1,'Perlinpinpin',12345678,'$2y$10$uNkt5IsZsoYvxO8h/pCyEu58.7brE/pZL5Sfmmi/OSluuzotnwtBC'),(3,'Perlinpinpin',12345679,'$2y$10$SmYBqhUKG2M0foP9CPsJ.eIs1D7woYUXdFI6r5cLmTflVWkxgTzle'),(4,'Perlinpinpin',12345674,'$2y$10$rlHTlqIStAyNC6IbUE/1r.yk1LpvaGOxWbtwczkJT138eLLykqL.a'),(5,'Jeanne',89562314,'$2y$10$JgZoKaIsJLdExArcHR5JL.py5npxftcwL2jYVatKYrbgb/sNgjfsm');
/*!40000 ALTER TABLE `inquisitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'Did you see the suspect practice witchcraft ?'),(2,'Does the suspect have a cat ?'),(3,'Does the suspect have warts on the face ?'),(4,'Does the suspect live alone in the forest ?'),(5,'Does the suspect have questionable hygiene ?'),(6,'Does the suspect know how to read ?'),(7,'Anything else ?');
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `witch`
--

DROP TABLE IF EXISTS `witch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `witch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `credibility` int DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `flame_count` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `witch`
--

LOCK TABLES `witch` WRITE;
/*!40000 ALTER TABLE `witch` DISABLE KEYS */;
INSERT INTO `witch` VALUES (1,'https://i.ytimg.com/vi/9nlhmJF5FNI/maxresdefault.jpg','Paris','The Parisian Witch',100,'2020-11-19 19:35:27',NULL),(2,'https://pyxis.nymag.com/v1/imgs/2fd/a32/583539cc06ab31db9ebb0a0e7c52e10f5b-31-witch-ranking.rsocial.w1200.jpg','Hambourg Avenue','Ugly Betty',100,'2020-11-19 19:35:36',NULL),(3,'https://pyxis.nymag.com/v1/imgs/2fd/a32/583539cc06ab31db9ebb0a0e7c52e10f5b-31-witch-ranking.rsocial.w1200.jpg','In the woods, the 3rd tree on the left','Capricorne',0,'2020-11-19 23:17:37',0),(4,'https://images.ladbible.com/resize?type=jpeg&url=http://beta.ems.ladbiblegroup.com/s3/content/58a913b25db91908175584aab917e93b.png&quality=70&width=720&aspectratio=16:9&extend=white','Above the sky','Too Late',60,'2020-11-20 01:43:20',4);
/*!40000 ALTER TABLE `witch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `witch_answer`
--

DROP TABLE IF EXISTS `witch_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `witch_answer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `witch_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `table_name_question_id_fk` (`question_id`),
  KEY `table_name_witch_id_fk` (`witch_id`),
  CONSTRAINT `table_name_question_id_fk` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  CONSTRAINT `table_name_witch_id_fk` FOREIGN KEY (`witch_id`) REFERENCES `witch` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `witch_answer`
--

LOCK TABLES `witch_answer` WRITE;
/*!40000 ALTER TABLE `witch_answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `witch_answer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-20 11:22:54
