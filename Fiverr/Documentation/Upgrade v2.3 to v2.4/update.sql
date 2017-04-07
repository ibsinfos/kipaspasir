ALTER TABLE `members` ADD `country` VARCHAR( 2 ) NOT NULL DEFAULT 'US';
UPDATE `config` SET `value` = '2.4' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;