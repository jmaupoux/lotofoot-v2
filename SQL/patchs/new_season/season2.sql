ALTER TABLE `lfv2_account` ADD `wins_league` INT NULL;
ALTER TABLE `lfv2_account` ADD `wins_cup` INT NULL;
ALTER TABLE `lfv2_account` ADD `wins_cl` INT NULL;
ALTER TABLE `lfv2_account` ADD `team` VARCHAR(16) NULL ;


ALTER TABLE `lfv2_league_history` ADD `season` INT NULL ;
ALTER TABLE `lfv2_league_history` ADD `detail` VARCHAR(32) ;
update lfv2_league_history set season = 1;


ALTER TABLE `lfv2_league_match` ADD `deadline` TIMESTAMP NOT NULL ;
