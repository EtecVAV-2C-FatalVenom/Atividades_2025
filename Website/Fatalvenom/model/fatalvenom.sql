-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2025 at 04:21 AM
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
-- Table structure for table `carrinho`
--

CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `data_adicionado` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrinho`
--

INSERT INTO `carrinho` (`id`, `id_cliente`, `id_produto`, `quantidade`, `data_adicionado`) VALUES
(1, 1, 1, 2, '2025-12-01 00:19:41'),
(2, 1, 3, 1, '2025-12-01 00:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `nickname` (`nickname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `nickname`, `email`, `senha`, `telefone`) VALUES
(1, 'Maria Silvinha', 'Masilva', 'mariasilvinha@gmail.com', '$2y$10$dbIOs..m3IChpv8aJdUEBOeKOcrHaPZh4Uxg20iX8Qvbu0EfXYmHu', '119999999999'),
(2, 'Miguel emo almeida', 'Sigma boy', 'mmiguel@gmail.com', '$2y$10$FYSMxKPtvcMupG.bn.gtPe1wwrSda4VlQvSP750wkvSOtFNrpDr1O', '11435783621'),
(8, 'Michele', 'Mirtilo', 'michele@gmail.com', '$2y$10$NS9fbR97PIgiLmM9.GoecuZwkAXU5IDf7nkCnDjp.g8Gvzq3.n1P.', '12333333333333');

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` varchar(60) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(500) NOT NULL,
  `estoque` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
