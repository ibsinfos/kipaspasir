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

	$verify_pm = $config['verify_pm'];
	if($verify_pm == "1" && $_SESSION['VERIFIED'] == "0")
	{
		$error = $lang['479'];
		$templateselect = "empty.tpl";
	}
	else
	{
		$aboutid = intval(cleanit($_REQUEST['id']));
		if($aboutid > 0)
		{
			STemplate::assign('aboutid',$aboutid);
		}
		$u = cleanit($_REQUEST['u']);
		if($u != "")
		{
			$query="SELECT username, USERID FROM members WHERE username='".mysql_real_escape_string($u)."' limit 1";
			$results=$conn->execute($query);
			$u = $results->getrows();
			STemplate::assign('u',$u[0]);
			$UID = $u[0]['USERID'];
			
			if($UID > 0)
			{
				$templateselect = "conversations.tpl";
				$pagetitle = $lang['235']." ".$u[0]['username'];
				STemplate::assign('pagetitle',$pagetitle);
				
				$query="SELECT DISTINCT A.username AS mto, C.username AS mfrom, B.* FROM members A, inbox B, members C WHERE A.USERID=B.MSGTO AND C.USERID=B.MSGFROM AND ((B.MSGTO='".mysql_real_escape_string($_SESSION['USERID'])."' AND B.MSGFROM='".mysql_real_escape_string($UID)."') OR (B.MSGTO='".mysql_real_escape_string($UID)."' AND B.MSGFROM='".mysql_real_escape_string($_SESSION['USERID'])."')) order by B.MID asc";
				$results=$conn->execute($query);
				$m = $results->getrows();
				STemplate::assign('m',$m);
				$totalm = count($m);
				if($totalm > 0)
				{
					$lastm = $totalm - 1;
					$lastm = $m[$lastm]['MID'];
				}
				else
				{
					$lastm = "0";
				}
				STemplate::assign('lastm',$lastm);
			}
		}
	}
}
else
{
	$u = cleanit($_REQUEST['u']);
	$aboutid = intval(cleanit($_REQUEST['id']));
	$eurl = "conversations/".$u."?id=".$aboutid;
	$rurl = base64_encode($eurl);
	header("Location:$config[baseurl]/login?r=".$rurl);exit;
}

//TEMPLATES BEGIN
STemplate::assign('error',$error);
STemplate::assign('message',$message);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>