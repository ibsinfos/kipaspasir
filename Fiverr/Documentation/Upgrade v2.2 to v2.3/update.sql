CREATE TABLE IF NOT EXISTS `featured` (
  `ID` bigint(20) NOT NULL auto_increment,
  `PID` bigint(20) NOT NULL default '0',
  `time` varchar(20) default NULL,
  `price` varchar(20) NOT NULL default '0',
  `PAYPAL` bigint(20) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `paypal_table2` (
  `id` int(11) NOT NULL auto_increment,
  `payer_id` varchar(60) default NULL,
  `payment_date` varchar(50) default NULL,
  `txn_id` varchar(50) default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `payer_email` varchar(75) default NULL,
  `payer_status` varchar(50) default NULL,
  `payment_type` varchar(50) default NULL,
  `memo` tinytext,
  `item_name` varchar(127) default NULL,
  `item_number` varchar(127) default NULL,
  `quantity` int(11) NOT NULL default '0',
  `mc_gross` decimal(9,2) default NULL,
  `mc_currency` char(3) default NULL,
  `address_name` varchar(255) NOT NULL default '',
  `address_street` varchar(255) NOT NULL default '',
  `address_city` varchar(255) NOT NULL default '',
  `address_state` varchar(255) NOT NULL default '',
  `address_zip` varchar(255) NOT NULL default '',
  `address_country` varchar(255) NOT NULL default '',
  `address_status` varchar(255) NOT NULL default '',
  `payer_business_name` varchar(255) NOT NULL default '',
  `payment_status` varchar(255) NOT NULL default '',
  `pending_reason` varchar(255) NOT NULL default '',
  `reason_code` varchar(255) NOT NULL default '',
  `txn_type` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `txn_id` (`txn_id`),
  KEY `txn_id_2` (`txn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
ALTER TABLE `featured` ADD `exp` INT( 1 ) NOT NULL DEFAULT '0';
INSERT INTO `config` (`setting`, `value`) VALUES ('fprice', '100'), ('fdays', '300');
UPDATE `config` SET `value` = '2.3' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;