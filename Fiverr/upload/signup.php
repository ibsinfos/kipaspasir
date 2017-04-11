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
if ($config['enable_ref'] == "1")
{
	$ref = intval(cleanit(stripslashes($_REQUEST['ref'])));
	STemplate::assign('ref',$ref);
}
$scriptolution_proceed = "0";
if($config['enable_captcha'] == "3")
{
	require_once("ayah.php");
	$ayah = new AYAH();	
	
	if($_REQUEST['jsub'] == "1")
	{
		$score = $ayah->scoreResult();
		if ($score)
		{
			$scriptolution_proceed = "1";
		}
		else
		{
			$error .= "<li>".$lang['19']."</li>";
		}
	}	
	$scriptolutiongetplaythru = $ayah->getPublisherHTML();
	STemplate::assign('scriptolutiongetplaythru',$scriptolutiongetplaythru);
}
else
{
	$scriptolution_proceed = "1";
}
if($_REQUEST['jsub'] == "1" && $scriptolution_proceed == "1")
{
	$user_email = cleanit($_REQUEST['user_email']);
	if($user_email == "")
	{
		$error .= "<li>".$lang['12']."</li>";
	}
	elseif(!verify_valid_email($user_email))
	{
		$error .= "<li>".$lang['15']."</li>";
	}
	elseif (!verify_email_unique($user_email))
	{
		$error .= "<li>".$lang['16']."</li>";
	}
	
	$user_username = cleanit($_REQUEST['user_username']);
	if($user_username == "")
	{
		$error .= "<li>".$lang['13']."</li>";	
	}
	elseif(strlen($user_username) < 4)
	{
		$error .= "<li>".$lang['25']."</li>";	
	}
	elseif(strlen($user_username) > 15)
	{
		$error .= "<li>".$lang['508']."</li>";	
	}
	elseif(!preg_match("/^[a-zA-Z0-9]*$/i",$user_username))
	{
		$error .= "<li>".$lang['24']."</li>";
	}
	elseif(!verify_email_username($user_username))
	{
		$error .= "<li>".$lang['14']."</li>";
	}
	
	$user_password = cleanit($_REQUEST['user_password']);
	$user_password2 = str_replace(" ", "", $user_password);
	if($user_password == "" || $user_password2 == "")
	{
		$error .= "<li>".$lang['17']."</li>";	
	}	
	
	if ($config['enable_captcha'] == "1")
	{
		$user_captcha_solution = cleanit($_REQUEST['user_captcha_solution']);
		if($user_captcha_solution == "")
		{
			$error .= "<li>".$lang['18']."</li>";	
		}
		elseif($user_captcha_solution != $_SESSION['imagecode'])
		{
			$error .= "<li>".$lang['19']."</li>";	
		}
	}
	
	$user_terms_of_use = cleanit($_REQUEST['user_terms_of_use']);
	if($user_terms_of_use != "1")
	{
		$error .= "<li>".$lang['20']."</li>";	
	}
	
	if($error == "")
	{
		$md5pass = md5($user_password);
		$def_country = $config['def_country'];
		if($def_country == "")
		{
			$def_country = "US";	
		}
		$query="INSERT INTO members SET email='".mysql_real_escape_string($user_email)."',username='".mysql_real_escape_string($user_username)."', password='".mysql_real_escape_string($md5pass)."', pwd='".mysql_real_escape_string($user_password)."', addtime='".time()."', lastlogin='".time()."', ip='".$_SERVER['REMOTE_ADDR']."', lip='".$_SERVER['REMOTE_ADDR']."', country='".mysql_real_escape_string($def_country)."'";
		$result=$conn->execute($query);
		$userid = mysql_insert_id();
		
		if($userid != "" && is_numeric($userid) && $userid > 0)
		{
			$query="SELECT USERID,email,username,verified from members WHERE USERID='".mysql_real_escape_string($userid)."'";
			$result=$conn->execute($query);
			
			$SUSERID = $result->fields['USERID'];
			$SEMAIL = $result->fields['email'];
			$SUSERNAME = $result->fields['username'];
			$SVERIFIED = $result->fields['verified'];
			$_SESSION['USERID']=$SUSERID;
			$_SESSION['EMAIL']=$SEMAIL;
			$_SESSION['USERNAME']=$SUSERNAME;
			$_SESSION['VERIFIED']=$SVERIFIED;
			
			// Generate Verify Code Begin
			$verifycode = generateCode(5).time();
			$query = "INSERT INTO members_verifycode SET USERID='".mysql_real_escape_string($SUSERID)."', code='$verifycode'";
            $conn->execute($query);
			if(mysql_affected_rows()>=1)
			{
				$proceedtoemail = true;
			}
			else
			{
				$proceedtoemail = false;
			}
			// Generate Verify Code End
			
			// Send Welcome E-Mail Begin
			if ($proceedtoemail)
			{
                $sendto = $SEMAIL;
                $sendername = $config['site_name'];
                $from = $config['site_email'];
                $subject = $lang['21']." ".$sendername;
                $sendmailbody = stripslashes($_SESSION['USERNAME']).",<br><br>";
				$sendmailbody .= $lang['22']."<br>";
				$sendmailbody .= "<a href=".$config['baseurl']."/confirmemail?c=$verifycode>".$config['baseurl']."/confirmemail?c=$verifycode</a><br><br>";
				$sendmailbody .= $lang['23'].",<br>".stripslashes($sendername);
                mailme($sendto,$sendername,$from,$subject,$sendmailbody,$bcc="");
			}
			// Send Welcome E-Mail End
			
			if ($config['enable_ref'] == "1")
			{
				$ref_price = cleanit($config['ref_price']);
				if($ref > 0)
				{
					$query = "INSERT INTO referrals SET USERID='".mysql_real_escape_string($ref)."', REFERRED='".mysql_real_escape_string($SUSERID)."', money='".mysql_real_escape_string($ref_price)."', time_added='".time()."', ip='".$_SERVER['REMOTE_ADDR']."'";
            		$conn->execute($query);	
				}
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
	else
	{
		STemplate::assign('user_email',$user_email);
		STemplate::assign('user_username',$user_username);
		STemplate::assign('user_password',$user_password);
		STemplate::assign('user_password2',$user_password2);
		STemplate::assign('user_terms_of_use',$user_terms_of_use);
	}
}

$templateselect = "signup.tpl";
$pagetitle = $lang['1'];
STemplate::assign('pagetitle',$pagetitle);

//TEMPLATES BEGIN
STemplate::assign('error',$error);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>