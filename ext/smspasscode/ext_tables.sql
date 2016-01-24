#
# Table structure for table 'tx_smspasscode_log'
#
CREATE TABLE tx_smspasscode_log (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	starttime int(11) DEFAULT '0' NOT NULL,
	endtime int(11) DEFAULT '0' NOT NULL,
	fe_group int(11) DEFAULT '0' NOT NULL,
	benutzername text,
	log text,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);