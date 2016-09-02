-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 02-Set-2016 às 05:43
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u633448963_login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `desc_categoria` varchar(45) NOT NULL,
  `img_categoria` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `desc_categoria`, `img_categoria`) VALUES
(31, 'matheus', 'imagens/Penguins.jpg'),
(28, 'haha', 'imagens/alguma.png'),
(29, 'eitaaaa', 'imagens/alguma.png'),
(30, 'buracos ', 'imagens/Chrysanthemum.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncias`
--

CREATE TABLE `denuncias` (
  `id_den` int(11) NOT NULL,
  `data_den` datetime DEFAULT NULL,
  `desc_den` longtext,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  `user_den` int(11) DEFAULT NULL,
  `cat_den` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `denuncias`
--

INSERT INTO `denuncias` (`id_den`, `data_den`, `desc_den`, `latitude`, `longitude`, `user_den`, `cat_den`) VALUES
(1, NULL, NULL, -21.237650, -50.407021, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_tipo` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'U'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_tipo`) VALUES
(1, 'matheus', 'meu@email.com', '$2y$10$c17AxgVrMu69RFVhoSGrp.t2UFLdz198PElfCFCL9zfZJHELfM6Wq', 'A'),
(2, 'usuario', 'usuariio@hotmail.com', '$2y$10$vczKngeuZdyDLzSoIYi5OeivLDgZaQvyg2qFjt3q6EplNBxc.0zam', 'U'),
(3, 'valmer', 'valmer@oi.com', '$2y$10$h1B8XT0xG2HWIVe73yQd9e.0FrL/pcuSYTfPY7oaAtj/Ez29UrIxm', 'U'),
(4, 'admin', 'vei@naboa.com', '$2y$10$Rf2xWS9/kd1uCq72fCNY/ufXP91EEu6FjP7AHzTkpWK6HBdjbHE9a', 'U'),
(5, 'taosso', 'asdasd@sdfsdf.com', '$2y$10$ev5SVBEu2eiWm9Vu2lWCfe2GiRAFIaYHJfqrsSS4lTUBc4.wtVJYG', 'U'),
(6, 'viado', 'asdh@adfsdf.com', '$2y$10$8kw0ZI7705vsCezJoXKRXelIbqDPfbuAUqDAh7VjEOnGbJfm5kgwO', 'U'),
(7, 'cansado', 'asd@sdf.com', '$2y$10$CxsJwos7sS4vRzYQXmAzSussNW7t0X6r4AFddpq..Ul.FeeLhtb2S', 'U'),
(8, 'kanejava', 'vainer', '$2y$10$e93nl.RizAgv1lgB.XaVVO2J9tJWHDyHmWSpn9hxnTQgwEm.3eDE.', 'U'),
(9, 'kanevainer', 'vainersalgado', '$2y$10$SLqFjHo.MQ8VwweT00GuoOR8VMEK2Q94D0fUppOejTHmvFKOX9I3W', 'U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`id_den`),
  ADD KEY `user_den_idx` (`user_den`),
  ADD KEY `cat_den_idx` (`cat_den`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
