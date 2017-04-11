INSERT INTO `config` (`setting`, `value`) VALUES ('scriptolution_paypal_confirm', '0');
UPDATE `config` SET `value` = '4.1' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;