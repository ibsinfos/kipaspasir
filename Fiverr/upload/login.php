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
	header("Location:$config[baseurl]/");exit;
}

$r = cleanit(stripslashes($_REQUEST['r']));
STemplate::assign('r',$r);

if($_REQUEST['jlog'] == "1")
{	
	$user_username = cleanit($_REQUEST['l_username']);
	STemplate::assign('user_username',$user_username);
	if($user_username == "")
	{
		$error = "<li>".$lang['13']."</li>";	
	}
	
	$user_password = cleanit($_REQUEST['l_password']);
	if($user_password == "")
	{
		$error .= "<li>".$lang['17']."</li>";	
	}
	
	$l_remember_me = cleanit($_REQUEST['l_remember_me']);
	
	if($error == "")
	{
		$encryptedpassword = md5($user_password);
		$query="SELECT status,USERID,email,username,verified from members WHERE username='".mysql_real_escape_string($user_username)."' and password='".mysql_real_escape_string($encryptedpassword)."'";
		$result=$conn->execute($query);
		
		if($result->recordcount()<1)
		{
			$error = "<li>".$lang['42']."</li>";
		}
		elseif($result->fields['status']=="0")
		{
			$error = "<li>".$lang['43']."</li>";
		}

		if($error=="")
		{
			$query="update members set lastlogin='".time()."', lip='".$_SERVER['REMOTE_ADDR']."' WHERE username='".mysql_real_escape_string($user_username)."'";
			$conn->execute($query);
	    	$_SESSION['USERID']=$result->fields['USERID'];
			$_SESSION['EMAIL']=$result->fields['email'];
			$_SESSION['USERNAME']=$result->fields['username'];
			$_SESSION['VERIFIED']=$result->fields['verified'];
			if($l_remember_me == "1")
			{
				create_slrememberme();
			}
			$redirect = base64_decode($r);
			if($redirect == "")
			{
				header("Location:$thebaseurl/");exit;
			}
			else
			{
				$rto = $thebaseurl."/".$redirect;
				header("Location:$rto");exit;
			}
		}	
	}
}

$templateselect = "login.tpl";
$pagetitle = $lang['40'];
STemplate::assign('pagetitle',$pagetitle);

//TEMPLATES BEGIN
STemplate::assign('error',$error);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>