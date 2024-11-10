-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10/11/2024 às 01:54
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
-- Estrutura para tabela `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id_usuario` int NOT NULL,
  `comentario` varchar(255) NOT NULL,
  KEY `fk_id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nome_evento`, `produtora`, `descricao`, `data`, `cep`, `rua`, `bairro`, `numero_residencial`, `imagem`) VALUES
(19, 9, 'Show de Rock', 'Rockstars Inc.', 'Um grande show de rock com bandas locaissssssssss.', '2024-11-15 20:00:00', 12345678, 'Rua das Flores', 'Centro', 1234, 'imagem1.jpg'),
(20, 10, 'Festival de Música', 'Music Fest Ltd.', 'Festival com diversas atrações e food trucks.', '2024-12-01 18:00:00', 23456789, 'Avenida da Liberdade', 'Jardim', 1234, 'imagem2.jpg'),
(21, 9, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e músicaaaaaaaaaaaaa.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, 'imagem3.jpg'),
(22, 10, 'Show de Rock', 'Rockstars Inc.', 'Um grande show de rock com bandas locais.', '2024-11-15 20:00:00', 12345678, 'Rua das Flores', 'Centro', 1234, 'imagem1.jpg'),
(23, 9, 'Festival de Música', 'Music Fest Ltd.', 'Festival com diversas atrações e food trucks.', '2024-12-01 18:00:00', 23456789, 'Avenida da Liberdade', 'Jardim', 1234, 'imagem2.jpg'),
(24, 10, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e música.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, 'imagem3.jpg'),
(45, 8, 'Teatro Musical', 'Teatro Artes', 'Uma noite mágica de teatro e música.', '2024-11-22 19:30:00', 34567890, 'Praça da Alegria', 'Bairro Alto', 1234, 'imagem3.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingressos_cadastrados`
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
-- Despejando dados para a tabela `ingressos_cadastrados`
--

INSERT INTO `ingressos_cadastrados` (`id_ingresso`, `id_evento`, `informacao`, `valor`, `quantidade`) VALUES
(21, 20, 'Ingresso Pista', 50, 90),
(22, 19, 'Ingresso Camarote', 120, 0),
(23, 22, 'Ingresso Dia Inteiro', 100, 90),
(24, 21, 'Ingresso Platéia', 80, 90),
(25, 20, 'Ingresso Pista', 50, 90),
(26, 19, 'Ingresso Camarote', 120, 80),
(27, 22, 'Ingresso Dia Inteiro', 100, 90),
(28, 21, 'Ingresso Platéia', 80, 90),
(29, 20, 'Ingresso Pista', 50, 90),
(30, 19, 'Ingresso Camarote', 120, 80);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingressos_comprados`
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
-- Despejando dados para a tabela `ingressos_comprados`
--

INSERT INTO `ingressos_comprados` (`id_ingresso`, `token`, `id_usuario`, `quantidade`, `data`, `pago`) VALUES
(22, '2a982ee418d3d1fc2f1401256c5354c5977a627a428eb789bbc011046c2497b4bdedadecea16db0d9f731fa9769665501357', 27, 10, '2024-11-09 22:42:43', 0),
(22, '45fee4663159baada918cd74d0d03d379c5c3d7110aa54b1d72512dfb67246e2742926ebb06178613bf375a66cca7dd50aa4', 27, 10, '2024-11-09 22:17:12', 0),
(22, '5eb303e3e64f60b1c44a6741f672c2d1e96640e5471e214af960ba1210628edcc16e8abc4bcd6f17865cd82d797897577df4', 27, 10, '2024-11-09 22:26:55', 0),
(22, '7537bc4bc81a40a9c94cbefb50032f81363b0bbff21d1229482b9a0a7165f14dafa8f6e661449211bfaff1fce6efe14ecab5', 27, 10, '2024-11-09 22:37:55', 0),
(22, '75565f18dad012b667db40e0337efac951683c4a267e1dace705112a590433c254b10afc8a0b31a0d1ffd99b117b40db9025', 27, 10, '2024-11-09 22:22:06', 0),
(22, 'aab24bbe6497ffddb4747ebb63438018a201abdc801d320ca7eef35e5832bea009c7f10c14195d6b7d02ba528c561efa6f30', 27, 10, '2024-11-09 22:24:43', 0),
(22, 'aac62aa282f7c28daff5c0a623f4a65dfd5f26ab57fa3d9dc2648b9eeedbb025b091e7aa59c109263dd25b4fc72ee474dfc1', 27, 10, '2024-11-09 22:38:27', 0),
(22, 'bda381fdef144b091243dafb178c5f4eada81b5a814fbfb85231e40dd322110cfc1ba89657f985a0945a24467704e6231235', 27, 10, '2024-11-09 22:42:01', 0),
(22, 'd655bc5a07dc57f5f897a26d87e355a6cfc90ec945310f528ce4645079fdf5d539ca127edacca1b96bc83dece2fd0ad2031a', 27, 10, '2024-11-09 22:34:30', 0);

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
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` int NOT NULL,
  `cod_ativacao` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_tipo_usuario` (`tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`, `cod_ativacao`) VALUES
(6, 'ADMIN', 'admin@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 1, 1),
(8, 'Carlos Souza', 'carlos.souza@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 2, 1),
(9, 'Ana Paula', 'ana.paula@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 3, 1),
(10, 'Roberto Almeida', 'roberto.almeida@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 3, 1),
(27, 'Lázaro', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$SmJTRFVJTjN0MFNhVmpFcA$BlEWJA7jDOYDQMY2e/I/6TkcCGwrgp+be2RTgnn4ZrE', 2, 1);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

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
