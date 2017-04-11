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
$thebaseurl = $config['baseurl'];

if ($_SESSION['USERID'] != "" && $_SESSION['USERID'] >= 0 && is_numeric($_SESSION['USERID']))
{
	if($_SESSION['USERNAME'] != "")
	{
		header("Location:$config[baseurl]/");exit;
	}
	elseif($_REQUEST['jlog'] == "1")
	{	
		$user_username = cleanit($_REQUEST['l_username']);
		STemplate::assign('user_username',$user_username);
		if($user_username == "")
		{
			$error .= "<li>".$lang['13']."</li>";	
		}
		elseif(strlen($user_username) < 4)
		{
			$error .= "<li>".$lang['25']."</li>";	
		}
		elseif(!preg_match("/^[a-zA-Z0-9]*$/i",$user_username))
		{
			$error .= "<li>".$lang['24']."</li>";
		}
		elseif(!verify_email_username($user_username))
		{
			$error .= "<li>".$lang['14']."</li>";
		}
			
		if($error == "")
		{
			$SID = intval($_SESSION['USERID']);
			$query="UPDATE members SET username='".mysql_real_escape_string($user_username)."' WHERE USERID='".mysql_real_escape_string($SID)."' and status='1'";
			$result=$conn->execute($query);
			$_SESSION['USERNAME']=$user_username;
			header("Location:$config[baseurl]/");exit;
		}
	}
}
else
{
	header("Location:$config[baseurl]/login");exit;
}
STemplate::assign('pagetitle',$lang['448']);
//TEMPLATES BEGIN
STemplate::assign('error',$error);
STemplate::display('connect.tpl');
STemplate::display('footer.tpl');
//TEMPLATES END
?>