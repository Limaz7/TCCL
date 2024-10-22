-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 17-Out-2024 às 20:00
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
-- Estrutura da tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `nome_evento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nome_empresa` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `cep` int NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `numero` int NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fk_id_usuario_1` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nome_evento`, `nome_empresa`, `descricao`, `data`, `cep`, `rua`, `bairro`, `numero`, `imagem`) VALUES
(79, 29, 'Show', 'Lazzarus', 'bvfdsg', '2024-10-23 20:29:00', 4353, 'thfdg', 'ghgfhgfdf', 5435, '6711658d195c6.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_ingressos`
--

DROP TABLE IF EXISTS `info_ingressos`;
CREATE TABLE IF NOT EXISTS `info_ingressos` (
  `id_ingresso` int NOT NULL,
  `token` char(100) NOT NULL,
  `id_usuario` int NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `pago` tinyint(1) NOT NULL,
  UNIQUE KEY `token` (`token`),
  KEY `fk_id_usuario_2` (`id_usuario`),
  KEY `fk_id_ingresso` (`id_ingresso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `info_ingressos`
--

INSERT INTO `info_ingressos` (`id_ingresso`, `token`, `id_usuario`, `quantidade`, `data`, `pago`) VALUES
(17, '35443597ea41da00eb596357b067a684a15c3489f3691914b6b4ad957580b4b42ade6c0491bfb61bf0b5b40a68d9d45bc7c4', 8, '60', '2024-10-17 16:30:13', 0),
(17, 'e3d1f113ed5f8ea3d8b66976cdb28e1630c871589fbd63efa98c802e9bd63581feb0b172c13233922d75d5602bcccdf39c5a', 8, '800', '2024-10-17 16:35:02', 0),
(17, 'fc24ee798c8ed9adcf990232fd7a272fe5573a3a29671d2801cf9808426e9bc2b4702c79d948db6721cdec9a2d79eb73e426', 8, '100', '2024-10-17 16:31:39', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingressos`
--

DROP TABLE IF EXISTS `ingressos`;
CREATE TABLE IF NOT EXISTS `ingressos` (
  `id_ingresso` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `valor` float NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id_ingresso`),
  KEY `fk_id_evento` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `ingressos`
--

INSERT INTO `ingressos` (`id_ingresso`, `id_evento`, `valor`, `quantidade`) VALUES
(17, 79, 9.99, 5345);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`, `cod_ativacao`) VALUES
(1, 'Admin', 'admin@a.com', '1', 1, 1),
(8, 'pppppppp', 'jjjjrjrj', '$argon2i$v=19$m=65536,t=4,p=1$MC5mb0cwN2FnMGxzejBJag$oi63pAauxxZsuJBxVlIGPm2JImV7fUWOBipNsFKP+yM', 2, 1),
(29, 'Lazzarus', 'l@a.com', '$argon2i$v=19$m=65536,t=4,p=1$cmlMTDQuMC81WWlhUXB5Lg$iN/qRtlzKDmga4mgF0AEJC0e0C4INDPMZj2OSOkh3bU', 3, 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_id_usuario_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `info_ingressos`
--
ALTER TABLE `info_ingressos`
  ADD CONSTRAINT `fk_id_ingresso` FOREIGN KEY (`id_ingresso`) REFERENCES `ingressos` (`id_ingresso`),
  ADD CONSTRAINT `fk_id_usuario_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

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
