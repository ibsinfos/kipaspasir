INSERT INTO `config` (`setting`, `value`) VALUES ('enable_captcha', '1');
INSERT INTO `config` (`setting`, `value`) VALUES ('hide_catnav', '0');
UPDATE `config` SET `value` = '5.3' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;