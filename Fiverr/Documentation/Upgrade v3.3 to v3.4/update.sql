UPDATE `config` SET `value` = '3.4' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;