update lfv2_account set cup_cagnoute = false, cup_points = 0, cup_rank = 99;
delete from lfv2_cup_vote;
delete from lfv2_cup_match;
update lfv2_cup set name = 'EURO 2016';