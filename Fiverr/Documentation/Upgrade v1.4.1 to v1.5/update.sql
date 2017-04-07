INSERT INTO `config` (`setting` ,`value`)VALUES ('short_urls', '1');
INSERT INTO `config` (`setting` ,`value`)VALUES ('twitter', 'Scriptolution');
ALTER TABLE `posts` ADD `short` VARCHAR( 20 ) NOT NULL ;
UPDATE `config` SET `value` = '1.5' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;