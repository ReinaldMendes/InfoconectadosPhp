-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/11/2024 às 18:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `infoconectadosfinal`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `idAvaliacao` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idPrestador` int(11) NOT NULL,
  `estrelas` tinyint(1) NOT NULL CHECK (`estrelas` between 1 and 5),
  `comentario` text DEFAULT NULL,
  `data_avaliacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `qualServicoNecessita` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(400) NOT NULL,
  `email` varchar(100) NOT NULL,
  `prestador_id` int(11) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `sobrenome`, `data_nasc`, `endereco`, `qualServicoNecessita`, `telefone`, `senha`, `email`, `prestador_id`, `foto_perfil`) VALUES
(3, 'Reinald', 'Mendes Dos Santos', '1994-02-10', 'Guaraniacu, 295', 'pedreiro', '42991562593', '25f9e794323b453885f5181f1b624d0b', 'reinald_30_2009@hotmail.com', NULL, NULL),
(5, 'REINALD', 'DOS SANTOS', '1994-02-10', 'Rua Prudentópolis, 229', 'Borracheiro', '42991562593', '$2y$10$zIWQImO.tsrp3eK5siUGo.ZyRkD2.KP85Ym6yocyr2KiIn2HtRWPm', 'reinald_300_2009@hotmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos_servicos`
--

CREATE TABLE `fotos_servicos` (
  `idFoto` int(11) NOT NULL,
  `idPrestador` int(11) NOT NULL,
  `url_foto` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prestadores`
--

CREATE TABLE `prestadores` (
  `idPrestador` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `data_nasc` date NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prestadores`
--

INSERT INTO `prestadores` (`idPrestador`, `nome`, `sobrenome`, `data_nasc`, `endereco`, `cpf`, `telefone`, `email`, `senha`, `foto_perfil`) VALUES
(3, 'Reinald', 'Mendes Dos Santos', '1994-02-10', '2024-06-20', '08726262967', '42991562594', 'reinald_30_20092@hotmail.com', '14e1b600b1fd579f47433b88e8d85291', NULL),
(5, 'REINALD', 'DOS SANTOS', '1994-02-10', 'Rua Prudentópolis, 229', '08726262967', '42991562593', 'reinald_30_2009@hotmail.com', '14e1b600b1fd579f47433b88e8d85291', NULL),
(6, 'REINALD', 'Da silva', '1994-02-10', 'Rua Prudentópolis, 229', '08726262967', '42991562593', 'reinald_30_200009@hotmail.com', '70873e8580c9900986939611618d7b1e', NULL),
(7, 'REINALD', 'DOS SANTOS da silva', '0000-00-00', 'Rua Prudentópolis, 229', '08726262967', '42991562593', 'reeh_mendes33@yahoo.com.br', '70873e8580c9900986939611618d7b1e', NULL),
(8, 'REINALD', 'DOS SANTOS', '2024-10-10', 'Rua Prudentópolis, 229', '08726262967', '42991562593', 'reinald_3_2009@hotmail.com', '14e1b600b1fd579f47433b88e8d85291', NULL),
(9, 'REINALD', 'DOS SANTOS', '1994-02-10', 'Rua Prudentópolis, 229', '08726262967', '42991562593', 'reeh_mendees@yahoo.com.br', '14e1b600b1fd579f47433b88e8d85291', NULL),
(10, 'REINALD', 'DOS SANTOS', '1994-02-10', 'Rua Prudentópolis, 229', '08726262967', '42991562593', 'reinald_30_20009@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(11, 'REINALD', 'DOS SANTOS', '1994-02-10', 'Rua Prudentópolis, 229', '08726262967', '42991562593', 'reinald_30_29@hotmail.com', '$2y$10$g9pjE2Olkp6DDWC3/tD7newCkcpQKlBLnYXShWKgavKy/vIbFTRfW', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prestadores_clientes`
--

CREATE TABLE `prestadores_clientes` (
  `idPrestador` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema`
--

CREATE TABLE `sistema` (
  `idSistema` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `versao` varchar(20) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sistema`
--

INSERT INTO `sistema` (`idSistema`, `nome`, `versao`, `descricao`) VALUES
(1, 'InfoconectadosPHP', '1.0', 'Sistema de gestão de clientes, prestadores e usuários e clientes');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `permissoes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha`, `permissoes`) VALUES
(1, 'Administrador', 'admin@example.com', '0192023a7bbd73250516f069df18b500', 'add,edit,del,super'),
(2, 'Reinald Mendes Dos Santos', 'reinald_30_2009@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'add,edit,del,super'),
(3, 'Wilham Ville mendes dos santos', 'reinald_301_2009@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'add,');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`idAvaliacao`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idPrestador` (`idPrestador`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `prestador_id` (`prestador_id`);

--
-- Índices de tabela `fotos_servicos`
--
ALTER TABLE `fotos_servicos`
  ADD PRIMARY KEY (`idFoto`),
  ADD KEY `idPrestador` (`idPrestador`);

--
-- Índices de tabela `prestadores`
--
ALTER TABLE `prestadores`
  ADD PRIMARY KEY (`idPrestador`);

--
-- Índices de tabela `prestadores_clientes`
--
ALTER TABLE `prestadores_clientes`
  ADD PRIMARY KEY (`idPrestador`,`idCliente`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Índices de tabela `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`idSistema`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `idAvaliacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `fotos_servicos`
--
ALTER TABLE `fotos_servicos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prestadores`
--
ALTER TABLE `prestadores`
  MODIFY `idPrestador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `sistema`
--
ALTER TABLE `sistema`
  MODIFY `idSistema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`idPrestador`) REFERENCES `prestadores` (`idPrestador`);

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`prestador_id`) REFERENCES `prestadores` (`idPrestador`);

--
-- Restrições para tabelas `fotos_servicos`
--
ALTER TABLE `fotos_servicos`
  ADD CONSTRAINT `fotos_servicos_ibfk_1` FOREIGN KEY (`idPrestador`) REFERENCES `prestadores` (`idPrestador`);

--
-- Restrições para tabelas `prestadores_clientes`
--
ALTER TABLE `prestadores_clientes`
  ADD CONSTRAINT `prestadores_clientes_ibfk_1` FOREIGN KEY (`idPrestador`) REFERENCES `prestadores` (`idPrestador`),
  ADD CONSTRAINT `prestadores_clientes_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
