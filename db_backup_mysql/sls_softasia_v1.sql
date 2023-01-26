-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sls
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `sls_chapters`
--

DROP TABLE IF EXISTS `sls_chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_chapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `chapter_name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `chapter_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_chapters`
--

LOCK TABLES `sls_chapters` WRITE;
/*!40000 ALTER TABLE `sls_chapters` DISABLE KEYS */;
INSERT INTO `sls_chapters` VALUES (1,15,'Calcalus',1),(2,15,'Geometry',2),(3,15,'Matrices',3),(5,15,'Integration',4),(7,11,'Thermodynamics',1),(8,16,'Irreversible Reaction',1),(9,18,'Digestive Sytem',1),(10,19,'Aqwal e Zareen',1);
/*!40000 ALTER TABLE `sls_chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_classes`
--

DROP TABLE IF EXISTS `sls_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `c_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `c_section` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_classes`
--

LOCK TABLES `sls_classes` WRITE;
/*!40000 ALTER TABLE `sls_classes` DISABLE KEYS */;
INSERT INTO `sls_classes` VALUES (44,9,'9','A'),(45,9,'8','B'),(49,8,'Ten','Blue'),(50,11,'10th','A'),(51,8,'9TH','WHITE');
/*!40000 ALTER TABLE `sls_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_exams`
--

DROP TABLE IF EXISTS `sls_exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `exam_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_exams`
--

LOCK TABLES `sls_exams` WRITE;
/*!40000 ALTER TABLE `sls_exams` DISABLE KEYS */;
INSERT INTO `sls_exams` VALUES (43,1,1,'2009-01-23 02:40:32'),(44,1,3,'2009-01-23 02:40:50'),(45,1,3,'2009-01-23 02:40:53'),(46,1,1,'2009-01-23 02:52:52'),(47,1,3,'2009-01-23 02:53:03'),(48,1,1,'2009-01-23 02:53:14'),(49,1,3,'2009-01-23 02:53:31'),(50,1,3,'2009-01-23 02:53:34'),(51,1,10,'2010-01-23 06:18:26'),(52,1,10,'2010-01-23 06:18:34');
/*!40000 ALTER TABLE `sls_exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_questions`
--

DROP TABLE IF EXISTS `sls_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `option1` varchar(200) CHARACTER SET latin1 NOT NULL,
  `option2` varchar(200) CHARACTER SET latin1 NOT NULL,
  `option3` varchar(200) CHARACTER SET latin1 NOT NULL,
  `option4` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_questions`
--

LOCK TABLES `sls_questions` WRITE;
/*!40000 ALTER TABLE `sls_questions` DISABLE KEYS */;
INSERT INTO `sls_questions` VALUES (1,1,1,'What is x power 2 means? Where x = 2','4','6','5','8'),(5,3,1,'Matrix with all 0 entries called?','Null Matrix','Zero Matrix','Both above','None of these'),(10,1,1,'What is x power 2 means? Where x = 3','4','6','5','8'),(11,1,1,'What is x power 2 means? Where x = 4','4','6','5','8'),(12,10,1,'\"No one can undo Pakistan\" Who said this','Jinnah','Liaqat','Sir sayed','Iqbal'),(13,10,2,'\"Shair e Mashriq\" is title of:','Ghalib','Jalib','Iqbal','Mir'),(14,9,1,'How many bones in human body?','205','206','209','208'),(15,7,1,'How many laws of newton?','2','3','4','5'),(16,8,1,'Formula of Water?','H2O','H3O','2HO','H2O2');
/*!40000 ALTER TABLE `sls_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_quizes`
--

DROP TABLE IF EXISTS `sls_quizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_quizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_quizes`
--

LOCK TABLES `sls_quizes` WRITE;
/*!40000 ALTER TABLE `sls_quizes` DISABLE KEYS */;
/*!40000 ALTER TABLE `sls_quizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_results`
--

DROP TABLE IF EXISTS `sls_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_answer` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_results`
--

LOCK TABLES `sls_results` WRITE;
/*!40000 ALTER TABLE `sls_results` DISABLE KEYS */;
INSERT INTO `sls_results` VALUES (90,43,1,'c'),(91,43,10,'a'),(92,43,11,'b'),(93,44,5,'c'),(94,45,5,'d'),(95,46,1,'a'),(96,46,10,'a'),(97,46,11,'a'),(98,47,5,'b'),(99,48,1,'c'),(100,48,10,'b'),(101,48,11,'d'),(102,49,5,'c'),(103,50,5,'d'),(104,51,12,'a'),(105,51,13,'c'),(106,52,12,'c'),(107,52,13,'b');
/*!40000 ALTER TABLE `sls_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_schools`
--

DROP TABLE IF EXISTS `sls_schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_schools`
--

LOCK TABLES `sls_schools` WRITE;
/*!40000 ALTER TABLE `sls_schools` DISABLE KEYS */;
INSERT INTO `sls_schools` VALUES (8,'Karounta','karounta@gmail.com'),(9,'Sohawa','sohawa@gmail.com'),(11,'GGHS Pail Mirza','gghs@gmail.com');
/*!40000 ALTER TABLE `sls_schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_students`
--

DROP TABLE IF EXISTS `sls_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classID` int(11) NOT NULL,
  `s_name` varchar(200) CHARACTER SET latin1 NOT NULL,
  `s_email` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_students`
--

LOCK TABLES `sls_students` WRITE;
/*!40000 ALTER TABLE `sls_students` DISABLE KEYS */;
INSERT INTO `sls_students` VALUES (1,49,'Asjad Mehmood','asjad@gmail.com'),(3,49,'Nabeel Arshad','nabeel@gmail.com'),(8,44,'Ali','ali@gmail.com'),(9,45,'Aslam','aslam@gmail.com'),(10,50,'Maryiam','maryiam@gmail.com'),(11,49,'Aslam','a@b.com');
/*!40000 ALTER TABLE `sls_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_subjects`
--

DROP TABLE IF EXISTS `sls_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_name` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_subjects`
--

LOCK TABLES `sls_subjects` WRITE;
/*!40000 ALTER TABLE `sls_subjects` DISABLE KEYS */;
INSERT INTO `sls_subjects` VALUES (11,44,0,'Physics'),(15,49,4,'Mathematics'),(16,45,0,'Chemistry'),(18,50,0,'Biology'),(19,49,0,'Urdu'),(32,49,0,'subject'),(33,49,0,'subject');
/*!40000 ALTER TABLE `sls_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_teachers`
--

DROP TABLE IF EXISTS `sls_teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_teachers`
--

LOCK TABLES `sls_teachers` WRITE;
/*!40000 ALTER TABLE `sls_teachers` DISABLE KEYS */;
INSERT INTO `sls_teachers` VALUES (1,8,0,'M Aslam Khan'),(4,8,0,'Ali Murtaza'),(5,8,0,'Ali Murtaza');
/*!40000 ALTER TABLE `sls_teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_tests`
--

DROP TABLE IF EXISTS `sls_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_tests`
--

LOCK TABLES `sls_tests` WRITE;
/*!40000 ALTER TABLE `sls_tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `sls_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sls_users`
--

DROP TABLE IF EXISTS `sls_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sls_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) CHARACTER SET latin1 NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 NOT NULL,
  `firstname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `address` text CHARACTER SET latin1 NOT NULL,
  `contact_info` varchar(100) CHARACTER SET latin1 NOT NULL,
  `image` varchar(200) CHARACTER SET latin1 NOT NULL,
  `status` int(11) NOT NULL,
  `role` varchar(250) CHARACTER SET latin1 NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sls_users`
--

LOCK TABLES `sls_users` WRITE;
/*!40000 ALTER TABLE `sls_users` DISABLE KEYS */;
INSERT INTO `sls_users` VALUES (1,'hasni@gmail.com','$2y$10$3aJyg/MkL7dox3AozCaAKOrTxw7V78LmoF2.bfEaVBD61E1AoAdwK','Hassan','Shehzad','','','',0,'master_admin',0),(16,'hassan@gmail.com','$2y$10$HnNPhN0hgEmQNc6WA2rfkOM8Je.tx1FBRtdRSDyJ7SPL/aNLG6.Qi','hassan','shehzad','','','',0,'student',0),(21,'amdin@gmail.om','$2y$10$B33mCQ0/Was.yqrKi8LwT.n3Zh6ioS3OvFda222a2m8CwphpAC8NS','hello','there','','','',0,'principal',0),(23,'q@q.q','$2y$10$hYLspIJs1v8xnUSIpANEZOk/1.Ib8WzgYOjZ7IQ8okGetkeG2lWLS','fg','dfg','','','',0,'teacher',0),(25,'baig@gmail.com','$2y$10$GVsAceyBVSXsGQLYnRp8kuwkdb8/9KR3nbChJeJDJh6HnzEvX/fga','Aslam','Baig','','','',0,'parent',0);
/*!40000 ALTER TABLE `sls_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-13 17:37:49
