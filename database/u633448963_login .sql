-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Nov-2016 às 02:03
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u633448963_login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `desc_categoria` varchar(45) CHARACTER SET latin1 NOT NULL,
  `img_categoria` varchar(60) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `desc_categoria`, `img_categoria`) VALUES
(1, 'Esgoto', 'imagens/14877257_931571500281462_1683820974_n.png'),
(2, 'Iluminacao', 'imagens/14797349_931571503614795_1539092864_n.png'),
(3, 'Buracos', 'imagens/14877110_931571506948128_89461210_n.png'),
(4, 'Lixo', 'imagens/14872427_931568953615050_336511216_n.png'),
(11, 'Teste da categoria', 'imagens/14877232_931568950281717_929677899_n.png'),
(13, 'cÃ¡tiÃ§ando', 'imagens/buraco rua.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncias`
--

CREATE TABLE `denuncias` (
  `id_den` int(11) NOT NULL,
  `data_den` datetime DEFAULT NULL,
  `desc_den` longtext CHARACTER SET latin1,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  `cat_den` int(11) NOT NULL,
  `rua_den` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  `cidade_den` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `num_den` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `user_den` int(11) NOT NULL,
  `status_den` char(1) NOT NULL DEFAULT 'A',
  `bairro_den` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `denuncias`
--

INSERT INTO `denuncias` (`id_den`, `data_den`, `desc_den`, `latitude`, `longitude`, `cat_den`, `rua_den`, `cidade_den`, `num_den`, `user_den`, `status_den`, `bairro_den`) VALUES
(1, '2016-11-10 22:22:53', 'RUAAAAAAAAAAAA', -21.225155, -50.444668, 1, 'teste rua', 'AraÃ§atuba - SP', NULL, 1, 'F', 'Alvorada'),
(2, '2016-11-10 22:22:56', 'RUAAAAAAAAAAAA', -21.225155, -50.444668, 1, 'teste rua', 'AraÃ§atuba - SP', NULL, 1, 'A', 'Alvorada'),
(3, '2016-11-12 09:14:53', 'uma descriÃ§Ã£o', -23.526621, -46.728546, 4, 'Rua Passo da PÃ¡tria, 1115 - Bela AlianÃ§a', 'SÃ£o Paulo - SP', NULL, 1, 'A', 'Bela AlianÃ§a'),
(4, '2016-11-13 09:45:02', 'denÃºncias aqui em sp', -23.526594, -46.728470, 3, 'Rua Passo da PÃ¡tria, 1115 - Bela AlianÃ§a', 'SÃ£o Paulo - SP', NULL, 1, 'A', 'Bela AlianÃ§a');

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia_img`
--

CREATE TABLE `denuncia_img` (
  `idden_img` int(11) NOT NULL,
  `deni_img` varchar(60) NOT NULL,
  `deni_den` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `denuncia_img`
--

INSERT INTO `denuncia_img` (`idden_img`, `deni_img`, `deni_den`) VALUES
(1, '../controller/imagens/1.png', 1),
(2, '../controller/imagens/2.png', 1),
(3, '../controller/imagens/3.png', 2),
(4, '../controller/imagens/4.png', 3),
(5, '../controller/imagens/5.png', 2),
(6, '../controller/imagens/6.png', 1),
(7, '../controller/imagens/7.png', 3),
(8, '../controller/imagens/8.png', 4),
(9, '../controller/imagens/9.png', 4);

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
(1, 'matheus', 'meu@email.com', '$2y$10$aFuRrxCEriCnf9HuBBmWCOkJr.v6Ms2mUnnIOfcTXg8G2ST.EB7/a', 'A'),
(2, 'usuario', 'usuariio@hotmail.com', '$2y$10$vczKngeuZdyDLzSoIYi5OeivLDgZaQvyg2qFjt3q6EplNBxc.0zam', 'U'),
(3, 'valmer', 'valmer@oi.com', '$2y$10$h1B8XT0xG2HWIVe73yQd9e.0FrL/pcuSYTfPY7oaAtj/Ez29UrIxm', 'U'),
(4, 'admin', 'vei@naboa.com', '$2y$10$Rf2xWS9/kd1uCq72fCNY/ufXP91EEu6FjP7AHzTkpWK6HBdjbHE9a', 'U'),
(5, 'taosso', 'asdasd@sdfsdf.com', '$2y$10$ev5SVBEu2eiWm9Vu2lWCfe2GiRAFIaYHJfqrsSS4lTUBc4.wtVJYG', 'U'),
(6, 'viado', 'asdh@adfsdf.com', '$2y$10$8kw0ZI7705vsCezJoXKRXelIbqDPfbuAUqDAh7VjEOnGbJfm5kgwO', 'U'),
(7, 'cansado', 'asd@sdf.com', '$2y$10$CxsJwos7sS4vRzYQXmAzSussNW7t0X6r4AFddpq..Ul.FeeLhtb2S', 'U'),
(8, 'kanejava', 'vainer', '$2y$10$e93nl.RizAgv1lgB.XaVVO2J9tJWHDyHmWSpn9hxnTQgwEm.3eDE.', 'U'),
(9, 'kanevainer', 'vainersalgado', '$2y$10$SLqFjHo.MQ8VwweT00GuoOR8VMEK2Q94D0fUppOejTHmvFKOX9I3W', 'U'),
(10, 'Matheus Crepaldi', 'matheus_crepaldi_1991@hotmail.com', '$2y$10$NJSN9V3qMMuWlWkTt/F9i.XINfWpQpoN8f570YOMYiJdmBk2JgLH2', 'U'),
(11, 'gordox', 'man@sdf.com', '$2y$10$YK/.Ab3PrEhVNBsj2nvyMOmz3qgMQnxEqbaQxlkfdaOyN02wXv/IS', 'U'),
(12, 'morri', 'adasd@sdf.com', '$2y$10$VTIW0poIxue/vx.Iiy8ZTuuJjbjqiX8W1YRoazDWTPUa2FFoniAaG', 'U'),
(13, 'livinho', 'sdfsdfsdfdsf@sdf.com', '$2y$10$bmMqUpKVJnciUJ2rQsHLZOIUvE2VAdWcCcr6jYzjghaXUp.y5PGqS', 'U'),
(14, 'login', 'login@gmail.com', '$2y$10$ROHHvg6CZFHnqozCQLaHt.i01ccwBXuC6alYas1yWzy6qyCaa./IO', 'U'),
(15, 'novousuario', 'novo@sdf.com', '$2y$10$9O7DnZAhes5dasVIispNvegjovND6S99/HT7tukSlpFzKRWk0juPS', 'U'),
(16, 'hehehe', 'assdfsfdnnbbd@sdf.com', '$2y$10$nOULrcXiSWwWGC8lKfS9T.sKnpefdpcd5SmVFnpgLZMbbsP0SQopm', 'U'),
(17, 'olhaeuaqui', 'asd@gfff.com', '$2y$10$cdE3KjfUWi0738H0z/Jyt.kDSkrNJZkk9g6k481B6rK0rrS8VMaXG', 'U'),
(18, '12345', 'teste@teste.net', '$2y$10$7AqtnZPIFMp10a5o7SYOGeAgSlLnpok.T/xcK307ll55G26MJ0lym', 'U'),
(19, 'eitaporra', 'vai@porfavr.com', '$2y$10$sXoYunGqSQZSjCppF1Ejt.kj5jzh4BVefkLyfblogRtGLU3XdM/OC', 'U'),
(20, 'ouu', 'teste@ai.com', '$2y$10$CjxU8lRUNYAPT3r64sbUCePe7mnM0yYbTmjL8Oyae.zXiSlK8ojma', 'U'),
(21, 'ookodfkpo', 'sadsddggl@g.com', '$2y$10$sQCfeZ5EWepZXn.0yqWr/eVf/RgYsDC1L.aSa6lzhyN.zocsQFfPq', 'U'),
(22, 'vaidamerdavai', '3sfdf@fg.ocm', '$2y$10$GiXjBcmHSZJmpSU6QH64uOYyBOaynd04lFuYGkY4LOqwSVNeyDVMm', 'U'),
(23, 'denuncia', 'denuncia@mail.com', '$2y$10$3IVJ1nRSuqPmOUadwAqTtO6jjpyUmHrVJT/2fq6pynEmBcvXtGYQu', 'U'),
(24, 'novo', 'novo@email.com', '$2y$10$WDAG49V8iO5I/Y.Tb7G.wuP0Igl6cg8FIgIZ7G1OEWgM4ziIymhsq', 'U'),
(25, 'vagner', 'email@vagner.com', '$2y$10$CvJ14eh0ugstM0I3Ycsp4uzqnCTPAIiClUPJlxwb2zvZG9a4Ubzha', 'U'),
(26, 'contato', 'meuemail@hotmail.com', '$2y$10$/Q3yacGPcNaT53bXgEgkEOuVLgGUwUURt6iGcenbUEGjW9LJrKWRG', 'U'),
(27, 'outro', 'teste@hotmail.com', '$2y$10$j.b498JU0ifuhk3TUNNXoOyXjlGO.fijZLlkckgoPGM/pYSz7.Gui', 'U'),
(28, 'asdvvvvv', 'wqesd@fogkfg.twwom', '$2y$10$iayRYGEmPdmFlboKQOLCZurss1v9ilI/1aCa/poXM63sWYfzcnRBO', 'U'),
(29, 'fgfg', 'sdf@dffg.ok', '$2y$10$qOblIgLP1.2M8Emeo6TkNOlmNxP9egsDkyzkEuRf8heX.p7mBI7RK', 'U'),
(30, 'nomeaqui', 'algum@email.com', '$2y$10$O5m0ejpOLJCMh1cYe5qUKOeNAcJ3vfk04zU1sLioqXf4T.GUZrMk.', 'U'),
(31, 'nome5', 'email5@mail.com', '$2y$10$TvC1MRrE9fCYVm5akYc5jOQ6XbKPqN0YLo/TPxtQ95WWXYdWvtLfi', 'U'),
(32, 'contatooo', 'qwe@hotmail.com', '$2y$10$2sh2zypUOEXavKtOREnbDuO5Fh4N989er9xEtx3r1gcM020F7rTWO', 'U'),
(33, 'testeusuario', 'email@umemail.com.br', '$2y$10$IFMM9QAQGOUzCyhFYV1tdOvtqmCAZEvknPGumFWIwKenuh9gQ025y', 'U'),
(34, 'giovanna', 'gi_terezzino@hotmail.com', '$2y$10$jb/ROTYBgNbeivjrMpnNQOm1x53fXbtmTVFys1PhpKkZkPmNoCWeW', 'U');

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
  ADD KEY `cat_den_idx` (`cat_den`),
  ADD KEY `user_den_idx` (`user_den`);

--
-- Indexes for table `denuncia_img`
--
ALTER TABLE `denuncia_img`
  ADD PRIMARY KEY (`idden_img`),
  ADD KEY `deni_den_idx` (`deni_den`);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `id_den` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `denuncia_img`
--
ALTER TABLE `denuncia_img`
  MODIFY `idden_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
