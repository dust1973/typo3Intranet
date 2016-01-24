#
# Table structure for table 'tx_SBumfrage_list'
#
CREATE TABLE tx_SBumfrage_list (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) unsigned DEFAULT '0' NOT NULL,
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(10) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	title tinytext NOT NULL,
	question text NOT NULL,
	answers text NOT NULL,
	votes int(11) DEFAULT '0' NOT NULL,
	pages blob NOT NULL,
	keyword varchar(255) DEFAULT '' NOT NULL,
	keyword2 tinytext NOT NULL,
	keyword3 tinytext NOT NULL,
	
	PRIMARY KEY (uid),
	KEY parent (pid)
);