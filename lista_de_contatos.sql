-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/07/2026 às 23:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lista_de_contatos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

CREATE TABLE `contato` (
  `id_contato` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contato`
--

INSERT INTO `contato` (`id_contato`, `nome`, `apelido`, `data_nasc`) VALUES
(1, 'Paulo Victor', 'Gut', '2009-03-16'),
(2, 'José Pedro', 'Zé ', '2002-05-16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `email`
--

CREATE TABLE `email` (
  `id_email` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `obs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `email`
--

INSERT INTO `email` (`id_email`, `id_contato`, `email`, `obs`) VALUES
(1, 1, 'paulovma281@gmail.com', 'E-mail pessoal'),
(2, 2, 'josep3dr0@gmail.com', 'E-mail pessoal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `obs` varchar(100) DEFAULT NULL,
  `ponto_ref` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `id_contato`, `logradouro`, `numero`, `cidade`, `cep`, `complemento`, `obs`, `ponto_ref`) VALUES
(1, 1, 'Rua Linux', '3145', 'Catanduva', '15983921', 'Casa', 'Casa de cor cinza com duas arvores na calçada da frente.', 'Dois quarteirões da biblioteca municipal'),
(2, 2, 'Rua Tupi ', '12', 'São Jose do Rio Preto', '19847289', 'Apartamento', 'Bloco 2 (na direita)', 'Porta branca com detalhes dourados');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rede_social`
--

CREATE TABLE `rede_social` (
  `id_rede_social` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `nome_rede_social` varchar(20) NOT NULL,
  `obs` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `rede_social`
--

INSERT INTO `rede_social` (`id_rede_social`, `id_contato`, `link`, `nome_rede_social`, `obs`) VALUES
(1, 1, 'https://instagram.com/paulogut', 'paulogut', 'Rede social privada para parentes e amigos\r\nNão use Windows 🦊'),
(2, 2, 'https://instagram.com/josepeddro', 'josepeddro', '( ❛ ͜ʖ ❛ ) Jose pedro aqui');

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone`
--

CREATE TABLE `telefone` (
  `id_telefone` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `obs` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `telefone`
--

INSERT INTO `telefone` (`id_telefone`, `id_contato`, `telefone`, `obs`) VALUES
(1, 1, '+5517987219873', 'Telefone pessoal'),
(2, 2, '+5511972838917', 'Telefone pessoal');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id_contato`);

--
-- Índices de tabela `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id_email`),
  ADD KEY `id_contato` (`id_contato`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `id_contato` (`id_contato`);

--
-- Índices de tabela `rede_social`
--
ALTER TABLE `rede_social`
  ADD PRIMARY KEY (`id_rede_social`),
  ADD KEY `id_contato` (`id_contato`);

--
-- Índices de tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`id_telefone`),
  ADD KEY `id_contato` (`id_contato`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id_contato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `email`
--
ALTER TABLE `email`
  MODIFY `id_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `rede_social`
--
ALTER TABLE `rede_social`
  MODIFY `id_rede_social` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `id_telefone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`id_contato`) REFERENCES `contato` (`id_contato`);

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_contato`) REFERENCES `contato` (`id_contato`);

--
-- Restrições para tabelas `rede_social`
--
ALTER TABLE `rede_social`
  ADD CONSTRAINT `rede_social_ibfk_1` FOREIGN KEY (`id_contato`) REFERENCES `contato` (`id_contato`);

--
-- Restrições para tabelas `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`id_contato`) REFERENCES `contato` (`id_contato`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
