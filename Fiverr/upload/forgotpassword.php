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

if($_REQUEST['fpsub'] == "1")
{
	$user_email = cleanit($_REQUEST['email']);
	if($user_email == "")
	{
		$error .= "<li>".$lang['12']."</li>";
	}
	
	if($error == "")
	{
		$query="SELECT username,pwd FROM members WHERE email='".mysql_real_escape_string($user_email)."'";
		$result=$conn->execute($query);
		$pwd = $result->fields['pwd'];
		$un = $result->fields['username'];
		
		if(mysql_affected_rows()>=1)
		{
			if($pwd != "")
			{
				// Send E-Mail Begin
				$sendto = $user_email;
				$sendername = $config['site_name'];
				$from = $config['site_email'];
				$subject = $lang['50'];
				$sendmailbody = stripslashes($un).",<br><br>";
				$sendmailbody .= $lang['51']."<br>";
				$sendmailbody .= $lang['52']." $pwd <br><br>";
				$sendmailbody .= $lang['23'].",<br>".stripslashes($sendername);
				mailme($sendto,$sendername,$from,$subject,$sendmailbody,$bcc="");
				// Send E-Mail End
				$message = $lang['53'];
			}
		}
		else
		{
			$error .= $lang['507'];
		}
	}
}
STemplate::assign('error',$error);
STemplate::assign('message',$message);
$templateselect = "forgotpassword.tpl";
$pagetitle = $lang['39'];
STemplate::assign('pagetitle',$pagetitle);

//TEMPLATES BEGIN
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>