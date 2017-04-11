<?php
/**************************************************************************************************
| Fiverr Script
| http://www.fiverrscript.com
| webmaster@fiverrscript.com
|
|**************************************************************************************************
|
| By using this software you agree that you have read and acknowledged our End-User License 
| Agreement available at http://www.fiverrscript.com/eula.html and to be bound by it.
|
| Copyright (c) FiverrScript.com. All rights reserved.
|**************************************************************************************************/

include("../include/config.php");
include_once("../include/functions/import.php");
verify_login_admin();

if($_POST['submitform'] == "1")
{
	$name = htmlentities(strip_tags($_REQUEST['name']), ENT_COMPAT, "UTF-8");
	$seo = htmlentities(strip_tags($_REQUEST['seo']), ENT_COMPAT, "UTF-8");
	$seo = str_replace("\/", "", $seo);
	$seo = str_replace("/", "-", $seo);
	$seo = str_replace("&amp;", "", $seo);
	$seo = str_replace("&", "", $seo);
	$seo = str_replace(" ", "", $seo);
	$parent = intval(cleanit($_POST['parent']));
	$details = cleanit($_POST['details']);
	$mtitle = cleanit($_POST['mtitle']);
	$mdesc = cleanit($_POST['mdesc']);
	$mtags = cleanit($_POST['mtags']);
	$sql = "insert categories set name='".mysql_real_escape_string($name)."', seo='".mysql_real_escape_string($seo)."', parent='".mysql_real_escape_string($parent)."', details='".mysql_real_escape_string($details)."', mtitle='".mysql_real_escape_string($mtitle)."', mdesc='".mysql_real_escape_string($mdesc)."', mtags='".mysql_real_escape_string($mtags)."'";
	$conn->execute($sql);
	$message = "Category Successfully Added.";
	Stemplate::assign('message',$message);
}

$mainmenu = "3";
$submenu = "1";
Stemplate::assign('mainmenu',$mainmenu);
Stemplate::assign('submenu',$submenu);
STemplate::display("administrator/global_header.tpl");
STemplate::display("administrator/cat_add.tpl");
STemplate::display("administrator/global_footer.tpl");
?>