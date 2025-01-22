-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22/01/2025 às 04:09
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
-- Estrutura para tabela `carrinhos`
--

DROP TABLE IF EXISTS `carrinhos`;
CREATE TABLE IF NOT EXISTS `carrinhos` (
  `id_carrinho` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `ticket` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantidade` int NOT NULL,
  `data` datetime NOT NULL,
  `estoque` int NOT NULL,
  `ingresso_valor` decimal(10,2) NOT NULL,
  `cart_total` decimal(10,2) NOT NULL,
  `cart_session` int NOT NULL,
  `pago` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  KEY `fk_id_usuario_2` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho_ingressos_cadastrados`
--

DROP TABLE IF EXISTS `carrinho_ingressos_cadastrados`;
CREATE TABLE IF NOT EXISTS `carrinho_ingressos_cadastrados` (
  `id_carrinho_ingressos_cadastrados` int NOT NULL AUTO_INCREMENT,
  `id_carrinho` int NOT NULL,
  `id_ingresso` int NOT NULL,
  PRIMARY KEY (`id_carrinho_ingressos_cadastrados`),
  KEY `fk_id_ingresso` (`id_ingresso`),
  KEY `fk_id_carrinho` (`id_carrinho`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `nome_evento` varchar(255) NOT NULL,
  `produtora` varchar(50) NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `data` datetime NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `numero_residencial` char(4) NOT NULL,
  `tipo_pagamento` enum('Gratuito','Pago','Cesta Básica') NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fk_id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nome_evento`, `produtora`, `descricao`, `data`, `rua`, `bairro`, `numero_residencial`, `tipo_pagamento`, `imagem`) VALUES
(2, 2, 'LINKIN PARK - 2025', 'Eventos Uruguaiana', 'SHOW DO LINKIN PARK EM URUGUAIANA 2025\r\n\r\nPrepare-se para a noite mais inesquecível de 2025! O Linkin Park, uma das maiores bandas de rock do mundo, vai fazer história em Uruguaiana, trazendo seu som único para a cidade. Não perca a oportunidade de reviver os clássicos que marcaram gerações e de experimentar um show de altíssimo nível no coração do Rio Grande do Sul. A apresentação vai rolar no dia 15 de março de 2025, no Parque de Exposições de Uruguaiana, um espaço gigantesco que vai proporcionar uma experiência épica para todos os fãs.\r\n\r\nSe você é fã de músicas como \"In the End\", \"Numb\", \"Crawling\" e muitas outras, prepare-se para uma jornada sonora que vai fazer seu coração bater no ritmo da música! O show será um mix de nostalgia, energia e uma explosão de sons que só o Linkin Park sabe oferecer.\r\n\r\nAtrações\r\n\r\nLinkin Park\r\nReviva os maiores sucessos da banda em um show único, cheio de emoção e energia. Uma viagem no tempo para as melhores músicas do rock.\r\n\r\nConvidados Especiais\r\nBandas locais de Uruguaiana e regiões próximas, prometendo um espetáculo completo e recheado de surpresas.\r\n\r\nTIPOS DE INGRESSOS\r\n\r\nMeia-entrada\r\nDesconto garantido para estudantes, idosos, professores, pessoas com deficiência e acompanhantes, além de outros grupos previstos pela legislação.\r\n\r\nIngresso Social\r\nA entrada social pode ser adquirida mediante a doação de 1kg de alimento não perecível. O ingresso será validado com a entrega do alimento na entrada do evento.\r\n\r\nInteira\r\nIngressos para qualquer pessoa, sem restrições, para quem deseja curtir o show de forma completa.\r\n\r\nPONTOS DE VENDA\r\n\r\nVenda Online\r\nAdquira seus ingressos com segurança pelo BORA!.\r\n\r\nPontos de venda físicos\r\nLoja RockStore – Rua XV de Novembro, 1200 – Centro, Uruguaiana (Segunda a Sábado, das 10h às 18h).\r\nCentro Cultural Uruguaiana – Avenida Argentina, 400 – Centro, Uruguaiana (Diariamente, das 11h às 19h).\r\n\r\nSERVIÇO\r\n\r\nShow do Linkin Park em Uruguaiana 2025\r\nLocal: Saviana\r\nData: 22 de janeiro de 2025\r\nHorário: Abertura da casa às 18h, show às 20h\r\nClassificação: 16 anos (menores de 16 anos acompanhados dos responsáveis)\r\n\r\nPrepare-se para uma noite que vai ficar para sempre na memória de todos! Vem com a gente curtir a energia do Linkin Park em Uruguaiana!', '2025-01-22 02:10:00', 'José Garibaldi', 'Nova Esperança', '2233', 'Pago', '678e6682df4b8.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingressos_cadastrados`
--

DROP TABLE IF EXISTS `ingressos_cadastrados`;
CREATE TABLE IF NOT EXISTS `ingressos_cadastrados` (
  `id_ingresso` int NOT NULL AUTO_INCREMENT,
  `id_evento` int NOT NULL,
  `nome_ingresso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `desc_ingresso` varchar(255) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `estoque` int NOT NULL,
  PRIMARY KEY (`id_ingresso`),
  KEY `fk_id_evento` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ingressos_cadastrados`
--

INSERT INTO `ingressos_cadastrados` (`id_ingresso`, `id_evento`, `nome_ingresso`, `desc_ingresso`, `valor`, `estoque`) VALUES
(1, 2, 'Pista - Inteira', 'Perto do palco', 200.00, 10),
(2, 2, 'Pista - Inteira | Social', 'Perto do palco', 150.00, 10),
(3, 2, 'Pista - Meia', 'Perto do palco', 100.00, 10);

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
  UNIQUE KEY `token` (`token`)
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tipos_usuario`
--

INSERT INTO `tipos_usuario` (`id_tipo_usuario`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Participante'),
(3, 'Organizador');

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
  `cadastro` char(14) NOT NULL,
  `tipo_cadastro` enum('cpf','cnpj') NOT NULL,
  `tipo_usuario` int NOT NULL,
  `cod_ativacao` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_tipo_usuario` (`tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `cadastro`, `tipo_cadastro`, `tipo_usuario`, `cod_ativacao`) VALUES
(1, 'adm', 'adm@example.com', '$argon2i$v=19$m=65536,t=4,p=1$RUFZNmlsSnpzemVFb3FyRQ$2s7vKXgXySkHr9driGyHvvHDG1LGTJyXXvqii/+Mhyk', '0', 'cpf', 1, 1),
(2, 'Eventos Uruguaiana', 'eventurug@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WWFwa0NvdEd4T2RjTDltRQ$/g9pQ1PbOm9pisk3QtAJW6nbfLEqcB2ufv5m/TWQ/sM', '11111111111111', 'cnpj', 3, 1),
(3, 'Lázaro', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$cjRobjlDUzJNd3VQOHdXMQ$RtKeF2M4TquNl8/kBwG0yyOl83NyGz2x23T3hgl1YfE', '11111111111', 'cpf', 2, 1);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinhos`
--
ALTER TABLE `carrinhos`
  ADD CONSTRAINT `fk_id_usuario_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `carrinho_ingressos_cadastrados`
--
ALTER TABLE `carrinho_ingressos_cadastrados`
  ADD CONSTRAINT `fk_id_carrinho` FOREIGN KEY (`id_carrinho`) REFERENCES `carrinhos` (`id_carrinho`),
  ADD CONSTRAINT `fk_id_ingresso` FOREIGN KEY (`id_ingresso`) REFERENCES `ingressos_cadastrados` (`id_ingresso`);

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `ingressos_cadastrados`
--
ALTER TABLE `ingressos_cadastrados`
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
