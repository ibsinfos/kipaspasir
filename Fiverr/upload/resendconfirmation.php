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

$SID = intval(cleanit($_SESSION['USERID']));
if ($SID > "0")
{
	$query = "SELECT code FROM members_verifycode WHERE USERID='".mysql_real_escape_string($SID)."'";
	$executequery = $conn->execute($query);
	$verifycode = $executequery->fields['code'];	
	$sendto = $_SESSION['EMAIL'];
	$sendername = $config['site_name'];
	$from = $config['site_email'];
	$subject = $lang['406'];
	$sendmailbody = stripslashes($_SESSION['USERNAME']).",<br><br>";
	$sendmailbody .= $lang['482']."<br>";
	$sendmailbody .= "<a href=".$config['baseurl']."/confirmemail?c=$verifycode>".$config['baseurl']."/confirmemail?c=$verifycode</a><br><br>";
	$sendmailbody .= $lang['23'].",<br>".stripslashes($sendername);
	mailme($sendto,$sendername,$from,$subject,$sendmailbody,$bcc="");
	$message = $lang['481'];

}
else
{
	$eurl = "resendconfirmation.php";
	$rurl = base64_encode($eurl);
	header("Location:$config[baseurl]/login?r=".$rurl);exit;
}

STemplate::assign('pagetitle',$lang['480']);
STemplate::assign('message',$message);
STemplate::assign('error',$error);

//TEMPLATES BEGIN
STemplate::display('header.tpl');
STemplate::display('resendconfirmation.tpl');
STemplate::display('footer.tpl');
//TEMPLATES END
?>