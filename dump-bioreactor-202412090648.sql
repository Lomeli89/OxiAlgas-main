-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: bioreactor
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `tabla_bioreactor`
--

DROP TABLE IF EXISTS `tabla_bioreactor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabla_bioreactor` (
  `id_bioreactor` int(13) NOT NULL AUTO_INCREMENT,
  `nombre_bioreactor` varchar(255) DEFAULT NULL,
  `descripcion_bioreactor` varchar(255) DEFAULT NULL,
  `direccion_ip` varchar(20) DEFAULT NULL,
  `clave` varchar(65) DEFAULT NULL,
  `id_usuario` int(13) DEFAULT NULL,
  PRIMARY KEY (`id_bioreactor`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tabla_bioreactor_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tabla_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabla_bioreactor`
--

LOCK TABLES `tabla_bioreactor` WRITE;
/*!40000 ALTER TABLE `tabla_bioreactor` DISABLE KEYS */;
INSERT INTO `tabla_bioreactor` VALUES (1,'Integrador','Este bioreactor pertenece al integrador','192.168.1.76:81192.1','1234',5),(2,'prueba','nuevo','177.12.2.1:02','1234',6),(3,'prueba12','dfnuefksksks','177.12.2.1:32','fdsfs',6),(5,'cliente','dasdadasdas','177.12.2.44:32','1234',6);
/*!40000 ALTER TABLE `tabla_bioreactor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabla_datos`
--

DROP TABLE IF EXISTS `tabla_datos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabla_datos` (
  `id_dato` int(13) NOT NULL AUTO_INCREMENT,
  `tds` decimal(13,3) DEFAULT NULL,
  `cO2_bioreactor` decimal(13,3) DEFAULT NULL,
  `temp_agua` decimal(13,3) DEFAULT NULL,
  `tvoc_bioreactor` decimal(13,3) DEFAULT NULL,
  `id_bioreactor` int(13) DEFAULT NULL,
  PRIMARY KEY (`id_dato`),
  KEY `id_bioreactor` (`id_bioreactor`),
  CONSTRAINT `tabla_datos_ibfk_1` FOREIGN KEY (`id_bioreactor`) REFERENCES `tabla_bioreactor` (`id_bioreactor`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabla_datos`
--

LOCK TABLES `tabla_datos` WRITE;
/*!40000 ALTER TABLE `tabla_datos` DISABLE KEYS */;
INSERT INTO `tabla_datos` VALUES (1,983.390,130.400,22.000,2.220,1),(2,987.690,134.520,22.800,0.060,1),(3,950.220,169.230,23.600,1.800,1),(4,980.890,174.530,24.400,1.320,1),(5,998.670,128.360,25.200,1.160,1),(6,954.820,158.960,26.000,2.650,1),(7,964.850,187.080,26.800,2.850,1),(8,987.730,109.690,27.600,1.600,1),(9,989.770,162.940,28.400,2.670,1),(10,993.200,124.120,29.200,1.050,1),(11,996.160,193.320,30.000,1.700,1),(12,964.290,179.660,30.400,2.330,1),(13,961.490,132.070,30.800,1.840,1),(14,997.760,179.300,31.200,2.660,1),(15,959.440,137.650,31.600,0.240,1),(16,990.150,109.240,32.000,2.780,1),(17,965.200,172.240,32.400,0.320,1),(18,954.850,194.130,32.800,1.360,1),(19,970.820,107.860,33.200,2.210,1),(20,969.130,166.970,33.600,0.720,1),(21,993.430,158.380,34.000,2.760,1),(22,967.020,181.790,34.400,1.540,1),(23,965.460,147.700,32.330,2.340,1),(24,999.550,192.800,31.370,1.360,1),(25,954.210,195.050,33.220,2.080,1),(26,981.450,117.430,32.500,1.950,1),(27,963.940,172.720,31.060,0.060,1),(28,979.390,178.860,31.160,2.510,1),(29,997.730,147.740,33.180,0.780,1),(30,951.840,119.840,32.880,2.930,1);
/*!40000 ALTER TABLE `tabla_datos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabla_sensor`
--

DROP TABLE IF EXISTS `tabla_sensor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabla_sensor` (
  `id_ambiente` int(13) NOT NULL AUTO_INCREMENT,
  `temperatura` decimal(13,3) DEFAULT NULL,
  `humedad` decimal(13,3) DEFAULT NULL,
  `cO2_ambiente` decimal(13,3) DEFAULT NULL,
  `tvoc_ambiente` decimal(13,3) DEFAULT NULL,
  `id_bioreactor` int(13) DEFAULT NULL,
  PRIMARY KEY (`id_ambiente`),
  KEY `id_bioreactor` (`id_bioreactor`),
  CONSTRAINT `tabla_sensor_ibfk_1` FOREIGN KEY (`id_bioreactor`) REFERENCES `tabla_bioreactor` (`id_bioreactor`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabla_sensor`
--

LOCK TABLES `tabla_sensor` WRITE;
/*!40000 ALTER TABLE `tabla_sensor` DISABLE KEYS */;
INSERT INTO `tabla_sensor` VALUES (1,22.000,34.710,547.560,1.160,1),(2,22.100,33.800,502.490,0.500,1),(3,22.200,33.140,525.510,0.200,1),(4,22.300,33.390,587.630,2.920,1),(5,22.400,34.560,513.520,2.480,1),(6,22.500,33.380,521.820,2.760,1),(7,22.600,33.690,491.670,2.560,1),(8,22.700,35.890,519.320,1.030,1),(9,22.800,33.810,451.910,2.690,1),(10,22.900,34.960,556.590,1.070,1),(11,23.000,35.450,537.230,1.470,1),(12,23.100,33.160,592.240,0.290,1),(13,23.200,33.720,571.540,1.520,1),(14,23.300,34.530,534.210,2.310,1),(15,23.400,33.780,543.870,1.380,1),(16,23.500,33.500,475.550,1.250,1),(17,23.600,35.680,523.310,1.240,1),(18,23.700,35.140,511.920,1.780,1),(19,23.800,34.640,566.580,1.660,1),(20,23.900,35.420,523.880,2.690,1),(21,24.000,35.780,534.210,0.850,1),(22,24.100,33.860,548.540,0.130,1),(23,24.200,34.370,577.920,1.570,1),(24,24.300,34.930,597.900,2.770,1),(25,24.400,34.910,519.920,0.920,1),(26,24.500,34.450,559.470,0.250,1),(27,24.600,33.480,457.690,2.190,1),(28,24.700,34.270,523.610,0.090,1),(29,24.800,34.680,550.360,1.770,1),(30,24.900,34.040,464.050,0.400,1);
/*!40000 ALTER TABLE `tabla_sensor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabla_tipo_usuario`
--

DROP TABLE IF EXISTS `tabla_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabla_tipo_usuario` (
  `id_tipo_usuario` int(13) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabla_tipo_usuario`
--

LOCK TABLES `tabla_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tabla_tipo_usuario` DISABLE KEYS */;
INSERT INTO `tabla_tipo_usuario` VALUES (1,'Cliente'),(2,'Admin');
/*!40000 ALTER TABLE `tabla_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabla_usuarios`
--

DROP TABLE IF EXISTS `tabla_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabla_usuarios` (
  `id_usuario` int(13) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(65) DEFAULT NULL,
  `apellido` varchar(65) DEFAULT NULL,
  `correo_electronico` varchar(65) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `id_tipo_usuario` int(13) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  CONSTRAINT `tabla_usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tabla_tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabla_usuarios`
--

LOCK TABLES `tabla_usuarios` WRITE;
/*!40000 ALTER TABLE `tabla_usuarios` DISABLE KEYS */;
INSERT INTO `tabla_usuarios` VALUES (5,'Angel','Lomeli','angellomeli25@gmail.com','$2y$10$WPJMUspXbTxxs5yMjPRNZeyAw9Rb/ENo7fSCWW62Lkjr6NUy2551C','6242100447',1),(6,'Edgar','Sanchez','edgarsanchez@hotmail.com','$2y$10$78zjMPKRwQsIhQ7lMlvySuYKrxIQ22VWr6GAqhksq3ocjxPc8Rd4K','6241234567',1);
/*!40000 ALTER TABLE `tabla_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'bioreactor'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-09  5:48:16
