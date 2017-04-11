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
	$templateselect = "balance.tpl";
	$pagetitle = $lang['205'];
	STemplate::assign('pagetitle',$pagetitle);
	
	$wdfunds = intval(cleanit($_POST['wdfunds']));
	$wdfunds2 = intval(cleanit($_POST['wdfunds2']));
	if($wdfunds == "1")
	{	
		$query="INSERT INTO withdraw_requests SET USERID='".mysql_real_escape_string($_SESSION['USERID'])."', time_added='".time()."', ap='0'";
		$conn->execute($query);
		$message = $lang['395'];
	}
	elseif($wdfunds2 == "1")
	{	
		$query="INSERT INTO withdraw_requests SET USERID='".mysql_real_escape_string($_SESSION['USERID'])."', time_added='".time()."', ap='1'";
		$conn->execute($query);
		$message = $lang['395'];
	}
	
	$query="SELECT OID, time, t, price FROM payments WHERE USERID='".mysql_real_escape_string($_SESSION['USERID'])."' order by ID desc";
	$results=$conn->execute($query);
	$o = $results->getrows();
	STemplate::assign('o',$o);
	
	$query = "select funds, afunds, withdrawn, used from members where USERID='".mysql_real_escape_string($_SESSION['USERID'])."'"; 
	$executequery=$conn->execute($query);
	$funds = $executequery->fields['funds'];
	STemplate::assign('funds',$funds);
	$afunds = $executequery->fields['afunds'];
	STemplate::assign('afunds',$afunds);
	$withdrawn = $executequery->fields['withdrawn'];
	STemplate::assign('withdrawn',$withdrawn);
	$used = $executequery->fields['used'];
	STemplate::assign('used',$used);
	
	$query="SELECT A.OID, A.time, A.price, A.cancel, A.wd, B.status, B.cltime, B.IID, C.ctp FROM payments A, orders B, posts C WHERE A.OID=B.OID AND B.PID=C.PID AND C.USERID='".mysql_real_escape_string($_SESSION['USERID'])."' AND A.t='1' AND B.status>'0' order by A.ID desc";
	$results=$conn->execute($query);
	$p = $results->getrows();
	STemplate::assign('p',$p);
	
	$upcoming = "0.00";
	$app = "0.00";
	$clr = "0.00";
	for($i=0; $i<count($p);$i++)
	{
		$stat = $p[$i]['status'];
		$pce = $p[$i]['price'];
		$IID = intval($p[$i]['IID']);
		if($IID > 0)
		{
			$ctp = get_ctp($IID);
		}
		else
		{
			$ctp = $p[$i]['ctp'];
		}
		$pce = get_yprice2($p[$i]['price'], $ctp);
		$tme = $p[$i]['cltime'];
		if($stat == "5")
		{
			$dyz = get_days_withdraw($tme);
			if($dyz > 0)
			{
				$clr = $clr + $pce;
			}
			else
			{
				$iswd = $p[$i]['wd'];
				if($iswd == "0")
				{
					$app = $app + $pce;
				}
			}
		}
		elseif($stat == "2" || $stat == "3" || $stat == "7")
		{
		}
		else
		{
			$upcoming = $upcoming + $pce;	
			$upcoming = sprintf("%01.2f", $upcoming);
		}
	}
	STemplate::assign('upcoming',$upcoming);
	$app = sprintf("%01.2f", $app);
	STemplate::assign('app',$app);
	$clr = sprintf("%01.2f", $clr);
	STemplate::assign('clr',$clr);
	$overall = $withdrawn + $upcoming + $app + $clr + $afunds;
	$overall = sprintf("%01.2f", $overall);
	STemplate::assign('overall',$overall);
}
else
{
	header("Location:$config[baseurl]/");exit;
}

//TEMPLATES BEGIN
STemplate::assign('message',$message);
STemplate::assign('sm3',"1");
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>