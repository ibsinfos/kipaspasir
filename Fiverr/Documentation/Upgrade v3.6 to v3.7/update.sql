INSERT INTO `config` (`setting`, `value`) VALUES ('enable_levels', '0');
INSERT INTO `config` (`setting`, `value`) VALUES ('level1job', '1'), ('level2job', '3'), ('level3job', '');
ALTER TABLE `members` ADD `level` BIGINT( 1 ) NOT NULL DEFAULT '1';
ALTER TABLE `packs`  ADD `l1` INT(1) NOT NULL DEFAULT '1',  ADD `l2` INT(1) NOT NULL DEFAULT '1',  ADD `l3` INT(1) NOT NULL DEFAULT '1';
INSERT INTO `config` (`setting`, `value`) VALUES ('level2num', '10'), ('level2rate', '90'), ('level3num', '20'), ('level3rate', '90');
ALTER TABLE `orders` ADD `late` BIGINT( 1 ) NOT NULL DEFAULT '0';
ALTER TABLE `static` CHANGE `value` `value` TEXT NOT NULL ;
INSERT INTO `static` (`ID`, `title`, `value`) VALUES (NULL, 'Job Levels', 'Insert your information about job levels here.<br><br>

HTML is accepted.');
UPDATE `config` SET `value` = '3.7' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;