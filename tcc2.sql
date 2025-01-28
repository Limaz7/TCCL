-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28/01/2025 às 01:52
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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `id_usuario`, `nome_evento`, `produtora`, `descricao`, `data`, `rua`, `bairro`, `numero_residencial`, `tipo_pagamento`, `imagem`) VALUES
(2, 2, 'LINKIN PARK - 2025', 'Eventos Uruguaiana', 'SHOW DO LINKIN PARK EM URUGUAIANA 2025\r\n\r\nPrepare-se para a noite mais inesquecível de 2025! O Linkin Park, uma das maiores bandas de rock do mundo, vai fazer história em Uruguaiana, trazendo seu som único para a cidade. Não perca a oportunidade de reviver os clássicos que marcaram gerações e de experimentar um show de altíssimo nível no coração do Rio Grande do Sul. A apresentação vai rolar no dia 15 de março de 2025, no Parque de Exposições de Uruguaiana, um espaço gigantesco que vai proporcionar uma experiência épica para todos os fãs.\r\n\r\nSe você é fã de músicas como \"In the End\", \"Numb\", \"Crawling\" e muitas outras, prepare-se para uma jornada sonora que vai fazer seu coração bater no ritmo da música! O show será um mix de nostalgia, energia e uma explosão de sons que só o Linkin Park sabe oferecer.\r\n\r\nAtrações\r\n\r\nLinkin Park\r\nReviva os maiores sucessos da banda em um show único, cheio de emoção e energia. Uma viagem no tempo para as melhores músicas do rock.\r\n\r\nConvidados Especiais\r\nBandas locais de Uruguaiana e regiões próximas, prometendo um espetáculo completo e recheado de surpresas.\r\n\r\nTIPOS DE INGRESSOS\r\n\r\nMeia-entrada\r\nDesconto garantido para estudantes, idosos, professores, pessoas com deficiência e acompanhantes, além de outros grupos previstos pela legislação.\r\n\r\nIngresso Social\r\nA entrada social pode ser adquirida mediante a doação de 1kg de alimento não perecível. O ingresso será validado com a entrega do alimento na entrada do evento.\r\n\r\nInteira\r\nIngressos para qualquer pessoa, sem restrições, para quem deseja curtir o show de forma completa.\r\n\r\nPONTOS DE VENDA\r\n\r\nVenda Online\r\nAdquira seus ingressos com segurança pelo BORA!.\r\n\r\nPontos de venda físicos\r\nLoja RockStore – Rua XV de Novembro, 1200 – Centro, Uruguaiana (Segunda a Sábado, das 10h às 18h).\r\nCentro Cultural Uruguaiana – Avenida Argentina, 400 – Centro, Uruguaiana (Diariamente, das 11h às 19h).\r\n\r\nSERVIÇO\r\n\r\nShow do Linkin Park em Uruguaiana 2025\r\nLocal: Saviana\r\nData: 22 de janeiro de 2025\r\nHorário: Abertura da casa às 18h, show às 20h\r\nClassificação: 16 anos (menores de 16 anos acompanhados dos responsáveis)\r\n\r\nPrepare-se para uma noite que vai ficar para sempre na memória de todos! Vem com a gente curtir a energia do Linkin Park em Uruguaiana!', '2025-01-29 02:10:00', 'R. José Garibaldi', 'Nova Esperança', '2233', 'Pago', '678e6682df4b8.jpg'),
(3, 12, 'LUAN PEREIRA EM URUGUAIANA - 2025', 'LL eventos', 'SHOW DO LUAN PEREIRA EM URUGUAIANA 2025\r\n\r\nPrepare-se para uma noite inesquecível! O cantor Luan Pereira, um dos maiores nomes da música sertaneja, vai conquistar o público de Uruguaiana em um show que promete ser épico. Com sua voz marcante e hits que dominam as paradas de sucesso, ele trará para a cidade uma experiência musical única! O evento será no dia 10 de abril de 2025, no Clube Grêmio Tiradentes, um local incrível que proporcionará um ambiente perfeito para um show memorável.\r\n\r\nSe você é fã de músicas como “Fazendeiro”, “Dentro da Hilux” e outros sucessos do cantor, prepare-se para cantar e dançar ao som de um dos maiores talentos da música brasileira. O show será repleto de emoção, energia e a típica vibe sertaneja que só Luan Pereira sabe oferecer!\r\n\r\nAtrações\r\n\r\nLuan Pereira\r\nPrepare-se para uma noite de muito sertanejo, com os maiores sucessos de Luan Pereira. Uma viagem no tempo musical, cheia de romantismo e energia, para todos os fãs do estilo.\r\n\r\nConvidados Especiais\r\nMúsicos internacionais e talentos do estado também estarão presentes para animar a noite e garantir que o evento seja ainda mais inesquecível!\r\n\r\nTIPOS DE INGRESSOS\r\n\r\nMeia-entrada\r\nDesconto garantido para estudantes, idosos, professores, pessoas com deficiência e acompanhantes, além de outros grupos previstos pela legislação.\r\n\r\nIngresso Social\r\nAdquira sua entrada com a doação de 1kg de alimento não perecível. O ingresso será validado com a entrega do alimento na entrada do evento.\r\n\r\nInteira\r\nIngressos para qualquer pessoa, sem restrições, para quem deseja curtir o show na sua totalidade.\r\n\r\nPONTOS DE VENDA\r\n\r\nVenda Online\r\nCompre seus ingressos de forma rápida e segura pelo BORA!.\r\n\r\nPontos de venda físicos\r\nLoja Sertanejo Store – Rua XV de Novembro, 1200 – Centro, Uruguaiana (Segunda a Sábado, das 10h às 18h).\r\nCentro Cultural Uruguaiana – Avenida Argentina, 400 – Centro, Uruguaiana (Diariamente, das 11h às 19h).\r\n\r\nSERVIÇO\r\n\r\nShow do Luan Pereira em Uruguaiana 2025\r\nLocal: Clube Grêmio Tiradentes\r\nData: 10 de abril de 2025\r\nHorário: Abertura do local às 20h, show às 23h\r\nClassificação: 16 anos (menores de 16 anos acompanhados dos responsáveis)\r\n\r\nNão perca a chance de viver uma noite cheia de emoção, música boa e muita diversão! Venha curtir o melhor do sertanejo com Luan Pereira em Uruguaiana!', '2025-04-10 23:00:00', 'R. Albertino Píres', 'Cabo Luiz Quevedo', '3888', 'Pago', '6795c82c2ac84.jpg'),
(4, 2, 'Exposição artística em Uruguaiana', 'Eventos Uruguaiana', 'EXPOSIÇÃO ARTÍSTICA EM URUGUAIANA 2025\r\n\r\nPrepare-se para um mergulho no universo das artes! Uma exposição única está chegando a Uruguaiana, trazendo obras incríveis de artistas renomados e talentos emergentes. Será um encontro especial com a criatividade, a beleza e as diversas formas de expressão artística. Não perca a oportunidade de vivenciar uma experiência cultural enriquecedora no coração do Rio Grande do Sul!\r\n\r\nDATA E LOCAL\r\nA exposição acontece entre os dias 15 e 20 de março de 2025, no Teatro Municipal Rosalina Pandolfo Lisboa. Um espaço acolhedor e inspirador, perfeito para contemplar obras que falam diretamente à alma.\r\n\r\nO QUE ESPERAR?\r\n\r\nObras de Artistas Renomados: Pinturas, esculturas, fotografias e instalações de artistas que estão marcando o cenário das artes no Brasil e no mundo.\r\nTalentos Locais: Conheça os trabalhos de artistas de Uruguaiana e região, que mostram suas raízes, culturas e olhares únicos.\r\nInteratividade: Workshops e oficinas gratuitas para quem deseja despertar o artista que existe dentro de si.\r\nExperiência Gastronômica: Espaço com food trucks e bebidas para aproveitar o momento com ainda mais prazer.\r\nENTRADA GRATUITA\r\nSim, a entrada é 100% gratuita, mas é necessário adquirir um ingresso único no valor de R$ 0! Isso mesmo: R$ 0! Reserve o seu agora mesmo pelo site BORA! ou nos pontos de retirada abaixo:\r\n\r\nTeatro Municipal Rosalina Pandolfo Lisboa: R. 15 de Novembro, 1844 - Centro, Uruguaiana - RS, (Diariamente, das 10h às 18h).\r\nSesc: R. Gen. Flores da Cunha, 1984 - Centro, Uruguaiana - RS, 97501-650 (Segunda a Sábado, das 10h às 19h).\r\n\r\nExposição Artística em Uruguaiana 2025\r\nLocal: Teatro Municipal Rosalina Pandolfo Lisboa\r\nDatas: 15 a 20 de março de 2025\r\nHorários: Das 10h às 20h\r\nClassificação: Livre\r\nVenha se inspirar, se emocionar e prestigiar o mundo das artes! Convide amigos e familiares e aproveite essa oportunidade única de vivenciar cultura e beleza bem pertinho de você. Te esperamos lá!', '2025-03-15 10:00:00', 'R. 15 de Novembro', 'Centro', '1844', 'Gratuito', '6797fe80c6edb.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ingressos_cadastrados`
--

INSERT INTO `ingressos_cadastrados` (`id_ingresso`, `id_evento`, `nome_ingresso`, `desc_ingresso`, `valor`, `estoque`) VALUES
(1, 2, 'Pista - Inteira', 'Perto do palco', 200.00, 7),
(2, 2, 'Pista - Inteira | Social', 'Perto do palco', 150.00, 9),
(3, 2, 'Pista - Meia', 'Perto do palco', 100.00, 12),
(4, 3, 'Inteira', 'Perto do palco', 200.00, 8),
(5, 3, 'Meia-entrada', 'Leia da descrição do evento com atenção. perto do palco.', 100.00, 7),
(6, 3, 'Ingresso Social', 'Leia a descrição do evento com atenção. Perto do palco.', 150.00, 10),
(7, 4, 'Ingresso Unico', 'Leia a descrição do evento com atenção.', 0.00, 100);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `cadastro`, `tipo_cadastro`, `tipo_usuario`, `cod_ativacao`) VALUES
(1, 'adm', 'bora.sistema00@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$RUFZNmlsSnpzemVFb3FyRQ$2s7vKXgXySkHr9driGyHvvHDG1LGTJyXXvqii/+Mhyk', '0', 'cpf', 1, 1),
(2, 'Eventos Uruguaiana', 'eventurug@example.com', '$argon2i$v=19$m=65536,t=4,p=1$WWFwa0NvdEd4T2RjTDltRQ$/g9pQ1PbOm9pisk3QtAJW6nbfLEqcB2ufv5m/TWQ/sM', '11111111111111', 'cnpj', 3, 1),
(9, 'Joao', 'joao@example.com', '$argon2i$v=19$m=65536,t=4,p=1$L01MOVhPTFFnWk05cWZlTg$CfnJk1q2NkbeXiai12pOVZ7fsKBGV0f0QZ7SIj6/Ves', '11111111111', 'cpf', 2, 1),
(12, 'LL eventos', 'lazaro.2022315968@aluno.iffar.edu.br', '$argon2i$v=19$m=65536,t=4,p=1$ajVranZUdEp2ZGdSN3RSRQ$4TMTgthp70ZV1s8UJG6TLF6MRHeqZOvLpNUxItg3jWI', '22222222222222', 'cnpj', 3, 1);

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
