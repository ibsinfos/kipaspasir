INSERT INTO `config` (`setting`, `value`) VALUES ('commission_percent', '20');
CREATE TABLE IF NOT EXISTS `packs` (
  `ID` bigint(20) NOT NULL auto_increment,
  `pprice` bigint(10) NOT NULL,
  `pcom` bigint(10) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
INSERT INTO `packs` (`ID`, `pprice`, `pcom`) VALUES
(1, 5, 20),
(2, 10, 20),
(3, 15, 20),
(4, 20, 20);
ALTER TABLE `posts` ADD `ctp` BIGINT( 10 ) NOT NULL DEFAULT '0' ;
UPDATE `config` SET `value` = '1.2' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;
