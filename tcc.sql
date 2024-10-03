-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/10/2024 às 01:53
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
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_usuario` int NOT NULL,
  `comentario` varchar(255) NOT NULL,
  KEY `fk_id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id_endereco` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int NOT NULL,
  `bairro` varchar(255) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_id_evento` (`id_evento`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id_endereco`, `id_evento`, `cep`, `rua`, `numero`, `bairro`) VALUES
(26, 53, 989898, 'Getulio vargas', 98980, 'Marduque');

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `nome_evento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome_empresa` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nome_evento`, `nome_empresa`, `descricao`, `data`, `imagem`) VALUES
(53, 'Show', 'emp_Lazzarus', 'jkjkj', '2024-10-24 22:34:00', '66fc79022e05d.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingressos`
--

DROP TABLE IF EXISTS `ingressos`;
CREATE TABLE IF NOT EXISTS `ingressos` (
  `id_ingresso` int NOT NULL AUTO_INCREMENT,
  `valor` float NOT NULL,
  `id_evento` int NOT NULL,
  `id_participante` int NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id_ingresso`),
  KEY `fk_id_evento` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ingressos`
--

INSERT INTO `ingressos` (`id_ingresso`, `valor`, `id_evento`, `id_participante`, `quantidade`) VALUES
(1, 1, 53, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `id_tipo_usuario` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `descricao`) VALUES
(1, 'adm'),
(2, 'participante'),
(3, 'empresa');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`, `cod_ativacao`) VALUES
(7, 'emp_Lazzarus', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$c2xKZFpDbzlOQVpsQnM4dg$txs8XhjtIdmvp9kP00E3ZgkW7fObQTaujK6IOYPma58', 3, 1),
(8, 'lazaro', 'l@a.c', '$argon2i$v=19$m=65536,t=4,p=1$MC5mb0cwN2FnMGxzejBJag$oi63pAauxxZsuJBxVlIGPm2JImV7fUWOBipNsFKP+yM', 2, 1),
(24, 'la', 'l@a.co', '$argon2i$v=19$m=65536,t=4,p=1$aTM4eFNOSlEwSEZsS0RqeQ$Qutnuaux8jvsNSLN0tQUbt8EnOP2w0X9adDLzMzFwMY', 3, 1);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_id_eventos` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Restrições para tabelas `ingressos`
--
ALTER TABLE `ingressos`
  ADD CONSTRAINT `fk_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
