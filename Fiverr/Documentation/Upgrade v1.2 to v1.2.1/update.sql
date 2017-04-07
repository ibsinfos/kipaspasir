UPDATE `config` SET `value` = '1.2.1' WHERE CONVERT( `config`.`setting` USING utf8 ) = 'ver' LIMIT 1 ;
