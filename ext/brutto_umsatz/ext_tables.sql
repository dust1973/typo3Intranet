#
# Table structure for table 'tx_bruttoumsatz_woehrl'
#
CREATE TABLE tx_bruttoumsatz_woehrl (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,
	monat varchar(255) DEFAULT '' NOT NULL,
	laufend_w varchar(255) DEFAULT '' NOT NULL,
	vorjahr_w varchar(255) DEFAULT '' NOT NULL,
	prozent_zu_vj_w varchar(255) DEFAULT '' NOT NULL,
	laufend_s varchar(255) DEFAULT '' NOT NULL,
	vorjahr_s varchar(255) DEFAULT '' NOT NULL,
	prozent_zu_vj_s varchar(255) DEFAULT '' NOT NULL,
	prozent_zu_vj varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (uid),
	KEY parent (pid)
);



