-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 14-Fev-2022 às 14:37
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuarioId` int(11) NOT NULL,
  `nome` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(170) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuarioId`, `nome`, `email`, `senha`) VALUES
(43, 'Lucio', 'luciobobinho89897aaa@gmail.com', '$2y$10$b8nNrBAYElvtEA3WZUFP5eEi/aDhQfvVDd94AnF1D1qvV2XjoDGUG'),
(44, 'Maely', 'maelyly@gmail.com', '$2y$10$gfkHUsx0EBgtKVR7gu9ja.SFXUKE3hnvJNYEBXm2KCIPDGo1GXdiu'),
(71, 'David', 'davimergenerm@gmail.com', '$2y$10$eGmwVeR0spaIEVsiZmkj5.29Izxarp2rw76k4qi1Q1n0xIYWH0mNm');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioId`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
