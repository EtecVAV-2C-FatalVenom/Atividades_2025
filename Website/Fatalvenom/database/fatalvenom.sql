-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/09/2025 às 19:41
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
-- Banco de dados: `fatalvenom`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(70) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Telefone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`ID`, `Nome`, `Email`, `Senha`, `Telefone`) VALUES
(1, 'Maria Silvinha', 'mariasilvinha@gmail.com', '12345', '119999999999'),
(2, 'Miguel emo sigma', 'sigmamiguel@gmail.com', '233454', '71873426578');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionários`
--

CREATE TABLE `funcionários` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(70) NOT NULL,
  `Cargo` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionários`
--

INSERT INTO `funcionários` (`ID`, `Nome`, `Cargo`, `Email`, `Senha`) VALUES
(1, 'Aghata', 'Gerente', 'aghatanunes@gmail.com', '54321'),
(2, 'Victor Michele Mgieul', 'Admin', 'shakabungos@gmail.com', '233445');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(70) NOT NULL,
  `Descr` varchar(200) NOT NULL,
  `Imagem` varchar(1000) NOT NULL,
  `Estoque` int(11) NOT NULL,
  `Preço` decimal(10,2) NOT NULL,
  `Tag` varchar(60) NOT NULL,
  `Categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`ID`, `Nome`, `Descr`, `Imagem`, `Estoque`, `Preço`, `Tag`, `Categoria`) VALUES
(1, 'The Cropped Leather Jacket', 'Jaqueta de couro cropped preta', 'https://sdmntprwestcentralus.oaiusercontent.com/files/00000000-a274-61fb-9c7a-27da7df4a7f6/raw?se=2025-09-16T18%3A08%3A21Z&sp=r&sv=2024-08-04&sr=b&scid=3ac96400-141d-59ee-a5fc-11e5ab638aef&skoid=38550de5-1fab-49d1-9ebb-83af5557cc43&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-09-16T13%3A22%3A28Z&ske=2025-09-17T13%3A22%3A28Z&sks=b&skv=2024-08-04&sig=gNzVXIVjeltBoLbqRp5RukdAywJ6iKkNU%2Bv%2BR5lxr7o%3D', 20, 1900.00, 'Preta', 'Camisa'),
(2, 'Óculos Mugler - Spiral 01 M01', 'Óculos de sol estiloso', 'https://gm-prd-resource.gentlemonster.com/catalog/product/11G9Y2FLR5YP5/11G9Y2FLR5YP5_FRONT.jpg', 25, 450.00, 'Preto', 'Acessorios'),
(3, 'Corset Muggler Bodysuit', 'Body preto jeans', 'https://www.mytheresa.com/media/1094/1238/100/b3/P00755205.jpg', 43, 1300.00, 'Jeans', 'Camisa'),
(4, 'White Star Top', 'Camisa de manga longa com estrela no peito', 'https://fashion.mugler.com/cdn/shop/files/24F1TO0725859_1003_1.jpg?v=1750930384&width=990', 23, 200.00, 'Branca', 'Camisa'),
(5, 'Henim Body', 'Body com logo no peito', 'https://ae01.alicdn.com/kf/Hacda45ec9b114c6d85c82cf12e9320d6r.jpg', 20, 490.00, 'Multicor', 'Camisa'),
(6, 'Secret Mission Long Sleeve Top ', 'Croped manga longa', 'https://boogzelclothing.com/cdn/shop/products/SecretMissionLongSleeveTop_1_750x.jpg?v=1678903227', 45, 700.00, 'Preto', 'Camisa'),
(7, 'Body da Mugler', 'Body com sobreposição de mesh', 'https://cdn-images.farfetch-contents.com/30/85/74/97/30857497_60808947_1000.jpg', 20, 700.00, 'Colorida', 'Camisa'),
(8, 'Calça Shorts', 'Calça Shorts preta', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIuTk8uRIhnJoHe4AgfJVStob2YaY_DXnalOFaJmZLnXyHSP7I', 23, 700.00, 'Preta', 'Calça'),
(9, 'Castlebeard Cargo ', 'Calça cargo preta', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTf-fUnExpTs_4QzwhZZE4ZirE7f5Aj67zhg&s', 25, 1900.00, 'Preta', 'Calça'),
(10, 'Asymmetrical Pleated Skirt', 'Saia cinza', 'https://statics.devilinspired.com/image/cache/2024/0327/0/2e01f5d7-6ec0-5bb0-f0c0-871db1601c71-750x1000.jpg.webp', 43, 2000.00, 'Multicor', 'Calça'),
(11, 'GOTHIKA STRAPPY SKIRT', 'Saia preta', 'https://shaykawaii.com/cdn/shop/files/gotikaskirtfrontblack.jpg?v=1715797680&width=1920', 25, 1300.00, 'Preto', 'Calça'),
(12, 'Calça de retalhos', 'Calça preta e cinza com retalhos soltos', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxITEhUTExMVFRUXGBoWGBgXGR8YFxsbGxsdGhgdHhgfHSggGh8lGxcaIjEhJSktLi4uFx82ODMsNyguLi0BCgoKDQ0OFQ8QFSsZFRkrLSsrKysrLSsrKystKy0tKy0tKzcrKzctKy0rLTcrNzctNy03LS0tLSsrLSsrNy03Lf/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABgMEBQcIAgH/xABIEAACAQIEAwUFBAYHBgcBAAABAhEAAwQSITEFQVEGEyJhcQcygZGhFCNCsQhSYpLB8HKCk6LC0eFDU4Oys9IVFzNEY8PxJP/EABYBAQEBAAAAAAAAAAAAAAAAAAABAv/EABcRAQEBAQAAAAAAAAAAAAAAAAABESH/2gAMAwEAAhEDEQA/AN40pSgUpSgUpSgUpSgVA39rn', 32, 904.00, 'Preta', 'Calça'),
(13, 'Óculos Dystopian Verge', 'Óculos prata cyber ', 'blob:https://web.whatsapp.com/ac1b4026-1e12-4eb0-9c22-89fe34e2c57e', 34, 589.00, 'Prata', 'Acessorios'),
(14, 'Cinto Cyber', 'Cinto com logo estilo cyber', 'https://down-br.img.susercontent.com/file/br-11134258-7r98o-mbpr9nmbpqvt30', 12, 233.00, 'Cinto', 'Acessorios'),
(15, 'Colar Prata', 'Colar Prata com espinhos', 'https://acdn-us.mitiendanube.com/stores/002/324/473/products/0e7ca537-e3c9-4720-9273-617eab056f1a-dac27a56fdf080db6417579386636401-1024-1024.webp', 25, 298.00, 'Colar', 'Acessorios'),
(16, 'Cinto New Fashion', 'Cinto com logo cinza e detalhes', 'https://http2.mlstatic.com/D_NQ_NP_707520-CBT87168042666_072025-O-cinto-masculino-de-luxo-new-fashion-classico-em-formato-es.webp', 34, 904.00, 'Cinto', 'Acessorios'),
(17, 'Aros Gótico Dark', 'Aros Gótico Dark de colocar na orelha', 'https://http2.mlstatic.com/D_NQ_NP_813502-MLA89227450320_082025-O.webp', 12, 156.00, 'Prata', 'Acessorios');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `funcionários`
--
ALTER TABLE `funcionários`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcionários`
--
ALTER TABLE `funcionários`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
