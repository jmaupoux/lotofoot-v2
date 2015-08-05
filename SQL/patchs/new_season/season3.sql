--self_bonus
ALTER TABLE `lfv2_league_vote` ADD `self_bonus` tinyint(1) NOT NULL DEFAULT 0 ;

ALTER TABLE `lfv2_league_history` ADD `has_self_bonus` tinyint(1) NOT NULL DEFAULT 0 ;