INSERT INTO lfv2_reward (account_id, reward_id, type)
	select a.id as account_id, 17 as reward_id, 's' as type from lfv2_account a where (select count(1) from lfv2_league_history h  where h.account_id = a.id and h.points != 0 and h.season = 1 group by h.account_id) < 3 or not 
	exists( select * from lfv2_league_history h  where h.account_id = a.id and h.season = 1)
