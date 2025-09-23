-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2025 at 10:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fatalvenom`
--
CREATE DATABASE IF NOT EXISTS `fatalvenom` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fatalvenom`;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `nickname`, `email`, `senha`, `telefone`) VALUES
(1, 'Maria Silvinha', 'Masilva', 'mariasilvinha@gmail.com', '$2y$10$dbIOs..m3IChpv8aJdUEBOeKOcrHaPZh4Uxg20iX8Qvbu0EfXYmHu', '119999999999'),
(2, 'Miguel emo almeida', 'Sigma boy', 'mmiguel@gmail.com', '$2y$10$FYSMxKPtvcMupG.bn.gtPe1wwrSda4VlQvSP750wkvSOtFNrpDr1O', '11435783621'),
(8, 'Michele', 'Mirtilo', 'michele@gmail.com', '$2y$10$q/0U.OazJUgnOzX/Q.A8eO.wsecqU4RreYma0u7GgSNtoqO8WSnNq', '12333333333333');

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `nome`, `email`, `senha`, `cargo`) VALUES
(1, 'Sona', 'legendsofruneterra@gmail.com', '$2y$10$lTcFSYsMf0tuMTkRNp9qjee/wstv8tjys92rPGORenaRwbQzfLGIW', 'Gerente'),
(2, 'Victor', 'victor@gmail.com', '$2y$10$flcawjqxudL4kHYkat6hreti4apvc9kEFXBYb7JkCiRBSkHyqqTxi', 'Administrador'),
(6, 'naty', 'naty@gmail.com', '$2y$10$6bqjdgAb2L3pcysSO48T6uelfaZ/G44daQUJu1Dp69oBVrYfUFasC', 'Funcionario');

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `estoque` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `preco`, `imagem`, `estoque`, `categoria`) VALUES
(1, 'The Cropped Leather Jacket', '', 1900.00, 'https://www.mytheresa.com/media/1094/1238/100/dd/P00846562.jpg', 0, 'Camisa'),
(2, 'Óculos Mugler - Spiral 01 M01', 'Óculos de sol estiloso', 450.00, 'https://gm-prd-resource.gentlemonster.com/catalog/product/11G9Y2FLR5YP5/11G9Y2FLR5YP5_FRONT.jpg', 25, 'Acessorios'),
(3, 'Corset Muggler Bodysuit', 'Body preto jeans', 1300.00, 'https://www.mytheresa.com/media/1094/1238/100/b3/P00755205.jpg', 43, 'Camisa'),
(4, 'White Star Top', 'Camisa de manga longa com estrela no peito', 200.00, 'https://fashion.mugler.com/cdn/shop/files/24F1TO0725859_1003_1.jpg?v=1750930384&width=990', 23, 'Camisa'),
(5, 'Henim Body', 'Body com logo no peito', 490.00, 'https://ae01.alicdn.com/kf/Hacda45ec9b114c6d85c82cf12e9320d6r.jpg', 20, 'Camisa'),
(6, 'Secret Mission Long Sleeve Top ', 'Croped manga longa', 700.00, 'https://boogzelclothing.com/cdn/shop/products/SecretMissionLongSleeveTop_1_750x.jpg?v=1678903227', 45, 'Camisa'),
(7, 'Body da Mugler', 'Body com sobreposição de mesh', 700.00, 'https://cdn-images.farfetch-contents.com/30/85/74/97/30857497_60808947_1000.jpg', 20, 'Camisa'),
(8, 'Calça Shorts', 'Calça Shorts preta', 700.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIuTk8uRIhnJoHe4AgfJVStob2YaY_DXnalOFaJmZLnXyHSP7I', 23, 'Calça'),
(9, 'Castlebeard Cargo ', 'Calça cargo preta', 1900.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTf-fUnExpTs_4QzwhZZE4ZirE7f5Aj67zhg&s', 25, 'Calça'),
(10, 'Asymmetrical Pleated Skirt', 'Saia cinza', 2000.00, 'https://statics.devilinspired.com/image/cache/2024/0327/0/2e01f5d7-6ec0-5bb0-f0c0-871db1601c71-750x1000.jpg.webp', 43, 'Calça'),
(11, 'GOTHIKA STRAPPY SKIRT', 'Saia preta', 1300.00, 'https://shaykawaii.com/cdn/shop/files/gotikaskirtfrontblack.jpg?v=1715797680&width=1920', 25, 'Calça'),
(12, 'Calça de retalhos', 'Calça preta e cinza com retalhos soltos', 904.00, 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxITEhUTExMVFRUXGBoWGBgXGR8YFxsbGxsdGhgdHhgfHSggGh8lGxcaIjEhJSktLi4uFx82ODMsNyguLi0BCgoKDQ0OFQ8QFSsZFRkrLSsrKysrLSsrKystKy0tKy0tKzcrKzctKy0rLTcrNzctNy03LS0tLSsrLSsrNy03Lf/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABgMEBQcIAgH/xABIEAACAQIEAwUFBAYHBgcBAAABAhEAAwQSITEFQVEGEyJhcQcygZGhFCNCsQhSYpLB8HKCk6LC0eFDU4Oys9IVFzNEY8PxJP/EABYBAQEBAAAAAAAAAAAAAAAAAAABAv/EABcRAQEBAQAAAAAAAAAAAAAAAAABESH/2gAMAwEAAhEDEQA/AN40pSgUpSgUpSgUpSgVA39rn', 32, 'Calça'),
(13, 'Óculos Dystopian Verge', 'Óculos prata cyber ', 589.00, 'https://i.pinimg.com/736x/69/73/9e/69739ea9d42b93c3db6c1290496c52d0.jpg', 34, 'Acessorios'),
(14, 'Cinto Cyber', 'Cinto com logo estilo cyber', 233.00, 'https://down-br.img.susercontent.com/file/br-11134258-7r98o-mbpr9nmbpqvt30', 12, 'Acessorios'),
(15, 'Colar Prata', 'Colar Prata com espinhos', 298.00, 'https://acdn-us.mitiendanube.com/stores/002/324/473/products/0e7ca537-e3c9-4720-9273-617eab056f1a-dac27a56fdf080db6417579386636401-1024-1024.webp', 25, 'Acessorios'),
(16, 'Cinto New Fashion', 'Cinto com logo cinza e detalhes', 904.00, 'https://http2.mlstatic.com/D_NQ_NP_707520-CBT87168042666_072025-O-cinto-masculino-de-luxo-new-fashion-classico-em-formato-es.webp', 34, 'Acessorios'),
(17, 'Aros Gótico Dark', 'Aros Gótico Dark de colocar na orelha', 156.00, 'https://http2.mlstatic.com/D_NQ_NP_813502-MLA89227450320_082025-O.webp', 12, 'Acessorios'),
(18, 'Calça baggy', 'Calça baggy preta', 845.00, 'https://ae01.alicdn.com/kf/S5ece349f69154689bd62fd5e4d931f1bt.jpg', 34, 'Calça');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
