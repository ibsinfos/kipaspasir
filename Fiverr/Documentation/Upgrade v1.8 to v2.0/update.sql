INSERT INTO `config` (`setting`, `value`) VALUES ('enable_alertpay', '0');
INSERT INTO `config` (`setting`, `value`) VALUES ('enable_paypal', '1');
INSERT INTO `config` (`setting`, `value`) VALUES ('alertpay_email', 'payments@yourdomain.com');
INSERT INTO `config` (`setting`, `value`) VALUES ('alertpay_currency', 'USD');
INSERT INTO `config` (`setting`, `value`) VALUES ('ap_code', '');
ALTER TABLE `posts` CHANGE `ctp` `ctp` DECIMAL( 9, 2 ) NOT NULL DEFAULT '0';
ALTER TABLE `members` CHANGE `afunds` `afunds` DECIMAL( 9, 2 ) NOT NULL , CHANGE `withdrawn` `withdrawn` DECIMAL( 9, 2 ) NOT NULL , CHANGE `used` `used` DECIMAL( 9, 2 ) NOT NULL;
UPDATE `config` SET `value` = '2.0' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;