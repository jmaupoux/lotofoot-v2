-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 23 Septembre 2013 à 22:03
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lotofootv2`
--
CREATE DATABASE IF NOT EXISTS `lotofootv2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lotofootv2`;

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_account`
--

CREATE TABLE IF NOT EXISTS `lfv2_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `points` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `progression` int(11) NOT NULL,
  `stat_days` int(11) NOT NULL,
  `stat_bonuses` int(11) NOT NULL,
  `stat_results` int(11) NOT NULL,
  `stat_scores` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `lfv2_account`
--

INSERT INTO `lfv2_account` (`id`, `username`, `password`, `email`, `salt`, `is_active`, `is_admin`, `points`, `rank`, `progression`, `stat_days`, `stat_bonuses`, `stat_results`, `stat_scores`) VALUES
(1, 'admin', 'admin', 'admin@mail.com', '', 1, 1, 0, 0, 99, 0, 0, 0, 0),
(2, 'user', 'user', 'user@mail.com', '', 1, 0, 0, 99, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_league`
--

CREATE TABLE IF NOT EXISTS `lfv2_league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `currentDay` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opened` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `lfv2_league`
--

INSERT INTO `lfv2_league` (`id`, `number`, `currentDay`, `name`, `opened`) VALUES
(1, 1, 0, 'League test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_league_day`
--

CREATE TABLE IF NOT EXISTS `lfv2_league_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `league_id` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `corrected` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `lfv2_league_day`
--

INSERT INTO `lfv2_league_day` (`id`, `number`, `league_id`, `deadline`, `corrected`) VALUES
(1, 1, 1, '2014-12-13 20:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_league_history`
--

CREATE TABLE IF NOT EXISTS `lfv2_league_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `league_day_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `total_points` int(11) NOT NULL,
  `voted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_league_match`
--

CREATE TABLE IF NOT EXISTS `lfv2_league_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `league_day_id` int(11) NOT NULL,
  `team_home` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team_visitor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonus` tinyint(1) NOT NULL,
  `score` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `lfv2_league_match`
--

INSERT INTO `lfv2_league_match` (`id`, `number`, `league_day_id`, `team_home`, `team_visitor`, `bonus`, `score`, `result`) VALUES
(1, 1, 1, 'dom', 'ext', 1, NULL, NULL),
(2, 2, 1, 'dom', 'ext', 0, NULL, NULL),
(3, 3, 1, 'dom', 'ext', 0, NULL, NULL),
(4, 4, 1, 'dom', 'ext', 0, NULL, NULL),
(5, 5, 1, 'dom', 'ext', 0, NULL, NULL),
(6, 6, 1, 'dom', 'ext', 0, NULL, NULL),
(7, 7, 1, 'dom', 'ext', 0, NULL, NULL),
(8, 8, 1, 'dom', 'ext', 0, NULL, NULL),
(9, 9, 1, 'dom', 'ext', 0, NULL, NULL),
(10, 10, 1, 'dom', 'ext', 0, NULL, NULL),
(11, 11, 1, 'dom', 'ext', 0, NULL, NULL),
(12, 12, 1, 'dom', 'ext', 0, NULL, NULL),
(13, 13, 1, 'dom', 'ext', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_league_vote`
--

CREATE TABLE IF NOT EXISTS `lfv2_league_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `league_match_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `score` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_news`
--

CREATE TABLE IF NOT EXISTS `lfv2_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lfv2_reward`
--

CREATE TABLE IF NOT EXISTS `lfv2_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `type` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
