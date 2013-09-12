INSERT INTO `lfv2_account` (`id`, `username`, `password`, `email`, `salt`, `is_active`, `is_admin`) VALUES
(1, 'julien', 'julien', 'julien@gmail.com', '', 1, 1);

INSERT INTO `lfv2_league` (`id`, `number`, `currentDay`, `name`, `state`) VALUES
(1, 1, 0, 's1', 1);

INSERT INTO `lfv2_league_day` (`id`, `number`, `league_id`, `deadline`, `corrected`) VALUES
(1, 1, 1, '2014-12-13 16:59:00', 0);

INSERT INTO `lfv2_league_match` (`id`, `number`, `league_day_id`, `team_home`, `team_visitor`, `bonus`, `score`, `result`) VALUES
(1, 1, 1, 'fsdfdf', 'sdfsdf', 1, '', ''),
(2, 2, 1, 'fsdf', 'fsdfds', 0, '', ''),
(3, 3, 1, 'fsdfdsf', 'ffdsfds', 0, '', ''),
(4, 4, 1, 'sdfsdf', 'sdfdsf', 0, '', ''),
(5, 5, 1, 'sfdfs', 'dsfsdf', 0, '', ''),
(6, 6, 1, 'sdfsdf', 'sdfsdf', 0, '', ''),
(7, 7, 1, 'sdfsdf', 'sdfdsf', 0, '', ''),
(8, 8, 1, 'sdfsdf', 'sdfsdf', 0, '', ''),
(9, 9, 1, 'sdfsdf', 'sdfsdf', 0, '', ''),
(10, 10, 1, 'sdfsdf', 'sdfsdf', 0, '', ''),
(11, 11, 1, 'sdfsdf', 'sdfsdf', 0, '', ''),
(12, 12, 1, 'sdfsdf', 'sdfsdf', 0, '', ''),
(13, 13, 1, 'sdfsdf', 'sdfsdf', 0, '', '');