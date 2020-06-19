-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 19-Jun-2020 às 00:14
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `weblogic`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `player_points` int(11) NOT NULL DEFAULT 0,
  `enemy_points` int(11) NOT NULL DEFAULT 0,
  `point_1` tinyint(4) NOT NULL DEFAULT 0,
  `point_2` tinyint(4) NOT NULL DEFAULT 0,
  `point_3` tinyint(4) NOT NULL DEFAULT 0,
  `point_4` tinyint(4) NOT NULL DEFAULT 0,
  `point_5` tinyint(4) NOT NULL DEFAULT 0,
  `point_6` tinyint(4) NOT NULL DEFAULT 0,
  `point_7` tinyint(4) NOT NULL DEFAULT 0,
  `point_8` tinyint(4) NOT NULL DEFAULT 0,
  `point_9` tinyint(4) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1-iniciado 2-acabado',
  `started_date` datetime NOT NULL DEFAULT current_timestamp(),
  `finish_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `games`
--

INSERT INTO `games` (`id`, `id_user`, `player_points`, `enemy_points`, `point_1`, `point_2`, `point_3`, `point_4`, `point_5`, `point_6`, `point_7`, `point_8`, `point_9`, `status`, `started_date`, `finish_date`) VALUES
(1, 1, 45, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, '2020-06-18 22:00:22', '2020-06-18 19:00:00'),
(2, 1, 28, 0, 1, 0, 1, 1, 1, 0, 1, 1, 0, 2, '2020-06-18 22:03:37', '2020-06-18 21:49:24'),
(10, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2020-06-18 22:53:12', NULL),
(15, 1, 9, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 2, '2020-06-18 22:57:56', '2020-06-18 22:54:01'),
(17, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, 1, 2, '2020-06-18 23:57:01', '2020-06-18 23:01:24'),
(21, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2020-06-19 00:04:31', '2020-06-18 23:09:10'),
(28, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2020-06-19 00:10:44', '2020-06-18 23:20:12'),
(29, 1, 31, 0, 1, 1, 0, 1, 0, 0, 1, 1, 1, 2, '2020-06-19 00:20:44', NULL),
(31, 1, 26, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 2, '2020-06-19 00:58:54', '2020-06-19 00:00:50'),
(32, 16, 19, 0, 1, 1, 1, 0, 0, 1, 1, 0, 0, 2, '2020-06-19 01:02:35', '2020-06-19 00:03:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `scoreboards`
--

DROP TABLE IF EXISTS `scoreboards`;
CREATE TABLE IF NOT EXISTS `scoreboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_points` int(11) NOT NULL DEFAULT 0,
  `total_wins` int(11) NOT NULL DEFAULT 0,
  `total_loses` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `scoreboards`
--

INSERT INTO `scoreboards` (`id`, `user_id`, `total_points`, `total_wins`, `total_loses`) VALUES
(1, 1, 163, 106, 0),
(2, 2, 100, 0, 100),
(3, 16, 19, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `nome_completo` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'Hashed password',
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1-normal 2-banido',
  `role` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1-user 2- admin',
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `nome_completo`, `birthday`, `email`, `password`, `status`, `role`, `creation_date`) VALUES
(1, 'rodolfo', 'Rodolfo Barreira', '1998-03-31', 'rodolfo-barreira@hotmail.com', '$2y$10$dC/B1aptb6.ds7gWdpNNgeOF4kmnV4.wK2qqpWp3lLYXgv4sLXNXW', '1', '2', '2020-04-17 22:35:11'),
(2, 'cidalia', 'Cidï¿½lia Pinto', '1998-03-31', 'cidalia@cidalia.pt', '$2y$10$qCLI4omgVdBX9CoL.MiAeOPoDUz7RIAjKdEukdFQ25PSQEWqtUUFe', '1', '2', '2020-04-17 22:38:20'),
(3, 'tiago', 'Tiago Santos', '1998-03-31', 'tiago@tiago.pt', '$2y$10$94eYkvVp79lhJjAqLtHa.OC06SGY4ZaMFaT/PzDdf.sW1EANc7TeO', '2', '1', '2020-05-07 18:21:16'),
(14, 'Novo_user', 'Novo utilizador', '1998-03-31', 'Email@teste.pt', '$2y$10$ruT4WpU1Cd.tYTiqKG/REOJEqqfoF.c/N7A/j5DEhP/UjlQq.BmuK', '2', '1', '2020-06-10 15:05:26'),
(15, 'Novo_user123', 'Novo utilizador123', '1998-03-12', 'asdiop0ada@teste.pt', '$2y$10$x.tgm8/QUhTGtvyXFMgotORxyulzF6efU/iqDcpSBKfeqigsNJ3Ey', '2', '1', '2020-06-10 17:59:46'),
(16, 'rodolfocidalia', 'UTILIZADOR DE TESTE EDITADO', '1998-03-03', 'teste@teste_teste.pt', '$2y$10$oWRiTBeCS1v9hglroRvyU.ExUr4/TNnN520lu5DUFoz6z4zopaZ8.', '1', '1', '2020-06-19 01:02:21');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `scoreboards`
--
ALTER TABLE `scoreboards`
  ADD CONSTRAINT `scoreboards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
