-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 200.18.128.50    Database: presencaescolar
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

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
-- Table structure for table `Aluno`
--

DROP TABLE IF EXISTS `Aluno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Aluno` (
  `matricula` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `Turma_idTurma` int NOT NULL,
  `Responsavel_id` int NOT NULL,
  `uidCartao` varchar(10) DEFAULT NULL,
  `senhaAlterada` int DEFAULT '0',
  PRIMARY KEY (`matricula`),
  KEY `Turma_idTurma` (`Turma_idTurma`),
  KEY `Responsavel_id` (`Responsavel_id`),
  KEY `uidCartao` (`uidCartao`),
  CONSTRAINT `Aluno_ibfk_1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`),
  CONSTRAINT `Aluno_ibfk_2` FOREIGN KEY (`Responsavel_id`) REFERENCES `Responsavel` (`id`),
  CONSTRAINT `Aluno_ibfk_3` FOREIGN KEY (`uidCartao`) REFERENCES `Cartao` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Aula`
--

DROP TABLE IF EXISTS `Aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Aula` (
  `idAula` int NOT NULL AUTO_INCREMENT,
  `Disciplina_idDisciplina` int DEFAULT NULL,
  `Turma_idTurma` int DEFAULT NULL,
  `horasInicio` time NOT NULL,
  `horaFim` time NOT NULL,
  `diaSemana` int NOT NULL,
  PRIMARY KEY (`idAula`),
  KEY `Turma_idTurma` (`Turma_idTurma`),
  KEY `Disciplina_idDisciplina` (`Disciplina_idDisciplina`),
  CONSTRAINT `Aula_ibfk_1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`),
  CONSTRAINT `Aula_ibfk_2` FOREIGN KEY (`Disciplina_idDisciplina`) REFERENCES `Disciplina` (`idDisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Cartao`
--

DROP TABLE IF EXISTS `Cartao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Cartao` (
  `uid` varchar(10) NOT NULL,
  `disponivel` int DEFAULT NULL,
  `matriculaAluno` int DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `matriculaAluno` (`matriculaAluno`),
  CONSTRAINT `Cartao_ibfk_1` FOREIGN KEY (`matriculaAluno`) REFERENCES `Aluno` (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Disciplina`
--

DROP TABLE IF EXISTS `Disciplina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Disciplina` (
  `idDisciplina` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `professor` varchar(100) NOT NULL,
  `numeroAulas` int NOT NULL,
  PRIMARY KEY (`idDisciplina`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Funcionario`
--

DROP TABLE IF EXISTS `Funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Funcionario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `verificado` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Presenca`
--

DROP TABLE IF EXISTS `Presenca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Presenca` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Aluno_matricula` int DEFAULT NULL,
  `Aula_idAula` int DEFAULT NULL,
  `Disciplina_idDisciplina` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `Turma_idTurma` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Aluno_matricula` (`Aluno_matricula`),
  KEY `Aula_idAula` (`Aula_idAula`),
  KEY `Disciplina_idDisciplina` (`Disciplina_idDisciplina`),
  KEY `Turma_idTurma` (`Turma_idTurma`),
  CONSTRAINT `Presenca_ibfk_1` FOREIGN KEY (`Aluno_matricula`) REFERENCES `Aluno` (`matricula`),
  CONSTRAINT `Presenca_ibfk_2` FOREIGN KEY (`Aula_idAula`) REFERENCES `Aula` (`idAula`),
  CONSTRAINT `Presenca_ibfk_3` FOREIGN KEY (`Disciplina_idDisciplina`) REFERENCES `Disciplina` (`idDisciplina`),
  CONSTRAINT `Presenca_ibfk_4` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`)
) ENGINE=InnoDB AUTO_INCREMENT=1179 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Responsavel`
--

DROP TABLE IF EXISTS `Responsavel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Responsavel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senhaAlterada` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Turma`
--

DROP TABLE IF EXISTS `Turma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Turma` (
  `idTurma` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `ano` int DEFAULT NULL,
  PRIMARY KEY (`idTurma`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-08 19:23:45
