ALTER TABLE `categories` ADD `parent` BIGINT( 20 ) NOT NULL DEFAULT '0';
ALTER TABLE `categories` ADD `details` TEXT NOT NULL ;
UPDATE `config` SET `value` = '3.8' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;