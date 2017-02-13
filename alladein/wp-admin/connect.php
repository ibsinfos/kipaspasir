<?php 
$host="localhost";
$username="ncncom_ncnfur";
$password="!NcnStoreFind4331818";
$db_name="ncncom_ncnweb";
$tbl_name="mainmenu";
$conn = mysql_connect("$host", "$username","$password") or die;

mysql_select_db("$db_name", $conn) or die;
?>
