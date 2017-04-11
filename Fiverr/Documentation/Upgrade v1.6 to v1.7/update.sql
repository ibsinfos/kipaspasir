DROP TABLE `inbox_reports`;
CREATE TABLE IF NOT EXISTS `inbox_reports` (
  `RID` bigint(20) NOT NULL auto_increment,
  `MID` bigint(20) NOT NULL default '0',
  `USERID` bigint(20) NOT NULL default '0',
  `time` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`RID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `inbox_reports` ADD UNIQUE (`MID` ,`USERID`);
INSERT INTO `config` (`setting` ,`value`)VALUES ('vonly', '0');
UPDATE `config` SET `value` = '1.7' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;