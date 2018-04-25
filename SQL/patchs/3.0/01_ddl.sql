alter table lfv2_account add COLUMN groups VARCHAR(64);
update lfv2_account set groups = 'SOPRA' where username = 'Julius';
update lfv2_account set groups = 'Les_Chevreuils' where username = 'Topich';