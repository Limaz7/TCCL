-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06/01/2025 às 04:47
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.2.18

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
-- Estrutura para tabela `eventos`
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nome_evento`, `produtora`, `descricao`, `data`, `cep`, `rua`, `bairro`, `numero_residencial`, `imagem`) VALUES
(19, 9, 'Show de Rockk', 'Rockstars Inc.', 'Um grande show de rock com bandas locaissssssssss.', '2024-11-15 20:00:00', 12345678, 'Rua das Flores', 'Centro', 1234, '67461c60d56fa.jpg'),
(20, 10, 'Festival de Música', 'Music Fest Ltd.', 'Festival com diversas atrações e food trucks.', '2024-12-01 18:00:00', 23456789, 'Avenida da Liberdade', 'Jardim', 1234, '67461c60d56fa.jpg'),
(21, 9, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e músicaaaaaaaaaaaaa.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, '67461c60d56fa.jpg'),
(23, 9, 'Festival de Música', 'Music Fest Ltd.', 'Festival com diversas atrações e food trucks.', '2024-12-01 18:00:00', 23456789, 'Avenida da Liberdade', 'Jardim', 1234, '67461c60d56fa.jpg'),
(24, 10, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e música.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, '67461c60d56fa.jpg'),
(45, 8, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e música.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, '67461c60d56fa.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingressos_cadastrados`
--

DROP TABLE IF EXISTS `ingressos_cadastrados`;
CREATE TABLE IF NOT EXISTS `ingressos_cadastrados` (
  `id_ingresso` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `nome_ingresso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `product_link` varchar(255) NOT NULL,
  `desc_ingresso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `estoque` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id_ingresso`),
  KEY `fk_id_evento` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ingressos_cadastrados`
--

INSERT INTO `ingressos_cadastrados` (`id_ingresso`, `id_evento`, `nome_ingresso`, `product_link`, `desc_ingresso`, `valor`, `estoque`, `status`) VALUES
(21, 20, 'Ingresso Pistaeeeee', '', 'Aliquam egestas tristique nunc sed vestibulum. Nulla aliquam ex at sapien condimentum molestie', 90.00, 20, 1),
(24, 21, 'Ingresso Platéia', '', 'Aliquam egestas tristique nunc sed vestibulum. Nulla aliquam ex at sapien condimentum molestie', 80.00, 90, 1),
(25, 20, 'Ingresso Pista', '', 'Aliquam egestas tristique nunc sed vestibulum. Nulla aliquam ex at sapien condimentum molestie', 50.00, 90, 1),
(26, 19, 'Ingresso VIP', '', 'Aliquam egestas tristique nunc sed vestibulum. Nulla aliquam ex at sapien condimentum molestie', 120.00, 21, 1),
(28, 21, 'Ingresso Platéia', '', 'Aliquam egestas tristique nunc sed vestibulum. Nulla aliquam ex at sapien condimentum molestie', 80.00, 92, 1),
(29, 45, 'Ingresso Pista', '', 'Aliquam egestas tristique nunc sed vestibulum. Nulla aliquam ex at sapien condimentum molestie', 50.00, 90, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingressos_comprados`
--

DROP TABLE IF EXISTS `ingressos_comprados`;
CREATE TABLE IF NOT EXISTS `ingressos_comprados` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `id_ingresso` int NOT NULL,
  `id_usuario` int NOT NULL,
  `ticket` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantidade` int NOT NULL,
  `data` datetime NOT NULL,
  `estoque` int NOT NULL,
  `cart_valor` decimal(10,2) NOT NULL,
  `cart_total` decimal(10,2) NOT NULL,
  `cart_status` int NOT NULL,
  `cart_session` int NOT NULL,
  `pago` tinyint(1) NOT NULL,
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `token` (`ticket`),
  KEY `fk_id_usuario_2` (`id_usuario`),
  KEY `fk_id_ingresso` (`id_ingresso`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ingressos_comprados`
--

INSERT INTO `ingressos_comprados` (`cart_id`, `id_ingresso`, `id_usuario`, `ticket`, `quantidade`, `data`, `estoque`, `cart_valor`, `cart_total`, `cart_status`, `cart_session`, `pago`) VALUES
(25, 26, 28, '0739414b86b4ec1e4844', 2, '0000-00-00 00:00:00', 38, 120.00, 240.00, 1, 555865201, 0),
(29, 26, 28, '933a6a36022994c8d3f3', 17, '0000-00-00 00:00:00', 21, 120.00, 2040.00, 1, 871045644, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperar_senha`
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
-- Estrutura para tabela `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `id_tipo_usuario` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `descricao`) VALUES
(1, 'Admin'),
(2, 'Usuário Comum'),
(3, 'Empresa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
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
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `img_perfil`, `nome`, `email`, `senha`, `tipo_usuario`, `cod_ativacao`) VALUES
(1, 'imgperf.png', 'ADMIN', 'admin@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 1, 1),
(8, 'imgperf.png', 'Carlos Souza', 'carlos.souza@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 2, 1),
(9, 'imgperf.png', 'Ana Paula', 'ana.paula@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 3, 1),
(10, 'imgperf.png', 'Roberto Almeida', 'roberto.almeida@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 3, 1),
(28, 'imgperf.png', 'Lázaro', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$OU5lemRkTnBDQ2wwVVBZdQ$LVe/4+JhDmf0L/8zCCl3URWdyIa6FcncDEdN9l19fOo', 2, 1);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_id_usuario_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `ingressos_cadastrados`
--
ALTER TABLE `ingressos_cadastrados`
  ADD CONSTRAINT `fk_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Restrições para tabelas `ingressos_comprados`
--
ALTER TABLE `ingressos_comprados`
  ADD CONSTRAINT `fk_id_ingresso` FOREIGN KEY (`id_ingresso`) REFERENCES `ingressos_cadastrados` (`id_ingresso`),
  ADD CONSTRAINT `fk_id_usuario_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
