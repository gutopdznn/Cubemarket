-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Nov-2017 às 22:15
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cubemarket`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cube_categories`
--

CREATE TABLE `cube_categories` (
  `ID` int(11) UNSIGNED NOT NULL,
  `NAME` text NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cube_categories`
--

INSERT INTO `cube_categories` (`ID`, `NAME`, `DESCRIPTION`) VALUES
(1, 'VIPs', 'Compra esses vip aqui parceiro'),
(2, 'Survival', 'Compre uns itens maneiro no servidor Survival');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cube_products`
--

CREATE TABLE `cube_products` (
  `ID` int(11) UNSIGNED NOT NULL,
  `IMAGE` text NOT NULL,
  `NAME` text NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `PRICE` double(11,2) NOT NULL,
  `CATEGORY` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cube_products`
--

INSERT INTO `cube_products` (`ID`, `IMAGE`, `NAME`, `DESCRIPTION`, `PRICE`, `CATEGORY`) VALUES
(1, 'https://i.imgur.com/5UIHFML.png', 'Unban', 'Você é desbanido do servidor', 1.00, 1),
(2, 'https://i.imgur.com/Qjk1U6T.png', 'VIP Obsidian', 'Tu ganha um vip massa', 30.00, 1),
(3, 'https://i.imgur.com/5UIHFML.png', 'Unban Survival', 'Você é desbanido do servidor survival', 10.00, 2),
(4, 'https://i.imgur.com/Qjk1U6T.png', 'VIP Obsidian', 'Tu ganha um vip massa no servidor survival', 30.00, 2),
(5, 'https://i.imgur.com/5UIHFML.png', 'Unban', 'Você é desbanido do servidor', 1.00, 1),
(6, 'https://i.imgur.com/Qjk1U6T.png', 'VIP Obsidian', 'Tu ganha um vip massa', 30.00, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cube_categories`
--
ALTER TABLE `cube_categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cube_products`
--
ALTER TABLE `cube_products`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cube_categories`
--
ALTER TABLE `cube_categories`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cube_products`
--
ALTER TABLE `cube_products`
  MODIFY `ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
