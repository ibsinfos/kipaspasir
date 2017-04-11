CREATE TABLE IF NOT EXISTS `bans_ips` (
  `ip` varchar(20) NOT NULL,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `order_items` (
  `IID` bigint(20) NOT NULL AUTO_INCREMENT,
  `PID` bigint(20) NOT NULL,
  `USERID` bigint(20) NOT NULL,
  `multi` bigint(5) NOT NULL,
  `EID` bigint(20) NOT NULL,
  `EID2` bigint(20) NOT NULL,
  `EID3` bigint(20) NOT NULL,
  `totalprice` bigint(20) NOT NULL,
  `ctp` decimal(9,2) NOT NULL,
  `scriptolutionbuy` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `orders` ADD `IID` BIGINT( 20 ) NOT NULL ;
ALTER TABLE `payments` ADD `IID` BIGINT( 20 ) NOT NULL ;
INSERT INTO `config` (`setting`, `value`) VALUES ('verify_pm', '1');
INSERT INTO `config` (`setting`, `value`) VALUES ('def_country', 'US');
ALTER TABLE `posts` ADD `scriptolution_add_multiple` BIGINT( 3 ) NOT NULL DEFAULT '0' AFTER `feat`;
UPDATE `config` SET `value` = '3.0' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;