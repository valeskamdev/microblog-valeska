-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Maio-2023 às 22:23
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `microblog-valeska`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` mediumint(9) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(150) NOT NULL,
  `texto` text NOT NULL,
  `resumo` tinytext NOT NULL,
  `imagem` varchar(45) NOT NULL,
  `usuario_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(6) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('admin','editor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(1, 'Valeska Marques', 'valeskalica@gmail.com', '$2y$10$Vpruu5ohue8vL5BnUIlOk.APAWKyMyLXivgqzaM/PlH1OtjAYhxES', 'admin'),
(3, 'Erick Felipe Oliver Fernandes', 'erick-fernandes99@origamieventos.com.br', '$2y$10$vnFIzHGOgILc/.ZfCbsrTeg1HI2Q6nLAwSnwj68UWwX0GQA6TkTqq', 'editor'),
(4, 'Andrea Rafaela Débora Silveira', 'andrea.rafaela.silveira@riscao.com.br', '$2y$10$sogfONk/jL.15soD07HB/uLZ6IPpKAEZn92PRhVmCqma9kev80Yvi', 'editor'),
(6, 'Davi Benício Leonardo da Conceição', 'davi.benicio.daconceicao@sobraer.com.br', '$2y$10$l8UASuU59iMfodE80RC5iOX.eAR66hZAR/lu9Y8wUN5TJrdinITb6', 'editor');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_noticias_usuarios` (`usuario_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_noticias_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
