ALTER TABLE `inbox` CHANGE `message` `message` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '';
ALTER TABLE `inbox2` CHANGE `message` `message` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '';
UPDATE `config` SET `value` = '1.3' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;
