--
-- Structure de la table `lfv2_tournament`
--

CREATE TABLE IF NOT EXISTS `lfv2_tournament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `type` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure de la table `lfv2_tournament_match`
--

CREATE TABLE IF NOT EXISTS `lfv2_tournament_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `tour_step_id` int(11) NOT NULL,
  `team_home` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `team_visitor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `score` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_first_goal` tinyint(1) NOT NULL,
  `first_goal_min` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure de la table `lfv2_tournament_player`
--

CREATE TABLE IF NOT EXISTS `lfv2_tournament_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_step_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `group_number` int(11) NOT NULL,
  `group_position` int(11) NOT NULL,
  `tour_step_number` int(11) NOT NULL,
  `pointsA` int(11) DEFAULT NULL,
  `pointsR` int(11) DEFAULT NULL,
  `total_points` int(11) DEFAULT NULL,
  `first_goal_min` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure de la table `lfv2_tournament_step`
--

CREATE TABLE IF NOT EXISTS `lfv2_tournament_step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `opened` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Structure de la table `lfv2_tournament_vote`
--

CREATE TABLE IF NOT EXISTS `lfv2_tournament_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `tour_match_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `score` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `first_goal_min` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `lfv2_tournament_vote`
--