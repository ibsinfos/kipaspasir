ALTER TABLE members DROP INDEX username;
ALTER TABLE `posts` CHANGE `short` `short` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
UPDATE `config` SET `value` = '2.7' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;