update lfv2_account set points = 0, rank = 99, progression = 0, stat_days = 0, stat_bonuses = 0, stat_results = 0, stat_scores = 0, cagnoute = 0, cup_cagnoute=0;


delete from lfv2_reward;


delete from lfv2_tournament;
delete from lfv2_tournament_match;
delete from lfv2_tournament_player;
delete from lfv2_tournament_step;
delete from lfv2_tournament_vote;

delete from lfv2_league;
delete from lfv2_league_day;
delete from lfv2_league_match;
delete from lfv2_league_vote;