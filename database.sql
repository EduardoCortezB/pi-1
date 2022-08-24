-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: a1
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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `idAddress` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `street` varchar(50) COLLATE utf8_bin NOT NULL,
  `colony` varchar(25) COLLATE utf8_bin NOT NULL,
  `number` varchar(5) COLLATE utf8_bin NOT NULL,
  `cpp` varchar(5) COLLATE utf8_bin NOT NULL,
  `address` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,1,'Lomasturbas','Siempregrande','007','007',''),(2,1,'','','','23','dw'),(3,1,'','','','88795','Fco. Marques 704'),(4,1,'','','','88795','Fco. Marques 704'),(5,2,'','','','88795','Fco. Marques 704'),(6,1,'','','','88795','Fco. Marques 704'),(7,1,'','','','88795','Fco. Marques 704'),(8,1,'','','','88795','Fco. Marques 704'),(9,1,'','','','23','nss'),(10,1,'','','','88795','Fco. Marques 704'),(11,1,'','','','88795','Fco. Marques 704'),(12,1,'','','','88795','Fco. Marques 704'),(13,1,'','','','88795','Fco. Marques 704'),(14,1,'','','','88795','Fco. Marques 704'),(15,1,'','','','88795','Fco. Marques 704'),(16,1,'','','','88795','Fco. Marques 704'),(17,1,'','','','88795','Fco. Marques 704'),(18,5,'','','','2345','nnbhbg');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id_Category` int(11) NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_Category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Donas'),(2,'Pasteles'),(3,'Cupcake'),(4,'Pays');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `normalorders`
--

DROP TABLE IF EXISTS `normalorders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `normalorders` (
  `idOrder` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idAddress` int(11) DEFAULT NULL,
  `idShipping` int(11) DEFAULT NULL,
  `statusNotify` tinyint(1) DEFAULT 1,
  `statusOrder` tinyint(1) DEFAULT 0,
  `dateShipping` date DEFAULT NULL,
  `dateDelivery` date DEFAULT NULL,
  `total` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `isOpenOrder` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idOrder`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `normalorders`
--

LOCK TABLES `normalorders` WRITE;
/*!40000 ALTER TABLE `normalorders` DISABLE KEYS */;
INSERT INTO `normalorders` VALUES (19,1,1,NULL,2,1,'2022-03-31','2022-04-08','150',0),(20,5,18,NULL,1,1,'2022-07-02','2022-07-09','1280',0);
/*!40000 ALTER TABLE `normalorders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `idCategory` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `image` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `priceUnit` int(11) NOT NULL,
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (67,1,'Test prueba producto 2','file-8jeljg.png','Descripcion test prueba producto 2',200),(68,2,'Prueba 1','file-eaa755g.png','Descripcion p',10);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `idRol` int(11) NOT NULL,
  `nameRole` varchar(20) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (3,'Usuario'),(4,'Administrador');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoppingcar`
--

DROP TABLE IF EXISTS `shoppingcar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shoppingcar` (
  `idProdShip` int(11) NOT NULL AUTO_INCREMENT,
  `totalUnit` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `idProduct` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `idOrder` int(11) NOT NULL,
  PRIMARY KEY (`idProdShip`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shoppingcar`
--

LOCK TABLES `shoppingcar` WRITE;
/*!40000 ALTER TABLE `shoppingcar` DISABLE KEYS */;
INSERT INTO `shoppingcar` VALUES (22,'150',65,1,19),(23,'200',67,6,20),(24,'10',68,8,20);
/*!40000 ALTER TABLE `shoppingcar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `lastName` varchar(10) COLLATE utf8_bin NOT NULL,
  `number` varchar(13) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(200) COLLATE utf8_bin NOT NULL,
  `idRol` int(11) DEFAULT 3,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Eduardo','Cortez','8991544118','eduardocortezzeus@gmail.com','3e3468ad4ba09ee51aa734161914e0d960d1ba9e2be7c1237d498f141285256c',4),(2,'Lalo','Version2','8991544118','lalo@gmail.com','3e3468ad4ba09ee51aa734161914e0d960d1ba9e2be7c1237d498f141285256c',3),(3,'Eduardo','Cortez','8991544118','lgsus.cortez@gmail.com','3e3468ad4ba09ee51aa734161914e0d960d1ba9e2be7c1237d498f141285256c',3),(4,'Lalo','Edu','123456789','lalo123@hotmail.com','ec2ffc6b46c40cf4e9d40abbdf5fb340bc2157475cced9f5d51adc00505e2b31',3),(5,'Eduardo','Cortez','8991544118','chuy@gmail.com','7f60908107a41a29d8d3b0aac2c68c9b1488c0061d5807d895ea65cb1869e815',3);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-04 12:53:45
