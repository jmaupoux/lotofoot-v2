--accounts
update lfv2_account set points = 0, rank = 99, progression = 0, stat_days = 0, stat_bonuses = 0, stat_results = 0, stat_scores = 0, cagnoute = 0;

--history
ALTER TABLE `lfv2_league_history` ADD `season` INT NULL ;
update lfv2_league_history set season = 1;

--rewards
delete from lfv2_reward

--C1
delete from lfv2_tournament
delete from lfv2_tournament_history
delete from lfv2_tournament_match
delete from lfv2_tournament_player
delete from lfv2_tournament_step
delete from lfv2_tournament_vote

--league
delete from lfv2_league
delete from lfv2_league_day
delete from lfv2_league_match
delete from lfv2_league_vote