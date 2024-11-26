-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Nov-2024 às 19:54
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id_usuario` int NOT NULL,
  `comentario` varchar(255) NOT NULL,
  KEY `fk_id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `nome_evento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `produtora` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data` datetime NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `numero_residencial` int NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fk_id_usuario_1` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nome_evento`, `produtora`, `descricao`, `data`, `cep`, `rua`, `bairro`, `numero_residencial`, `imagem`) VALUES
(19, 9, 'Show de Rock', 'Rockstars Inc.', 'Um grande show de rock com bandas locaissssssssss.', '2024-11-15 20:00:00', 12345678, 'Rua das Flores', 'Centro', 1234, '67461c60d56fa.jpg'),
(20, 10, 'Festival de Música', 'Music Fest Ltd.', 'Festival com diversas atrações e food trucks.', '2024-12-01 18:00:00', 23456789, 'Avenida da Liberdade', 'Jardim', 1234, '67461c60d56fa.jpg'),
(21, 9, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e músicaaaaaaaaaaaaa.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, '67461c60d56fa.jpg'),
(22, 10, 'Show de Rock', 'Rockstars Inc.', 'Um grande show de rock com bandas locais.', '2024-11-15 20:00:00', 12345678, 'Rua das Flores', 'Centro', 1234, '67461c60d56fa.jpg'),
(23, 9, 'Festival de Música', 'Music Fest Ltd.', 'Festival com diversas atrações e food trucks.', '2024-12-01 18:00:00', 23456789, 'Avenida da Liberdade', 'Jardim', 1234, '67461c60d56fa.jpg'),
(24, 10, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e música.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, '67461c60d56fa.jpg'),
(45, 8, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e música.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, '67461c60d56fa.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingressos_cadastrados`
--

DROP TABLE IF EXISTS `ingressos_cadastrados`;
CREATE TABLE IF NOT EXISTS `ingressos_cadastrados` (
  `id_ingresso` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `informacao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `valor` float NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id_ingresso`),
  KEY `fk_id_evento` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `ingressos_cadastrados`
--

INSERT INTO `ingressos_cadastrados` (`id_ingresso`, `id_evento`, `informacao`, `valor`, `quantidade`) VALUES
(21, 20, 'Ingresso Pistaeeeee', 90, 90),
(22, 19, 'Ingresso Camarote', 120, 100),
(23, 22, 'Ingresso Dia Inteiro', 100, 90),
(24, 21, 'Ingresso Platéia', 80, 90),
(25, 20, 'Ingresso Pista', 50, 90),
(26, 19, 'Ingresso Camarote', 120, 80),
(27, 22, 'Ingresso Dia Inteiro', 100, 90),
(28, 21, 'Ingresso Platéia', 80, 90),
(29, 45, 'Ingresso Pista', 50, 90);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingressos_comprados`
--

DROP TABLE IF EXISTS `ingressos_comprados`;
CREATE TABLE IF NOT EXISTS `ingressos_comprados` (
  `id_ingresso` int NOT NULL,
  `token` char(100) NOT NULL,
  `id_usuario` int NOT NULL,
  `quantidade` int NOT NULL,
  `data` datetime NOT NULL,
  `pago` tinyint(1) NOT NULL,
  UNIQUE KEY `token` (`token`),
  KEY `fk_id_usuario_2` (`id_usuario`),
  KEY `fk_id_ingresso` (`id_ingresso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `ingressos_comprados`
--

INSERT INTO `ingressos_comprados` (`id_ingresso`, `token`, `id_usuario`, `quantidade`, `data`, `pago`) VALUES
(22, '45fee4663159baada918cd74d0d03d379c5c3d7110aa54b1d72512dfb67246e2742926ebb06178613bf375a66cca7dd50aa4', 8, 10, '2024-11-09 22:17:12', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `email` varchar(255) NOT NULL,
  `token` char(100) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `usado` tinyint(1) NOT NULL,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `id_tipo_usuario` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `descricao`) VALUES
(1, 'Admin'),
(2, 'Usuário Comum'),
(3, 'Empresa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `img_perfil` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'imgperf.png',
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` int NOT NULL,
  `cod_ativacao` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_tipo_usuario` (`tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `img_perfil`, `nome`, `email`, `senha`, `tipo_usuario`, `cod_ativacao`) VALUES
(1, 'imgperf.png', 'ADMIN', 'admin@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 1, 1),
(8, 'imgperf.png', 'Carlos Souza', 'carlos.souza@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 2, 1),
(9, 'imgperf.png', 'Ana Paula', 'ana.paula@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 3, 1),
(10, 'imgperf.png', 'Roberto Almeida', 'roberto.almeida@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 3, 1),
(28, 'imgperf.png', 'Lázaro', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$OU5lemRkTnBDQ2wwVVBZdQ$LVe/4+JhDmf0L/8zCCl3URWdyIa6FcncDEdN9l19fOo', 2, 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_id_usuario_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `ingressos_cadastrados`
--
ALTER TABLE `ingressos_cadastrados`
  ADD CONSTRAINT `fk_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Limitadores para a tabela `ingressos_comprados`
--
ALTER TABLE `ingressos_comprados`
  ADD CONSTRAINT `fk_id_ingresso` FOREIGN KEY (`id_ingresso`) REFERENCES `ingressos_cadastrados` (`id_ingresso`),
  ADD CONSTRAINT `fk_id_usuario_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
