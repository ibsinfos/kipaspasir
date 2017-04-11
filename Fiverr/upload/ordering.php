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
	$PID = intval(cleanit($_REQUEST['id']));
	$multi = intval(cleanit($_REQUEST['multi']));
	if($PID > 0)
	{
		$query="INSERT INTO order_items SET USERID='".mysql_real_escape_string($_SESSION['USERID'])."', PID='".mysql_real_escape_string($PID)."'";
		$result=$conn->execute($query);
		$IID = mysql_insert_id();
		if($IID > 0)
		{			
			$query = "select price, ctp from posts where PID='".mysql_real_escape_string($PID)."'"; 
			$executequery=$conn->execute($query);
			$price = $executequery->fields['price'];
			$ctp = $executequery->fields['ctp'];
			$total = $price;
			$totacom = $ctp;
			
			if($multi > 1)
			{
				$total = $price * $multi;
				//$totacom = $ctp * $multi;
				$addmulti = ", multi='".mysql_real_escape_string($multi)."'";
			}
			
			$query="UPDATE order_items SET totalprice='".mysql_real_escape_string($total)."', ctp='".mysql_real_escape_string($totacom)."' $addmulti WHERE IID='".mysql_real_escape_string($IID)."'";
			$result=$conn->execute($query);
			
			header("Location:$config[baseurl]/order?item=".$IID);exit;
		}
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
?>