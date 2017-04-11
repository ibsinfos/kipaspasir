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
$tag = cleanit($_REQUEST['query']);

STemplate::assign('tag',$tag);
STemplate::assign('pagetitle',$tag." ".$lang['124']);

$s = cleanit($_REQUEST['s']);
STemplate::assign('s',$s);

$search_in = cleanit($_REQUEST['search_in']);
$c = intval(cleanit($_REQUEST['c']));
STemplate::assign('c',$c);

if($search_in != "scriptolution_all")
{
	$search_in = "scriptolution_category";
	if($c > 0)
	{
		$query="SELECT name,parent FROM categories WHERE CATID='".mysql_real_escape_string($c)."'";
		$executequery=$conn->execute($query);
		$cname = $executequery->fields['name'];
		STemplate::assign('cname',$cname);
		$parent = intval(cleanit($executequery->fields['parent']));
		if($parent == "0")
		{
			$query="SELECT CATID FROM categories WHERE parent='".mysql_real_escape_string($c)."'";
			$results=$conn->execute($query);
			$searchsc = $results->getrows();
			if(count($searchsc) > 0)
			{
				for($i=0; $i<count($searchsc);$i++)
				{
					$ssc .= " OR A.category='".mysql_real_escape_string($searchsc[$i][0])."'";
					$ssd .= " OR category='".mysql_real_escape_string($searchsc[$i][0])."'";
				}
				$scriptolution_addcats = "AND (A.category='".mysql_real_escape_string($c)."' $ssc)";
				$scriptolution_addcatr = "AND (category='".mysql_real_escape_string($c)."' $ssd)";
			}
			else
			{
				$scriptolution_addcats = " AND A.category='".mysql_real_escape_string($c)."'";
				$scriptolution_addcatr = " AND category='".mysql_real_escape_string($c)."'";
			}
		}
		else
		{
			$scriptolution_addcats = " AND A.category='".mysql_real_escape_string($c)."'";
			$scriptolution_addcatr = " AND category='".mysql_real_escape_string($c)."'";
		}
	}
}
$addssc = "&c=$c&search_in=$search_in";
STemplate::assign('search_in',$search_in);

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

if($s == "r")
{
	$dby = "A.rating desc";	
}
elseif($s == "rz")
{
	$dby = "A.rating asc";	
}
elseif($s == "p")
{
	$dby = "A.viewcount desc";	
}
elseif($s == "pz")
{
	$dby = "A.viewcount asc";	
}
elseif($s == "c")
{
	$dby = "A.price asc";	
}
elseif($s == "cz")
{
	$dby = "A.price desc";	
}
elseif($s == "dz")
{
	$dby = "A.PID asc";	
}
else
{
	$dby = "A.PID desc";	
}

if($s == "ez")
{
	$dby = "A.PID asc";	
	$addsql = "AND days='1'";
	$addsqlb = "AND A.days='1'";
}
elseif($s == "e")
{
	$dby = "A.PID desc";	
	$addsql = "AND days='1'";
	$addsqlb = "AND A.days='1'";
}

$p = intval(cleanit($_REQUEST['p']));
if($p > 0)
{
	$scriptolution_addprice = " AND A.price='".mysql_real_escape_string($p)."'";
	$scriptolution_addpriced = " AND price='".mysql_real_escape_string($p)."'";
	STemplate::assign('p',$p);
	$addp = "&p=$p";
}	

$query1 = "SELECT count(*) as total from posts where active='1' AND (gtitle like'%".mysql_real_escape_string($tag)."%' OR gdesc like'%".mysql_real_escape_string($tag)."%' OR gtags like'%".mysql_real_escape_string($tag)."%') $addsql $scriptolution_addpriced $scriptolution_addcatr order by PID desc limit $config[maximum_results]";
$query2 = "SELECT A.*, B.seo, C.username, C.country, C.toprated from posts A, categories B, members C where A.active='1' AND (gtitle like'%".mysql_real_escape_string($tag)."%' OR gdesc like'%".mysql_real_escape_string($tag)."%' OR gtags like'%".mysql_real_escape_string($tag)."%') $addsqlb AND A.category=B.CATID AND A.USERID=C.USERID $scriptolution_addprice $scriptolution_addcats order by A.feat desc, $dby limit $pagingstart, $config[items_per_page]";
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
		$adds = "&s=$s".$addp;
	}
	if ($currentpage > 0)
	{
		if($currentpage > 1) 
		{
			$pagelinks.="<li class='prev'><a href='$thebaseurl/search?query=$tag&page=$theprevpage$adds".$addssc."'>$theprevpage</a></li>&nbsp;";
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
			$pagelinks.="<li><a href='$thebaseurl/search?query=$tag&page=$lowercount$adds".$addssc."'>$lowercount</a></li>&nbsp;";
			$lowercount++;
			$counter++;
		}
		$pagelinks.="<li><span class='active'>$currentpage</span></li>&nbsp;";
		$uppercounter = $currentpage+1;
		while (($uppercounter < $currentpage+10-$counter) && ($uppercounter<=$toppage))
		{
			$pagelinks.="<li><a href='$thebaseurl/search?query=$tag&page=$uppercounter$adds".$addssc."'>$uppercounter</a></li>&nbsp;";
			$uppercounter++;
		}
		if($currentpage < $toppage) 
		{
			$pagelinks.="<li class='next'><a href='$thebaseurl/search?query=$tag&page=$thenextpage$adds".$addssc."'>$thenextpage</a></li>";
		}
		else
		{
			$pagelinks.="<li><span class='next'>next page</span></li>";
		}
	}
}
$templateselect = "search.tpl";

//TEMPLATES BEGIN
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