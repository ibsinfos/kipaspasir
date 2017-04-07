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

function insert_get_all_gigs()
{
    global $config,$conn;
	$query = "select PID,gtitle from posts order by PID desc"; 
	$results = $conn->execute($query);
	$returnthis = $results->getrows();
	return $returnthis;
}

function insert_get_all_mems()
{
    global $config,$conn;
	$query = "select USERID,username from members WHERE username!='' order by username asc"; 
	$results = $conn->execute($query);
	$returnthis = $results->getrows();
	return $returnthis;
}

if($_POST['submitform'] == "1")
{
	$PID = intval(cleanit($_POST['PID']));
	$RATER = intval(cleanit($_POST['RATER']));
	$rating = intval(cleanit($_POST['rating']));
	$comment = cleanit($_POST['comment']);
	
	if($PID == "0")
	{
		$error = "Error: Please choose a gig.";
	}
	elseif($RATER == "0")
	{
		$error = "Error: Please choose a user.";
	}
	else
	{
		$query = "select USERID from posts where PID='".mysql_real_escape_string($PID)."'"; 
		$executequery=$conn->execute($query);
		$USERID = intval($executequery->fields['USERID']);
		if($USERID == "0")
		{
			$error = "Error: Could not retrieve the owner of the gig.";
		}
		elseif($USERID == $RATER)
		{
			$error = "Error: The user adding the feedback cannot be the seller.";
		}
		else
		{
			if($rating == "1")
			{
				$addme = ", good='1', bad='0'"	;
			}
			else
			{
				$addme = ", good='0', bad='1'";	
			}
			$sql = "insert ratings set USERID='".mysql_real_escape_string($USERID)."', PID='".mysql_real_escape_string($PID)."', RATER='".mysql_real_escape_string($RATER)."', comment='".mysql_real_escape_string($comment)."', time_added='".time()."' $addme";
			$conn->execute($sql);
			$message = "Feedback Successfully Added.";
			Stemplate::assign('message',$message);
		}
	}
}

$mainmenu = "15";
$submenu = "1";
Stemplate::assign('error',$error);
Stemplate::assign('mainmenu',$mainmenu);
Stemplate::assign('submenu',$submenu);
STemplate::display("administrator/global_header.tpl");
STemplate::display("administrator/feedback_add.tpl");
STemplate::display("administrator/global_footer.tpl");
?>