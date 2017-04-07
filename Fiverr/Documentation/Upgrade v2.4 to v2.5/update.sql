ALTER TABLE `members` ADD `toprated` INT( 1 ) NOT NULL DEFAULT '0';
INSERT INTO `config` (`setting`, `value`) VALUES ('scriptolution_toprated_rating', '99'), ('scriptolution_toprated_count', '10');
UPDATE `config` SET `value` = '2.5' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;