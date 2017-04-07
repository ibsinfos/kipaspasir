ALTER TABLE ratings DROP INDEX OID;
INSERT INTO `config` (`setting`, `value`) VALUES ('scriptolution_proxy_block', '0');
ALTER TABLE `categories`  ADD `mtitle` TEXT NOT NULL,  ADD `mdesc` TEXT NOT NULL,  ADD `mtags` TEXT NOT NULL;
INSERT INTO `config` (`setting`, `value`) VALUES ('enable_ref', '0'), ('ref_price', '1');
CREATE TABLE IF NOT EXISTS `referrals` (
  `RID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERID` bigint(20) NOT NULL DEFAULT '0',
  `REFERRED` bigint(20) NOT NULL DEFAULT '0',
  `money` decimal(9,2) NOT NULL,
  `time_added` varchar(20) DEFAULT NULL,
  `ip` text NOT NULL,
  `status` bigint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`RID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `payments`  ADD `fiverrscriptdotcom_balance` BIGINT NOT NULL DEFAULT '0',  ADD `fiverrscriptdotcom_available` BIGINT NOT NULL DEFAULT '0';
UPDATE `config` SET `value` = '4.0' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;