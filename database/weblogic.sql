-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07-Maio-2020 às 17:26
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
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `player_points` int(11) NOT NULL,
  `enemy_points` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1-iniciado 2-acabado',
  `started_date` datetime NOT NULL,
  `finish_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `scoreboard`
--

DROP TABLE IF EXISTS `scoreboard`;
CREATE TABLE IF NOT EXISTS `scoreboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_points` int(11) NOT NULL,
  `total_wins` int(11) NOT NULL,
  `total_loses` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `scoreboard`
--

INSERT INTO `scoreboard` (`id`, `user_id`, `total_points`, `total_wins`, `total_loses`) VALUES
(1, 1, 100, 100, 0),
(2, 2, 0, 0, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'Hashed password',
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1-normal 2-banido',
  `role` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1-user 2- admin',
  `creation_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`, `role`, `creation_date`) VALUES
(1, 'rodolfo', 'rodolfo-barreira@hotmail.com', '$2y$10$J0J12kfmioCtKqNhiznzuummBAAhqeoDakr2tB6A6WOTFRjDb.On.', '1', '2', '2020-04-17 22:35:11'),
(2, 'cidalia', 'cidalia@cidalia.pt', '$2y$10$J0J12kfmioCtKqNhiznzuummBAAhqeoDakr2tB6A6WOTFRjDb.On.', '1', '1', '2020-04-17 22:38:20'),
(3, 'tiago', 'tiago@tiago.pt', '$2y$10$J0J12kfmioCtKqNhiznzuummBAAhqeoDakr2tB6A6WOTFRjDb.On.', '2', '1', '2020-05-07 18:21:16');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD CONSTRAINT `scoreboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
