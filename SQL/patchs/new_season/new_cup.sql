update lfv2_account set cup_cagnoute = false, cup_points = 0, cup_rank = 99, stat_cup_scores = 0, stat_cup_matchs = 0, stat_cup_results = 0;
delete from lfv2_cup_vote;
delete from lfv2_cup_match;
update lfv2_cup set name = 'COUPE DU MONDE 2018';
delete from lfv2_reward;