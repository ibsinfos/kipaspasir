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
$id = intval(cleanit($_REQUEST['id']));

if($id > 0)
{	
	$pagetitle = $lang['455'];
	STemplate::assign('pagetitle',$pagetitle);
	
	if ($_SESSION['USERID'] != "" && $_SESSION['USERID'] >= 0 && is_numeric($_SESSION['USERID']))
	{
		$query = "SELECT A.*, B.seo, C.username from posts A, categories B, members C where A.category=B.CATID AND A.USERID=C.USERID AND C.USERID='".mysql_real_escape_string($_SESSION['USERID'])."' AND C.USERID=A.USERID AND A.PID='".mysql_real_escape_string($id)."'";
		$results=$conn->execute($query);
		$p = $results->getrows();
		STemplate::assign('p',$p[0]);
		$PID = intval($p[0]['PID']);
		$eid = base64_encode($PID);
		STemplate::assign('eid',$eid);
		if($PID > 0)
		{
			$templateselect = "feature.tpl";
			
			
			
			
			
			
			$query = "select funds from members where USERID='".mysql_real_escape_string($_SESSION['USERID'])."'"; 
			$executequery=$conn->execute($query);
			$funds = $executequery->fields['funds'];
			STemplate::assign('funds',$funds);
			
			if($_POST['subbal'] == "1")
			{
				$price = $config['fprice'];
				if($funds >= $price)
				{
					$query1 = "UPDATE members SET funds=funds-$price WHERE USERID='".mysql_real_escape_string($_SESSION['USERID'])."'"; 
					$executequery1=$conn->execute($query1);
										
					$query = "INSERT INTO featured SET PID='".mysql_real_escape_string($PID)."', time='".time()."', price='".mysql_real_escape_string($price)."'"; 
					$executequery=$conn->execute($query);
					
					$query = "UPDATE posts SET feat='1' WHERE PID='".mysql_real_escape_string($PID)."'"; 
					$executequery=$conn->execute($query);
				
					header("Location:$config[baseurl]/feature_success?g=".$eid);exit;
					
				}
			}
			
			
			
			
			
			
			
			
			
			
			
		}
		else
		{
			header("Location:$config[baseurl]/");exit;
		}
	}
	else
	{
		$r = base64_encode("feature?id=".$id);
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
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>