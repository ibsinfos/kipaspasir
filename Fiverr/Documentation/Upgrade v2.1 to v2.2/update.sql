ALTER TABLE `members` ADD `aemail` VARCHAR( 100 ) NOT NULL ;
ALTER TABLE `withdraw_requests` ADD `ap` BIGINT( 1 ) NOT NULL DEFAULT '0';
UPDATE `config` SET `value` = '2.2' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;