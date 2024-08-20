-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Ago-2024 às 20:00
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
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id_endereco` int NOT NULL AUTO_INCREMENT,
  `id_eventos` int NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id_endereco`),
  KEY `fk_id_eventos` (`id_eventos`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `id_eventos`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`) VALUES
(12, 36, 54454, 'gfgd', 5434, 'fgfgfd', 'gfdfg', 'fgfgf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_eventos` int NOT NULL AUTO_INCREMENT,
  `nome_evento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome_empresa` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_eventos`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id_eventos`, `nome_evento`, `nome_empresa`, `descricao`, `data`, `imagem`) VALUES
(36, 'thfgfg', 'emp_Lazzarus', 'gfgrr', '2024-08-20 14:14:00', '66b4fd4be36f6.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `empresa` tinyint(1) NOT NULL,
  `comentario` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `empresa`, `comentario`) VALUES
(14, 'emp_Lazzarus', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$T3JLMDlkUUJ2VGlmRDQ4Yg$9GrfWf47W2oHrP4JjKlJiNmq9jw/RTmcFFloKDassvY', 1, ''),
(15, 'lazaroo', 'lazarosau2020@hotmail.com', '$argon2i$v=19$m=65536,t=4,p=1$YUtJZEpvWC9pWXRtdFNEWA$YOYHFxqufCKIGa91sS030zPLvWLHaVzK4TmeBEfpmyE', 0, ''),
(17, 'emp_teste', 'teste@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Mk5yQ2txU3VCeEVscFZnTg$SJycraH7BqbHoQTI/DZQig12HN2PJWpiNR2oWb37v58', 1, '');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_id_eventos` FOREIGN KEY (`id_eventos`) REFERENCES `eventos` (`id_eventos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
