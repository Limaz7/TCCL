-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04-Out-2024 às 16:26
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
-- Estrutura da tabela `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_usuario` int NOT NULL,
  `comentario` varchar(255) NOT NULL,
  KEY `fk_id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id_endereco`, `id_evento`, `cep`, `rua`, `numero`, `bairro`) VALUES
(32, 59, 66876, 'KJHKHKH', 6868, 'HGJGJ'),
(33, 60, 978979, 'hkhkh', 7979, 'hkhkh'),
(34, 61, 76868, 'ghjv', 667575, 'jgjgjg'),
(35, 62, 575765, 'gjgjg', 856675, 'jhfjf'),
(36, 63, 5875785, 'u6hgjhgjhg', 768768, 'gjgjhgjh');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nome_evento`, `nome_empresa`, `descricao`, `data`, `imagem`) VALUES
(59, 'HKHKH', 'lazaro', 'KHKHK', '2024-10-24 23:22:00', '66ff516e89681.jpg'),
(60, 'jlj', 'lazaro', 'ljljl', '2024-10-30 23:22:00', '66ff517f38d04.jpg'),
(61, 'hkhkh', 'lazaro', 'khkhkh', '2024-10-24 23:23:00', '66ff51ac281ee.jpg'),
(62, 'gjgjg', 'lazaro', 'gjgjg', '2024-10-15 23:23:00', '66ff51b7c1e7c.jpg'),
(63, 'hkhkh', 'lazaro', 'hkhkh', '2024-10-18 23:24:00', '66ff51ca7a101.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_ingresso`
--

DROP TABLE IF EXISTS `info_ingresso`;
CREATE TABLE IF NOT EXISTS `info_ingresso` (
  `id_ingresso` int NOT NULL,
  `token` char(100) NOT NULL,
  `id_usuario` int NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `pago` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingressos`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `ingressos`
--

INSERT INTO `ingressos` (`id_ingresso`, `valor`, `id_evento`, `id_participante`, `quantidade`) VALUES
(2, 1e24, 63, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `email` varchar(255) NOT NULL,
  `token` char(100) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `usado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`email`, `token`, `data_criacao`, `usado`) VALUES
('lazaro.2022315968@aluno.iffar.edu.br', 'c9dde6d98b5a4e4621a537a6a65caa9ef84a108f5e68a4fc07a9081d34b7f43d122ce46ca804e565434b32e010a1d23f23e1', '2024-10-03 00:00:00', 0),
('lazaro.2022315968@aluno.iffar.edu.br', 'a614d36f72025ecf24ec2b3f53172bab68ed7de752fdfbbdf0a555958999912e5873a7570313951d70fb8f6f670421fad817', '2024-10-03 00:00:00', 0),
('lazaro.2022315968@aluno.iffar.edu.br', 'a0fffd34de2f7bab7099a22f6f25c661c563d8277f6a5c34d2d44af8295eda48811fdb0653bd401ddc45fb7832dbd869727c', '2024-10-03 00:00:00', 0),
('lazaro.2022315968@aluno.iffar.edu.br', '329285fb8c457d26f89d9675e6be8bb830ba747f7158b989044e45d6ebe746ef9daba770bcac01ef520af13e8dc6e0127cff', '2024-10-03 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_usuario`
--

DROP TABLE IF EXISTS `tipos_usuario`;
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
  `id_tipo_usuario` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `descricao`) VALUES
(1, 'adm'),
(2, 'participante'),
(3, 'empresa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
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
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`, `cod_ativacao`) VALUES
(8, 'lazaro', 'l@a.c', '$argon2i$v=19$m=65536,t=4,p=1$MC5mb0cwN2FnMGxzejBJag$oi63pAauxxZsuJBxVlIGPm2JImV7fUWOBipNsFKP+yM', 2, 1),
(24, 'lazaro', 'l@a.com', '$argon2i$v=19$m=65536,t=4,p=1$Nmp0Z3dwY3E5Y3dOaTFrag$Od/zRdKZpgsOqQNsJK/HxjrTBUZFv7qgmCqflB4J4k8', 3, 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_id_eventos` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Limitadores para a tabela `ingressos`
--
ALTER TABLE `ingressos`
  ADD CONSTRAINT `fk_id_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipos_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
