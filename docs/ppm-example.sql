CREATE DATABASE  IF NOT EXISTS `ppm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ppm`;
-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: ppm
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `passwords`
--

DROP TABLE IF EXISTS `passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passwords` (
  `uid` int NOT NULL,
  `pid` int NOT NULL AUTO_INCREMENT,
  `password` text NOT NULL,
  `site_name` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `username` text NOT NULL,
  PRIMARY KEY (`pid`,`uid`),
  KEY `passwords_uid_fk` (`uid`),
  CONSTRAINT `passwords_uid_fk` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwords`
--

LOCK TABLES `passwords` WRITE;
/*!40000 ALTER TABLE `passwords` DISABLE KEYS */;
INSERT INTO `passwords` VALUES (6,6,'CWa5qDuB9gPPOhc+JNph0w==','123','2023-04-18 19:50:16','123'),(6,7,'jDe8qErgMMgxkG8E/sRF8g==','445','2023-04-18 19:50:16','445'),(9,8,'rQq2kX1rE85N89+7D53qX95eQPFe2gDrn95kwOYtF5A=','TExam.com','2023-04-18 19:52:17','TExam'),(9,9,'+wlfEWHVitrUT921ATaQfA==','1234','2023-04-18 19:53:34','123'),(10,10,'lTm42Lok55ZFLtMJ+DFw1Q==','whatever.com','2023-04-19 09:40:22','testing'),(10,11,'G0Y+u2gaYHx6bJ88hBZUhQ==','12345','2023-04-19 09:40:22','123'),(10,12,'6Mkts+Zk83HuoKiNe3UKAw==','456','2023-04-19 09:40:22','456'),(10,13,'N1+4ub32Aq5TGzvz+HAxhg==','789','2023-04-19 09:40:22','789'),(11,14,'7ky4fONT/oVDKhcPTDO3hQ==','site123','2023-04-19 10:21:51','site'),(11,15,'6Oe0HHhashzV3T5zp9soQQ==','123','2023-04-19 10:21:51','123'),(11,16,'LM4np3Zs3gG5BJqZpfaRPg==','567','2023-04-19 10:21:51','567'),(11,17,'vTyNcf5RvWxWBTUojZQeVA==','890','2023-04-19 10:21:51','890'),(11,18,'f2TDBfw9VLHzevhp3LJ7nw==','zxc','2023-04-19 10:21:51','zdc'),(11,19,'VKa3CCUnXRQXZKuHaJak/w==','tyu','2023-04-19 10:21:51','uyt'),(11,20,'lnTSsmD7d464vhhNZMtvMQ==','opl','2023-04-19 10:21:51','opl'),(12,21,'kiDE9XeTfTc7I6IZRBLvbg==','456','2023-04-19 14:10:20','456');
/*!40000 ALTER TABLE `passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `master_key` text NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'KfNFZcwXn42nyJnKEdLwlcwNypHYW0rUHQlRJ08JHqzyClJg432AhZ3Wb0l4QyB11TCk7WBf5rbdFw3C5DG1jcQJKDZ4ohZlgPvCq+TKpUx4o8b1V04tWptW/znNPE+W','$2y$10$H.YNkr.SCJKXVdWGyQwt9Ox8ZUhFrGxqepywp.azyGhLlL8.7GcBe','tray'),(5,'DPRTi3HEilmmNL41sycSZXDvambvh8ypzdIfQHznSm4YR0QnGy7hxvjoYEbkCPJgGy+gbAZs1epyJh14c1BRrUOXb9CSeK3i0gTLfYxoseefYQE3GBixPs7IUnzqUT4s','$2y$10$koLzE8j4h.nnXaDHy42fhOqcyuKpLQZtY0ekJrP89ZhCEFrw4nCN6','kipras'),(6,'IGcOs1w4dWTYOjan4RMIKW8AozpS11j+fZN9A5kzFvjIfqgo/oGdb2iUI4csX56O0QKbLKbvD5vK+cFlgX9Zi79o6e0Ov6ghAUCI1oaN+cN0d/z0DooRDeOpAk9wce0b','$2y$10$V4iZLopvT3vIwyshXr.ksuo3Km5F6EO4NxzkAXZg260Imoojav6c2','123'),(7,'ma++K2j1k5Zj9CQzopW5IEy4Z8STBFjaqoERjdgBcYR2pVowIwpA3llmBqc38ZbNG+afecw/tMUL+KelSO4unyvkACMTEiIi3WDKh5oUO0b6+msU5Ruj1mo/3Sw2Bgjr','$2y$10$oa.eaCs8bzc3Pzt6dAQCnuRb90.RpOi5nmwKRtOhZIyS5SCqXPSvO','asya'),(8,'EkUaoEzJG51y+8+lxpYLVxVqgVvOPJrHsTseB3TN0do6K7W3CedbX5be4nOWzE3iSOww+5pSMee7hvuh0zi79sGnEbAGV0sWz41NiKtCOqJ74n/sQbk9YwUPRQdkJBwA','$2y$10$T1xy/BZuZ/Oni3N659vF8uIsscPzTMBGp96N0lcj06UYbXJN5MYGO','alexei'),(9,'hhKHXR7nC5mZi8TjOPwbNnPg1O9dbobUoRHimfqo6XsRktnmidOnfL01CjbQNyO+Rxerg1u/ZYSYZvnER/nBlqqOlR4PwWo2YhgXYF5bq+emFfjgtriqY0qRNS+Doaxp','$2y$10$AhrG9ed5gosnuZkzwMYpOuDGOD.JAwBgw5gaSQc5Wa9SRMCa.FXQK','Titas'),(10,'TdqhmZ6an8LRgmr6/lkfs6dxKGprEyJ+aYSD5jWJX3sQ35MML5Zjuo90yJC3zmxyKd5e5hW7GF4RI4bcD5DZ4WdzjxWULXqxahRiHGabWngUJNdtphxN9xjUlhBicCC+','$2y$10$gZ9A7sdNmyDhkSEW15e9RukDN4gLcqPqD2nc9sfdUwfE0b1Tb1rc2','test'),(11,'GYmlnZDMV5gB/fJpGcncs6szvxE+OEaKltYZte3hLOvVSMDeoksPSQzWqTwvaReunrvdhNysodePU4NaEeY7CWIZrWaeu9HLKnXOojKcuOMZQx916QsIlEy6QP9Yst35','$2y$10$kzHFuF/DwnBR3OEzHG7XUOpvtoGU44UUankFpemtKcXYiVuMRbgvC','test123'),(12,'UgnjeIGrSRqcywmy/cx6rd1Qe5VGCkZC2986gDfyYUjVoXO1MyuuV46wc4pEPylG5O9vuMeUB1edcRw3741rHlAdjcXSNaVGFyKjEDMTmCpRCYKGoh1F7iYDXMGQjkFz','$2y$10$pmQ5jl1sjorJVNtDrSh6RuabfB3mRy9OWZpRw7WBeq7QOmm5zvRF.','123456');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-20 15:16:26
