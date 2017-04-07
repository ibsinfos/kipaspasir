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

include("include/config.php");
include("include/functions/import.php");

if ($_SESSION['USERID'] != "" && $_SESSION['USERID'] >= 0 && is_numeric($_SESSION['USERID']))
{		
	if ($config['enable_ref'] == "1")
	{	

		$templateselect = "myreferrals.tpl";
		$pagetitle = $lang['512'];
		STemplate::assign('pagetitle',$pagetitle);	
		
		$query="SELECT A.REFERRED, A.time_added, A.money, B.username, A.status from referrals A, members B WHERE A.USERID='".mysql_real_escape_string($_SESSION['USERID'])."' AND A.REFERRED=B.USERID order by A.RID desc";
		$results=$conn->execute($query);
		$o = $results->getrows();
		STemplate::assign('o',$o);	
	}
	else
	{
		header("Location:$config[baseurl]/");exit;
	}
}
else
{
	header("Location:$config[baseurl]/");exit;
}

//TEMPLATES BEGIN
STemplate::assign('message',$message);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>