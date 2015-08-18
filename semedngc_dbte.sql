-- MySQL dump 10.14  Distrib 5.5.44-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: semedngc_dbte  User: semedngc_ussr    password: zG;cF304Cv92 
-- ------------------------------------------------------
-- Server version	5.5.44-MariaDB-log

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
-- Table structure for table `appointment`
--
DROP DATABASE IF EXISTS semedngc_dbte;

CREATE DATABASE IF NOT EXISTS semedngc_dbte;

USE semedngc_dbte;

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` int(11) DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `casenote`
--

DROP TABLE IF EXISTS `casenote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `casenote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `doctorid` int(11) DEFAULT NULL,
  `note` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `attachment` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `casenote`
--

LOCK TABLES `casenote` WRITE;
/*!40000 ALTER TABLE `casenote` DISABLE KEYS */;
/*!40000 ALTER TABLE `casenote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultant_user`
--

DROP TABLE IF EXISTS `consultant_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultant_user` (
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultant_user`
--

LOCK TABLES `consultant_user` WRITE;
/*!40000 ALTER TABLE `consultant_user` DISABLE KEYS */;
INSERT INTO `consultant_user` (`cid`, `userid`) VALUES (1,7),(2,8),(3,39),(4,42),(5,43);
/*!40000 ALTER TABLE `consultant_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hmo`
--

DROP TABLE IF EXISTS `hmo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hmo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `phoneno` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `mobile` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(256) COLLATE latin1_general_ci NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hmo`
--

LOCK TABLES `hmo` WRITE;
/*!40000 ALTER TABLE `hmo` DISABLE KEYS */;
INSERT INTO `hmo` (`id`, `name`, `phoneno`, `mobile`, `address`, `verified`) VALUES (2,'Hygeia Health Maint. Services Ltd','001','08088888','11A Idejo Street, Off Adeola Odeku Street,\nVictoria Island              ',0),(3,'Ariyo','08033251511','','Plot 2 Bolck Xvll oluyole IBadan',0),(4,'Arewa Health Maintenance Service','','','Kaduna                                                                                                                                                          ',0),(5,'Clearline Int&#039;l Ltd','','','Lagos              ',0),(6,'Complete Medicare Ltd','','','Abuja                            ',0),(7,'Expactcare Health Int&#039;l Ltd','','','PH              ',0),(8,'Health Care Security','','','Ibadan              ',0),(9,'Healthcare Int&amp;#039;l Ltd','','','Lagos                            ',0),(10,'Int&#039;l Health Management Services','','','Kaduna              ',0),(11,'Integrated Healthcare','','','Kano              ',0),(12,'Managed Healthcare Service','','','Lokoja              ',0),(13,'Markfema Nig. Ltd','','','Aba              ',0),(14,'Mediplan Healthcare Ltd','','','Owerri              ',0),(15,'Multishield Nig Ltd','','','Jos              ',0),(16,'Preciouse Healthcare Ltd','','','Abeokuta              ',0),(17,'Premier Medicaid','','','Sokoto              ',0),(18,'Premium Health Ltd','','','Kano              ',0),(19,'Prepaid Medicare Services Ltd','','','Bauchi              ',0),(20,'Princeton Health','','','Osogbo              ',0),(21,'Ronsberger Nig. Ltd','','','Abuja              ',0),(22,'Royal Health Maintenance Services Ltd','','','Asaba              ',0),(23,'Songhai Health Trust','','','Abuja              ',0),(24,'Total Health Trust Ltd','','','Lagos              ',0),(25,'Ultimate Health Management','','','Lagos              ',0),(26,'United Comprehensive Health Management','','','Abuja              ',0),(27,'United Healthcare Int&#039;l Ltd','','','Warri              ',0),(28,'Wetlands Health Service Ltd','','','Akure              ',0),(29,'Wise Health Ltd','','','Ilorin              ',0),(30,'Zenith Medicare Ltd','','','Lagos              ',0),(31,'Zuma Health Trust','','','Suleja              ',0),(32,'Maayoit Healthcare Ltd','','','Jos              ',0),(33,'Gigatime care','08033251511','08033251511','              Plot 2 Block XVIII oluyole estate IBADAN              ',0),(34,'kenny','08057111622','08057111622','      ibadan        ',0);
/*!40000 ALTER TABLE `hmo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hmo_user`
--

DROP TABLE IF EXISTS `hmo_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hmo_user` (
  `hmoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hmo_user`
--

LOCK TABLES `hmo_user` WRITE;
/*!40000 ALTER TABLE `hmo_user` DISABLE KEYS */;
INSERT INTO `hmo_user` (`hmoid`, `userid`) VALUES (2,6),(3,0),(4,10),(5,11),(6,12),(7,13),(8,14),(9,15),(10,16),(11,17),(12,18),(13,19),(14,20),(15,21),(16,22),(17,23),(18,24),(19,25),(20,26),(21,27),(22,28),(23,29),(24,30),(25,31),(26,32),(27,33),(28,34),(29,35),(30,36),(31,37),(32,38),(33,0),(34,41);
/*!40000 ALTER TABLE `hmo_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospitalno` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `qrcode` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `othernames` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `gender` varchar(6) COLLATE latin1_general_ci DEFAULT NULL,
  `phoneno` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `nhisno` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `hmono` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dob` date NOT NULL,
  `hmoid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `hospitalno`, `qrcode`, `surname`, `othernames`, `gender`, `phoneno`, `email`, `address`, `nhisno`, `hmono`, `dob`, `hmoid`) VALUES (1,'UCH-001','','Akinlabi','Olumide','Male','08034245625','','              ','NHIS-001','HMO-001','1979-06-20',2);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patientapproval`
--

DROP TABLE IF EXISTS `patientapproval`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patientapproval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `treatmentcycleid` int(11) NOT NULL,
  `authorisationcode` varchar(150) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patientapproval`
--

LOCK TABLES `patientapproval` WRITE;
/*!40000 ALTER TABLE `patientapproval` DISABLE KEYS */;
INSERT INTO `patientapproval` (`id`, `userid`, `treatmentcycleid`, `authorisationcode`, `date`) VALUES (1,1,1,'AUTH-6-6-2014-HMO01','2014-06-06'),(2,7,1,'','2014-07-03'),(3,1,3,'W54235','2014-07-03');
/*!40000 ALTER TABLE `patientapproval` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patientdiagnosis`
--

DROP TABLE IF EXISTS `patientdiagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patientdiagnosis` (
  `patientid` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `diagnosis` text COLLATE latin1_general_ci,
  `userid` int(11) DEFAULT NULL,
  `provider` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `treatmentcycle` int(11) DEFAULT NULL,
  `treatment` int(11) NOT NULL,
  `cost` double NOT NULL,
  `costinguserid` int(11) NOT NULL,
  `costingdate` date NOT NULL,
  `attachment` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patientdiagnosis`
--

LOCK TABLES `patientdiagnosis` WRITE;
/*!40000 ALTER TABLE `patientdiagnosis` DISABLE KEYS */;
INSERT INTO `patientdiagnosis` (`patientid`, `date`, `diagnosis`, `userid`, `provider`, `id`, `treatmentcycle`, `treatment`, `cost`, `costinguserid`, `costingdate`, `attachment`, `locked`) VALUES (1,'2014-06-06','Result shows conditional dmage to the spiral',44,0,1,1,1,3500,44,'2014-06-06','media/document/FPNNJZ97KWSRVLN3ATL2.png',1);
/*!40000 ALTER TABLE `patientdiagnosis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provider`
--

LOCK TABLES `provider` WRITE;
/*!40000 ALTER TABLE `provider` DISABLE KEYS */;
INSERT INTO `provider` (`id`, `name`) VALUES (1,'Bio Chem'),(2,'Gnynaecology'),(3,'Pathology'),(4,'Surgery'),(5,'Physiology'),(6,'Medicine'),(7,'Maternity'),(8,'Radiology'),(9,'Paediatrics'),(10,'Family Health'),(11,'Intensive'),(12,'Ophtamotology'),(13,'Blood Bank'),(14,'Emergency');
/*!40000 ALTER TABLE `provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `description`) VALUES (1,'login',''),(2,'admin',''),(3,'hmo',''),(4,'nhis',''),(5,'shc',''),(6,'shcuser',''),(7,'hmouser',''),(9,'consultant',''),(10,'technician','');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_users`
--

LOCK TABLES `roles_users` WRITE;
/*!40000 ALTER TABLE `roles_users` DISABLE KEYS */;
INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES (1,1),(1,2),(1,4),(2,1),(2,3),(3,1),(3,3),(4,1),(4,3),(5,1),(5,3),(6,1),(6,3),(7,1),(7,9),(8,1),(8,9),(9,1),(9,3),(10,1),(10,3),(11,1),(11,3),(12,1),(12,3),(13,1),(13,3),(14,1),(14,3),(15,1),(15,3),(16,1),(16,3),(17,1),(17,3),(18,1),(18,3),(19,1),(19,3),(20,1),(20,3),(21,1),(21,3),(22,1),(22,3),(23,1),(23,3),(24,1),(24,3),(25,1),(25,3),(26,1),(26,3),(27,1),(27,3),(28,1),(28,3),(29,1),(29,3),(30,1),(30,3),(31,1),(31,3),(32,1),(32,3),(33,1),(33,3),(34,1),(34,3),(35,1),(35,3),(36,1),(36,3),(37,1),(37,3),(38,1),(38,3),(39,1),(39,9),(40,1),(40,3),(41,1),(41,3),(42,1),(42,9),(43,1),(43,9),(44,1),(44,10);
/*!40000 ALTER TABLE `roles_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialist`
--

DROP TABLE IF EXISTS `specialist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `unit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialist`
--

LOCK TABLES `specialist` WRITE;
/*!40000 ALTER TABLE `specialist` DISABLE KEYS */;
INSERT INTO `specialist` (`id`, `names`, `unit`) VALUES (1,'Aderibigbe Moses Oriyomi',1),(2,'Tope Akin Alabi',0),(3,'I  Irabor',0),(4,'Akin M Ariyo',0),(5,'Kola Ol Ola',6);
/*!40000 ALTER TABLE `specialist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technician`
--

DROP TABLE IF EXISTS `technician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technician` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `unit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technician`
--

LOCK TABLES `technician` WRITE;
/*!40000 ALTER TABLE `technician` DISABLE KEYS */;
INSERT INTO `technician` (`id`, `names`, `unit`) VALUES (1,'Kunbi Alabi Tope',1);
/*!40000 ALTER TABLE `technician` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technician_user`
--

DROP TABLE IF EXISTS `technician_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `technician_user` (
  `cid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technician_user`
--

LOCK TABLES `technician_user` WRITE;
/*!40000 ALTER TABLE `technician_user` DISABLE KEYS */;
INSERT INTO `technician_user` (`cid`, `userid`) VALUES (1,44);
/*!40000 ALTER TABLE `technician_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treatment`
--

DROP TABLE IF EXISTS `treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` int(11) NOT NULL,
  `date` date NOT NULL,
  `treatment` text NOT NULL,
  `userid` int(11) NOT NULL,
  `treatmentcycle` int(11) NOT NULL,
  `provider` int(11) NOT NULL,
  `consultant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatment`
--

LOCK TABLES `treatment` WRITE;
/*!40000 ALTER TABLE `treatment` DISABLE KEYS */;
INSERT INTO `treatment` (`id`, `patientid`, `date`, `treatment`, `userid`, `treatmentcycle`, `provider`, `consultant`) VALUES (1,1,'2014-06-09','Xray of the spiral              ',7,1,1,1);
/*!40000 ALTER TABLE `treatment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treatmentcycle`
--

DROP TABLE IF EXISTS `treatmentcycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treatmentcycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patientid` int(11) DEFAULT NULL,
  `proposedstartdate` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `proposedenddate` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `userid` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `approvalid` int(11) DEFAULT NULL,
  `approvalstatus` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `refferedclinic` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `investigationform` text COLLATE latin1_general_ci,
  `drugform` text COLLATE latin1_general_ci,
  `elapsed` tinyint(1) NOT NULL DEFAULT '0',
  `patientcomplaints` text COLLATE latin1_general_ci NOT NULL,
  `complications` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `surgicaloperations` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `indicationforsurgery` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `conditionondischarge` text COLLATE latin1_general_ci NOT NULL,
  `nextappointment` date NOT NULL,
  `referringfrom` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `referringto` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `referringdoctor` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `clicnicinformation` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `formno` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `dateseen` date NOT NULL,
  `serviceprovider` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `presumptivediagnosis` text COLLATE latin1_general_ci NOT NULL,
  `actiontaken` text COLLATE latin1_general_ci NOT NULL,
  `indicationforsurgery2` varchar(250) COLLATE latin1_general_ci NOT NULL,
  `refertodoctor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatmentcycle`
--

LOCK TABLES `treatmentcycle` WRITE;
/*!40000 ALTER TABLE `treatmentcycle` DISABLE KEYS */;
INSERT INTO `treatmentcycle` (`id`, `patientid`, `proposedstartdate`, `proposedenddate`, `userid`, `approvalid`, `approvalstatus`, `refferedclinic`, `investigationform`, `drugform`, `elapsed`, `patientcomplaints`, `complications`, `surgicaloperations`, `indicationforsurgery`, `conditionondischarge`, `nextappointment`, `referringfrom`, `referringto`, `referringdoctor`, `clicnicinformation`, `formno`, `dateseen`, `serviceprovider`, `presumptivediagnosis`, `actiontaken`, `indicationforsurgery2`, `refertodoctor`) VALUES (1,1,'2014-06-07','2014-06-28','1',1,'Approved',NULL,'&lt;p&gt;chchxhcxcx&lt;/p&gt;\n&lt;p&gt;c&lt;/p&gt;\n&lt;p&gt;xc&lt;/p&gt;\n&lt;p&gt;xc&lt;/p&gt;\n&lt;p&gt;x&lt;/p&gt;\n&lt;p&gt;x&lt;/p&gt;\n&lt;p&gt;cvxcvxcxcxc&lt;/p&gt;','&lt;p&gt;cxhcxjcb xc,xcx&lt;/p&gt;\n&lt;p&gt;cxc&lt;/p&gt;\n&lt;p&gt;xcvx&lt;/p&gt;\n&lt;p&gt;vcx&lt;/p&gt;\n&lt;p&gt;vcxvxcvxcvxcv&lt;/p&gt;\n&lt;p&gt;xcvcxvfvfdvdfhvuigyfgef7govgd8sg 87yg ovdg9o9ovsd&lt;/p&gt;',1,'','dcsnbdhjsjfsfsd                            ','       dsfsdfdsfdfd                     ','Xray defective issue              ','        dfsdfdfsdfdffdfddfd                    ','2014-07-03','Medlab','1','Sola Akintunde','Xray defective issue      dcdfcdd                          ','24847286','2014-06-09','Chem Path','Xray defectivve issue    ','Immediate Xray dianalysis    ','fsdfdfdf                            ',1),(3,1,'2014-07-07','2014-07-28','1',NULL,'Approved',NULL,'Nil              ',NULL,1,'','','','Nothiung              ','','0000-00-00','GOPD','1','Dr James Brown',' None   ','95845053','0000-00-00','','','','',1);
/*!40000 ALTER TABLE `treatmentcycle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `middlename` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(70) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `logins` int(10) NOT NULL,
  `last_login` int(10) NOT NULL,
  `phoneno` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `status` enum('active','disabled') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `username`, `password`, `logins`, `last_login`, `phoneno`, `status`) VALUES (1,'Admin','','User','admin','admin','e7d9fe3c496a8bdfbe0d8dbfafa00d0b03beab3fd1b5d3c4a5',93,1439883535,'','active'),(6,'Test','User','Abayomi','hygeiahmo@hyperia.com','hygeiahmo@hyperia.com','2b3fad8c2e81e7b26cf5546afa9603b4e75ee2e52f9ea6a34e',29,1404433072,'001','active'),(7,'Aderibigbe','Moses','Oriyomi','yomiaderibigbe@gmail.com','yomiaderibigbe@gmail.com','f6bd3287e97c79929afe44e621d2cff2398e0a77b998c91bcf',14,1406110166,'','active'),(8,'Tope','Akin','Alabi','muyiwa@test.com','muyiwa@test.com','6667b8925742b5decefe8b340ad36e36c828226dd9e9b07fc1',1,1386347587,'','active'),(9,'Adeotun','Tunde','Ariyo','ademidotun@yahoo.co.uk','ademidotun@yahoo.co.uk','46e4f053d1fe6c1def8641125602f6ad3f26aa442a5006e5dd',0,0,'08033251511','disabled'),(10,'Sanni','','Bello','sb@yahoo.com','sb@yahoo.com','92a912e96fcb69686d30e87c3a7f7a310784f9708afe1d5bcf',1,1405951999,'','active'),(11,'Joe','','Sam','js@gmail.com','js@gmail.com','094243cb232232f8acd1a951ee62a88626f542d54e9f44558a',0,0,'','disabled'),(12,'Clara',' ','Jimoh','cj@yahoo.com','cj@yahoo.com','55c48943ecec380a473b5c0e8aa1d3aa0a4c048b31be03eb75',0,0,'','active'),(13,'Mark','','Chucks','mc@yahoo.com','mc@yahoo.com','88cdb7432f80ab142644753a48f39f6877a5d2c0e36e10b5ea',0,0,'','active'),(14,'Lola','','Adewale','la@cloud.com','la@cloud.com','4c71787ae2a30156e00d5ac4c22f8546d9b1f2a33c9df47444',0,0,'','active'),(15,'Mary','','Lawal','ml@yahoo.com','ml@yahoo.com','ac4c81cac6c4532fbff579a2d8d69943dd9706c76fc6e68ddd',0,0,'','active'),(16,'Mariam','','Ibrahim','mi@gmail.com','mi@gmail.com','f72a4fd2dcd8ed76f17e836382a2f2d4ab8dc5ef04d2e00dd1',0,0,'','active'),(17,'Mohammed','','Ilau','mll@gmail.com','mll@gmail.com','229d9cbb3b2ca4543f62bdb8bac74bbf5df320f487b8ea6f49',0,0,'','disabled'),(18,'Mako','','Bako','mb@hotmail.com','mb@hotmail.com','6528bdc16e87c8726a958e1fc3c29e55175259be01187b2edf',0,0,'','active'),(19,'Eze','','Nwachukwu','en@hotmail.com','en@hotmail.com','6b57fe8f299a086a075457d7766d6d84f7f461cecc71db7962',0,0,'','active'),(20,'Bonny','','Ifeojuna','bi@yahoo.com','bi@yahoo.com','603f76ca0b171bbc64ea2cd37c7d24f059d3e454470f885b74',0,0,'','disabled'),(21,'Adamu','','Habila','ah@gmail.com','ah@gmail.com','00ef843fd38c17d45225e707da8333ff29a9b67c6cd41cdeb7',0,0,'','active'),(22,'Wale','','Adeniyi','wa@yahoo.co.uk','wa@yahoo.co.uk','b1737b4e951041ca539ff63e795a4a9eade6f4c512e9fcc621',0,0,'','active'),(23,'Jamto','','Janub','jj@yahoo.com','jj@yahoo.com','d26c84e517f95ba9b28218bb54f22d310a8897cff0eb6ab391',0,0,'','disabled'),(24,'Amina','','Bature','ab@gmail.com','ab@gmail.com','d2d3cfef7ad8fdca02e3e04f6c2b44120e58f57c3cec2f0c34',0,0,'','disabled'),(25,'Kate','','Malami','km@yahoo.com','km@yahoo.com','a555c1becdda4514e9df53dc0b8cfc64b37b2d9858d63a0683',0,0,'','active'),(26,'Mama','','Papa','mp@gmail.com','mp@gmail.com','4fc14ee603d816a1709e4455fe90ddd7119f7d09bbd5c62e88',0,0,'','disabled'),(27,'Hajia','','Lamina','hl@hotmail.com','hl@hotmail.com','810352ed03c0fdbd651c94cbab09ccc391d034cfb9d8d73af1',0,0,'','disabled'),(28,'Kwadu','','Williams','kw@hotmail.com','kw@hotmail.com','726d68d91df9ad810c0cd08928a8eafbd4538c55940e867892',0,0,'','active'),(29,'Jamil','','Wakum','jw@aol.com','jw@aol.com','c4ed656d78983b2e8690dd54646920844327fc13652fa54705',0,0,'','disabled'),(30,'Baba','','Akindele','ba@aol.com','ba@aol.com','8aa041b923e1cc4959f45bb9beb148c3286bd023376774b815',0,0,'','active'),(31,'Suzie','','Nkem','sk@hotmail.com','sk@hotmail.com','08c30d412bdbc0754e442189a29e6c94b21a9c88ff18bceeeb',0,0,'','disabled'),(32,'Tony','','Bofa','tb@yahoo.com','tb@yahoo.com','5fa0065d07d5ba21e276437639734c4f1e4d25613b72866887',0,0,'','disabled'),(33,'Jeniffer','','Gham','jg@mail.com','jg@mail.com','a99a1fe0b88085434c7db979b1719eaed5f870185f6a67e18f',0,0,'','disabled'),(34,'Tunde','','Cole','tc@mail.com','tc@mail.com','f6787330b8c92d7bf048ef09750bc31c95798eccb98c4ecfbc',0,0,'','disabled'),(35,'Afaa','','Olajimi','ao@yahoo.com','ao@yahoo.com','ec713e25e113a824c1273ad4dd81b1175dc80703410223a819',0,0,'','disabled'),(36,'Martha','','Ajim','ma@gmail.com','ma@gmail.com','4653172eab53cccf304731dc1902bd7b20fc4d4b480635b2b7',0,0,'','disabled'),(37,'Bayero','','Lamidi','bl@yahoo.co.uk','bl@yahoo.co.uk','ea223a4941fba16d59085e44ab1cb65c55cdd871a8fe3ff28a',0,0,'','disabled'),(38,'Blessing','','Maruwa','bm@cloud.com','bm@cloud.com','28d65af5a053ce815c429ef8c3d75920a57d33ceddf30ced6d',0,0,'','disabled'),(39,'I','','Irabor','ii@gmail.com','ii@gmail.com','a43f86b3bdfd42dcf04e1b0ba8a0697321eb84b0883f0ebb60',0,0,'','active'),(40,'Adeotun','C','Ariyo','dotun.ariyo@lifeforte.com','dotun.ariyo@lifeforte.com','55a4cd67439751a805899b1ddb2653f71a73e4149fe299f290',0,0,'08033251511','disabled'),(41,'kenny','samuel','sola','logokenny628@gmail.com','logokenny628@gmail.com','cacca338f93804cd52af05ee3d7519440644ac2cb8ad689c8c',1,1391612674,'08057111622','active'),(42,'Akin','M','Ariyo','ariyo','ariyo','214d1990861653b98a1ce2449d45f2614c1ae177295c1ca3c8',2,1392631783,'','active'),(43,'Kola','Ol','Ola','kola@gmail.com','kola@gmail.com','420e3e37f3cef49a3280f80b288b7c855893801561e7a437b8',0,0,'','active'),(44,'Kunbi','Alabi','Tope','kunbi','kunbi','c2fdb1ab4130f6bf11b0b6882a60701107cbc8d137ed1504b6',1,1402038070,'','active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'semedngc_dbte'
--

--
-- Dumping routines for database 'semedngc_dbte'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-18 11:06:51
