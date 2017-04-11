ALTER TABLE `posts` ADD `rcount` BIGINT( 20 ) NOT NULL DEFAULT '0' AFTER `rating`;
UPDATE `config` SET `value` = '2.1' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;