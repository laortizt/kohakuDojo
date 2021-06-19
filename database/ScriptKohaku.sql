-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: dbkohaku
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `idAccount` int NOT NULL AUTO_INCREMENT,
  `accountCode` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `accountEmail` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `accountPassword` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `accountRole` int DEFAULT NULL,
  `accountState` int DEFAULT NULL,
  `accountDocumentType` int DEFAULT NULL,
  `accountDni` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accountFirstName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `accountLastName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `accountAddress` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accountPhone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accountGenre` int DEFAULT NULL,
  `accountMenkyo` int DEFAULT NULL,
  PRIMARY KEY (`idAccount`),
  UNIQUE KEY `idAccount_UNIQUE` (`idAccount`),
  UNIQUE KEY `accountCode_UNIQUE` (`accountCode`),
  KEY `FK_Account_Role_idx` (`accountRole`),
  KEY `FK_Account_TypeDocument_idx` (`accountDocumentType`),
  KEY `FK_Account_Genre_idx` (`accountGenre`),
  KEY `FK_Account_Menkyo_idx` (`accountMenkyo`),
  KEY `FK_Accout_State_idx` (`accountState`),
  CONSTRAINT `FK_Account_Genre` FOREIGN KEY (`accountGenre`) REFERENCES `genre` (`idGenre`),
  CONSTRAINT `FK_Account_Menkyo` FOREIGN KEY (`accountMenkyo`) REFERENCES `menkyo` (`idMenkyo`),
  CONSTRAINT `FK_Account_Role` FOREIGN KEY (`accountRole`) REFERENCES `role` (`idRole`),
  CONSTRAINT `FK_Account_TypeDocument` FOREIGN KEY (`accountDocumentType`) REFERENCES `documenttype` (`idDocumentType`),
  CONSTRAINT `FK_Accout_State` FOREIGN KEY (`accountState`) REFERENCES `accounts` (`idAccount`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'AC92847365921','adri26.ortiz@gmail.com','a3FBaTkrbUxmSWdWZEJiWS9kWmZCUT09',1,1,1,'1030583067','luz Adriana','Ortiz','Calle 45 # 52-33','3183524738',1,NULL),(6,'AC29862489112','simon@gmail.com','Z25NUmYxNXF0SHQ0Z01TaHF4RlJ0QT09',3,1,1,'1030582948','Simón','Blanco','Calle 65 # 23 sur','3186547328',2,NULL),(7,'AC79562062503','alejandroml@gmail.com','RnZuc01ZT0xHNUNRMSs2SGhZclpJdz09',3,1,1,'1030673563','Daniel Alejandro','Martinez Lopéz','Av el Dorado # 12 -43','3153523673',2,NULL),(8,'AC41692356024','juandg@gmail.com','dHVOUWtjWDQ5YXpmdmVSU1p1MndnQT09',2,1,2,'9011658965','Juan David','Alarcon Guzman','Cra 26 # 67 -97','3217645637',2,NULL),(9,'AC32361404645','mariapau@gmail.com','dHVOUWtjWDQ5YXpmdmVSU1p1MndnQT09',2,1,1,'1030765483','Maria Paula','Correa Florez','cra 67 # 43-56','3126756454',1,NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `idAttendance` int NOT NULL AUTO_INCREMENT,
  `attendanceAccount` int DEFAULT NULL,
  `attendancePayment` int DEFAULT NULL,
  `attendanceClass` int DEFAULT NULL,
  PRIMARY KEY (`idAttendance`),
  KEY `FK_Attendance_Payments_idx` (`attendancePayment`),
  KEY `FK_Attendandance_Class_idx` (`attendanceClass`),
  CONSTRAINT `FK_Attendance_Account` FOREIGN KEY (`idAttendance`) REFERENCES `accounts` (`idAccount`),
  CONSTRAINT `FK_Attendance_Payments` FOREIGN KEY (`attendancePayment`) REFERENCES `payments` (`idPayments`),
  CONSTRAINT `FK_Attendandance_Class` FOREIGN KEY (`attendanceClass`) REFERENCES `class` (`idClass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class` (
  `idClass` int NOT NULL AUTO_INCREMENT,
  `classPrice` int NOT NULL,
  `classTeacher` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `classTopic` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `classEvents` int NOT NULL,
  `classDate` date NOT NULL,
  `classTimeInit` time NOT NULL,
  `classTimeEnd` time NOT NULL,
  PRIMARY KEY (`idClass`),
  KEY `FK_Class_Events_idx` (`classEvents`),
  KEY `FK_Class_Events_idx1` (`classPrice`),
  CONSTRAINT `FK_Class_Events` FOREIGN KEY (`classEvents`) REFERENCES `events` (`idEvents`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES (6,40000,'9','Armas',2,'2021-05-24','07:00:00','21:00:00'),(8,20000,'7','Taller Shuriken',1,'2021-06-08','10:00:00','11:00:00'),(9,20000,'7','Taller Shuriken 2',1,'2021-06-24','09:00:00','11:00:00');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documenttype`
--

DROP TABLE IF EXISTS `documenttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documenttype` (
  `idDocumentType` int NOT NULL,
  `nameDocumentType` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idDocumentType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documenttype`
--

LOCK TABLES `documenttype` WRITE;
/*!40000 ALTER TABLE `documenttype` DISABLE KEYS */;
INSERT INTO `documenttype` VALUES (1,'Cc'),(2,'Ti'),(3,'Ce'),(4,'Ps');
/*!40000 ALTER TABLE `documenttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `idEvents` int NOT NULL AUTO_INCREMENT,
  `eventsName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `eventsPrice` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idEvents`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Clase','20000'),(2,'Taller','40000'),(3,'Clase Gratis','0'),(4,'Taller Gratis','0');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre` (
  `idGenre` int NOT NULL AUTO_INCREMENT,
  `nameGenre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idGenre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Femenino'),(2,'Masculino'),(3,'Otro');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscription` (
  `idInscription` int NOT NULL AUTO_INCREMENT,
  `inscriptionUserId` int DEFAULT NULL,
  `inscriptionClass` int DEFAULT NULL,
  `inscriptionAssited` tinyint NOT NULL,
  PRIMARY KEY (`idInscription`),
  KEY `FK_Inscription_Accounts_idx` (`inscriptionUserId`),
  KEY `FK_Inscription_Class_idx` (`inscriptionClass`),
  CONSTRAINT `FK_Inscription_Accounts` FOREIGN KEY (`inscriptionUserId`) REFERENCES `accounts` (`idAccount`),
  CONSTRAINT `FK_Inscription_Class` FOREIGN KEY (`inscriptionClass`) REFERENCES `class` (`idClass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscription`
--

LOCK TABLES `inscription` WRITE;
/*!40000 ALTER TABLE `inscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menkyo`
--

DROP TABLE IF EXISTS `menkyo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menkyo` (
  `idMenkyo` int NOT NULL AUTO_INCREMENT,
  `menkyoName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idMenkyo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menkyo`
--

LOCK TABLES `menkyo` WRITE;
/*!40000 ALTER TABLE `menkyo` DISABLE KEYS */;
INSERT INTO `menkyo` VALUES (1,'10 kyu'),(2,'9 kyu'),(3,'8 kyu'),(4,'7 kyu'),(5,'6 kyu'),(6,'5 kyu'),(7,'4 kyu'),(8,'3 kyu'),(9,'2 kyu'),(10,'1 kyu '),(11,'Shodan');
/*!40000 ALTER TABLE `menkyo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `idPayments` int NOT NULL AUTO_INCREMENT,
  `paymentDate` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `paymentProcedure` int NOT NULL,
  `paymentPrice` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `paymentAccount` int NOT NULL,
  PRIMARY KEY (`idPayments`),
  KEY `FK_Payments_Procedure_idx` (`paymentProcedure`),
  KEY `FK_Payments_Account_idx` (`paymentAccount`),
  CONSTRAINT `FK_Payments_Account` FOREIGN KEY (`paymentAccount`) REFERENCES `accounts` (`idAccount`),
  CONSTRAINT `FK_Payments_Procedure` FOREIGN KEY (`paymentProcedure`) REFERENCES `procedures` (`idProcedures`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'2021-05-18',1,'100000',6),(6,'2021-05-18',6,'67000',6),(7,'2021-05-23',5,'100000',6),(15,'2021-05-23',7,'500000',7),(16,'2021-05-24',5,'100000',7),(17,'2021-05-24',3,'50000',7);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedures`
--

DROP TABLE IF EXISTS `procedures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procedures` (
  `idProcedures` int NOT NULL AUTO_INCREMENT,
  `procedureName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `procedurePrice` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idProcedures`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedures`
--

LOCK TABLES `procedures` WRITE;
/*!40000 ALTER TABLE `procedures` DISABLE KEYS */;
INSERT INTO `procedures` VALUES (1,'Menkyo','100000'),(2,'Certificado','335000'),(3,'Escudo Kyu','50000'),(4,'Escudo ShidoshiHo','67000'),(5,'Escudo Shidoshi','100000'),(6,'Membership','67000'),(7,'Shidoshi kay','500000'),(8,'1 Dan','335000'),(9,'2 Dan','700000'),(10,'3 Dan','1000000');
/*!40000 ALTER TABLE `procedures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progress` (
  `idProgress` int NOT NULL AUTO_INCREMENT,
  `progressDate` date NOT NULL,
  `progressDni` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `progressMenkyo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `progressObervation` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `progressState` tinyint NOT NULL,
  `progressAccount` int DEFAULT NULL,
  PRIMARY KEY (`idProgress`),
  KEY `FK_Progress_Accounts_idx` (`progressAccount`),
  CONSTRAINT `FK_Progress_Accounts` FOREIGN KEY (`progressAccount`) REFERENCES `accounts` (`idAccount`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role` (
  `idRole` int NOT NULL,
  `roleName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Administrador'),(2,'Instructor'),(3,'Usuario');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `state` (
  `idState` int NOT NULL,
  `stateName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idState`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,'Activo'),(2,'Inactivo'),(3,'Aprobado'),(4,'Reprobado'),(5,'Pendiente');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-19  1:26:15
