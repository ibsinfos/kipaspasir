INSERT INTO `config` (`setting`, `value`) VALUES ('items_per_page_new', '28');
UPDATE `config` SET `value` = '5.0' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;