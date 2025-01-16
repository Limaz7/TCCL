-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Jan-2025 às 20:04
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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nome_evento`, `produtora`, `descricao`, `data`, `cep`, `rua`, `bairro`, `numero_residencial`, `imagem`) VALUES
(67, 9, 'Show rock', 'Ana Paula', 'O melhor show de rock do país', '2025-01-08 15:16:00', 78567, 'Presidente Vargas', 'aaa', 1122, '67895bf64ec99.jpg'),
(68, 9, 'Show sertanejo', 'Ana Paula', 'LUAN PEREIRA NA SUA CIDADE!!!!!', '2025-01-22 20:24:00', 22338753, 'Venancio aires', 'Centro', 2233, '67895c8b11542.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingressos_cadastrados`
--

DROP TABLE IF EXISTS `ingressos_cadastrados`;
CREATE TABLE IF NOT EXISTS `ingressos_cadastrados` (
  `id_ingresso` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `nome_ingresso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `desc_ingresso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `estoque` int NOT NULL,
  PRIMARY KEY (`id_ingresso`),
  KEY `fk_id_evento` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `ingressos_cadastrados`
--

INSERT INTO `ingressos_cadastrados` (`id_ingresso`, `id_evento`, `nome_ingresso`, `desc_ingresso`, `valor`, `estoque`) VALUES
(52, 67, 'Ingresso10', 'Lorem', '10.99', 10),
(53, 67, 'rgds', 'htfh', '99.00', 10),
(54, 67, 'Ingresso VIP', 'Bebida liberada', '100.00', 84);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingressos_comprados`
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `ingressos_comprados`
--

INSERT INTO `ingressos_comprados` (`cart_id`, `id_ingresso`, `id_usuario`, `ticket`, `quantidade`, `data`, `estoque`, `cart_valor`, `cart_total`, `cart_status`, `cart_session`, `pago`) VALUES
(95, 54, 28, 'ee9f00827c8d51e6f819', 8, '2025-01-14 15:35:54', 92, '100.00', '800.00', 1, 879229730, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `img_perfil`, `nome`, `email`, `senha`, `tipo_usuario`, `cod_ativacao`) VALUES
(1, 'imgperf.png', 'ADMIN', 'admin@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 1, 1),
(8, 'imgperf.png', 'Carlos Souza', 'carlos.souza@example.com', '$argon2i$v=19$m=65536,t=4,p=1$Ny5TMHd2c3YxclFzQUNucg$zlJtAjaVxDbru4xyNy9Twpax8ZCNOytJo/2Xi33cvM4', 2, 1),
(9, 'imgperf.png', 'Ana Paula', 'ana.paula@example.com', '$argon2i$v=19$m=65536,t=4,p=1$Z1B6aGQ0WGYvNFBIZU1BYg$RU4TX15I28nqW62vXmboETmFbf3H46w+V6Ie9ca4kXA', 3, 1),
(10, 'imgperf.png', 'Roberto Almeida', 'roberto.almeida@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WTZtQjlMSUMzblVRZlFiLg$TMYDvo7RhH5pyqwY73QGmx0nT0v6+FZ+7MnSCSRhmt0', 3, 1),
(28, 'imgperf.png', 'Lázaroo', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$OU5lemRkTnBDQ2wwVVBZdQ$LVe/4+JhDmf0L/8zCCl3URWdyIa6FcncDEdN9l19fOo', 2, 1),
(32, 'imgperf.png', 'João', 'joao@example.com', '$argon2i$v=19$m=65536,t=4,p=1$SG01ZHZ6R2JKSkhoaEJrcA$DRth4sX8LBzNipK47DBZ2IRaTtP3iTrahyToFYxVYPA', 2, 1),
(33, 'imgperf.png', 'AC/DC', 'acdc@example.com', '$argon2i$v=19$m=65536,t=4,p=1$VGs0d1BwN20uTlFnOFdKLw$Uq+0nLn1fy/yHfz3EnHmYrpY7cBid1r9dfJrDWDsBGc', 3, 1);

--
-- Restrições para despejos de tabelas
--

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
