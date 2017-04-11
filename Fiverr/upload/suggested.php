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

$UID = intval(cleanit($_SESSION['USERID']));

if($_POST['sugsub'] == "1")
{
	if($UID > 0)
	{
		$sugcontent = cleanit($_REQUEST['sugcontent']);	
		$sugcat = intval(cleanit($_REQUEST['sugcat']));
		if($sugcontent != "" && $sugcat != "")
		{
			$approve_suggests = $config['approve_suggests'];
			if($approve_suggests == "1")
			{
				$active = "0";
			}
			else
			{
				$active = "1";
			}
			$query="INSERT INTO wants SET USERID='".mysql_real_escape_string($UID)."', want='".mysql_real_escape_string($sugcontent)."', category='".mysql_real_escape_string($sugcat)."', time_added='".time()."', date_added='".date("Y-m-d")."', active='$active'";
			$result=$conn->execute($query);
			$message = $lang['121'];
			STemplate::assign('message',$message);	
		}
	}
	else
	{
		header("Location:$config[baseurl]/login");exit;
	}
}

$WID = intval(cleanit($_REQUEST['sug']));
$del = intval(cleanit($_REQUEST['del']));
if($UID > 0)
{
	if($del == "1")
	{
		if($WID > 0)
		{
			$query="DELETE FROM wants WHERE WID='".mysql_real_escape_string($WID)."' AND USERID='".mysql_real_escape_string($UID)."' AND active='1'";
			$result=$conn->execute($query);	
			$message = $lang['497'];
		}
	}
}


$s = cleanit($_REQUEST['s']);
STemplate::assign('s',$s);

$page = intval($_REQUEST['page']);

if($page=="")
{
	$page = "1";
}
$currentpage = $page;

if ($page >=2)
{
	$pagingstart = ($page-1)*$config['items_per_page'];
}
else
{
	$pagingstart = "0";
}

if($s == "dz")
{
	$dby = "A.WID asc";	
}
else
{
	$dby = "A.WID desc";	
}

$query1 = "SELECT count(*) as total from wants where active='1' $addsql order by WID desc limit $config[maximum_results]";
$query2 = "SELECT A.*, C.username, C.country, C.toprated from wants A, members C where A.active='1' AND A.USERID=C.USERID order by $dby limit $pagingstart, $config[items_per_page]";
$executequery1 = $conn->Execute($query1);
$scriptolution = $executequery1->fields['total'];
if ($scriptolution > 0)
{
	if($executequery1->fields['total']<=$config[maximum_results])
	{
		$total = $executequery1->fields['total'];
	}
	else
	{
		$total = $config[maximum_results];
	}
	$toppage = ceil($total/$config[items_per_page]);
	if($toppage==0)
	{
		$xpage=$toppage+1;
	}
	else
	{
		$xpage = $toppage;
	}
	$executequery2 = $conn->Execute($query2);
	$posts = $executequery2->getrows();
	$beginning=$pagingstart+1;
	$ending=$pagingstart+$executequery2->recordcount();
	$pagelinks="";
	$k=1;
	$theprevpage=$currentpage-1;
	$thenextpage=$currentpage+1;
	if($s != "")
	{
		$adds = "&s=$s";
	}
	if ($currentpage > 0)
	{
		if($currentpage > 1) 
		{
			$pagelinks.="<li class='prev'><a href='$thebaseurl/suggested?page=$theprevpage$adds'>$theprevpage</a></li>&nbsp;";
		}
		else
		{
			$pagelinks.="<li><span class='prev'>previous page</span></li>&nbsp;";
		}
		$counter=0;
		$lowercount = $currentpage-5;
		if ($lowercount <= 0) $lowercount = 1;
		while ($lowercount < $currentpage)
		{
			$pagelinks.="<li><a href='$thebaseurl/suggested?page=$lowercount$adds'>$lowercount</a></li>&nbsp;";
			$lowercount++;
			$counter++;
		}
		$pagelinks.="<li><span class='active'>$currentpage</span></li>&nbsp;";
		$uppercounter = $currentpage+1;
		while (($uppercounter < $currentpage+10-$counter) && ($uppercounter<=$toppage))
		{
			$pagelinks.="<li><a href='$thebaseurl/suggested?page=$uppercounter$adds'>$uppercounter</a></li>&nbsp;";
			$uppercounter++;
		}
		if($currentpage < $toppage) 
		{
			$pagelinks.="<li class='next'><a href='$thebaseurl/suggested?page=$thenextpage$adds'>$thenextpage</a></li>";
		}
		else
		{
			$pagelinks.="<li><span class='next'>next page</span></li>";
		}
	}
}
$templateselect = "suggested.tpl";
//TEMPLATES BEGIN
STemplate::assign('pagetitle',stripslashes($lang['496']));
STemplate::assign('message',$message);
STemplate::assign('beginning',$beginning);
STemplate::assign('ending',$ending);
STemplate::assign('pagelinks',$pagelinks);
STemplate::assign('total',$total);
STemplate::assign('posts',$posts);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>