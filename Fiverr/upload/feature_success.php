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
| Copyright (c) 2011 FiverrScript.com. All rights reserved.
|**************************************************************************************************/

include("include/config.php");
include("include/functions/import.php");
$PID = intval(base64_decode(cleanit($_REQUEST['g'])));

if($PID > 0)
{	
	$pagetitle = $lang['54'];
	STemplate::assign('pagetitle',$pagetitle);
	
	if ($_SESSION['USERID'] != "" && $_SESSION['USERID'] >= 0 && is_numeric($_SESSION['USERID']))
	{
		$query = "SELECT A.*, B.seo, C.username from posts A, categories B, members C where A.category=B.CATID AND A.USERID=C.USERID AND C.USERID='".mysql_real_escape_string($_SESSION['USERID'])."' AND C.USERID=A.USERID AND A.PID='".mysql_real_escape_string($PID)."'";
		$results=$conn->execute($query);
		$p = $results->getrows();
		STemplate::assign('p',$p[0]);
		$message = $lang['459'];
	}
	else
	{
		$eid = base64_encode($PID);
		$r = base64_encode("feature_success?g=".$eid);
		header("Location:$config[baseurl]/login?r=$r");exit;
	}
}
else
{
	header("Location:$config[baseurl]/");exit;
}

//TEMPLATES BEGIN
STemplate::assign('message',$message);
STemplate::display('header.tpl');
STemplate::display('feature_success.tpl');
STemplate::display('footer.tpl');
//TEMPLATES END
?>