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
	$allowposting = "1";
	$vonly = $config['vonly'];
	if($vonly == "1")
	{
		$uverified = $_SESSION['VERIFIED'];
		if($uverified != "1")
		{
			$allowposting = "0";
		}
	}
	if($config['enable_levels'] == "1" && $config['price_mode'] == "3")
	{
		$timecheck = time() - 86400;
		$query = "select count(*) as total from posts where USERID='".mysql_real_escape_string($_SESSION['USERID'])."' AND time_added>='".mysql_real_escape_string($timecheck)."'"; 
		$executequery=$conn->execute($query);
		$lastjobs = $executequery->fields['total']+0;
		
		$query = "select level from members where USERID='".mysql_real_escape_string($_SESSION['USERID'])."'"; 
		$executequery=$conn->execute($query);
		$mlevel = intval($executequery->fields['level']);
		if($mlevel == "3")
		{
			$jlimit = $config['level3job'];
		}
		elseif($mlevel == "2")
		{
			$jlimit = $config['level2job'];
		}
		elseif($mlevel == "1")
		{
			$jlimit = $config['level1job'];
		}
		else
		{
			$jlimit = "";
		}
		if($jlimit != "")
		{
			if($lastjobs >= $jlimit)
			{
				$allowposting = "2";
			}
		}
	}
	
	if($allowposting == "1")
	{
		if($_POST['subform'] == "1")
		{
			$gtitle = cleanit($_REQUEST['gtitle']);	
			$gcat = intval(cleanit($_REQUEST['gcat']));
			$gdesc = cleanit($_REQUEST['gdesc']);	
			$ginst = cleanit($_REQUEST['ginst']);	
			$gtags = cleanit($_REQUEST['gtags']);	
			$gdays = intval(cleanit($_REQUEST['gdays']));
			$gyoutube = cleanit($_REQUEST['gyoutube']);
			$shipme = intval(cleanit($_REQUEST['shipme']));
			$multipleme = intval(cleanit($_REQUEST['multipleme']));
			$extrasme = intval(cleanit($_REQUEST['extrasme']));
			$instanturl = cleanit($_REQUEST['instanturl']);
			if($gtitle == "")
			{
				$error = "<li>".$lang['92']."</li>";
			}
			elseif(strlen($gtitle) > 200)
			{
				$error = "<li>".$lang['509']."</li>";
			}
			if($shipme == "1")
			{
				include("new_ship.scriptolution.com.php");
			}
			elseif($multipleme == "1")
			{
				$multiplemax = intval(cleanit($_REQUEST['multiplemax']));
				if($multiplemax > 0)
				{
					$scriptolution_add_multiple = ", scriptolution_add_multiple='".mysql_real_escape_string($multiplemax)."'";	
				}
				$fiverrscriptdotcom = "1";
			}
			elseif($extrasme == "1")
			{
				$scriptolution_process_extras = "1";
				$fiverrscriptdotcom = "1";
			}
			else
			{
				$fiverrscriptdotcom = "1";	
			}
			if($fiverrscriptdotcom == "1")
			{
				if($config['price_mode'] == "1")
				{
					$price = intval(cleanit($_REQUEST['gprice']));
					if($price == "0")
					{
						$error = "<li>".$lang['127']."</li>";
					}
					$comper = intval($config['commission_percent']);
					$count1 = $comper / 100;
					$count2 = $count1 * $price;
					$ctp = number_format($count2, 2, '.', '');
				}
				elseif($config['price_mode'] == "3")
				{
					$PACID = intval(cleanit($_REQUEST['gprice']));
					$query = "select pprice,pcom from packs where ID='".mysql_real_escape_string($PACID)."'"; 
					$executequery=$conn->execute($query);
					$price = intval(cleanit($executequery->fields['pprice']));
					$comper = intval(cleanit($executequery->fields['pcom']));
					if($price == "0")
					{
						$error = "<li>".$lang['435']."</li>";
					}
					$count1 = $comper / 100;
					$count2 = $count1 * $price;
					$ctp = number_format($count2, 2, '.', '');
					
				}
				elseif($config['price_mode'] == "2")
				{
					$price = intval($config['price']);
					$comper = intval($config['commission_percent']);
					$count1 = $comper / 100;
					$count2 = $count1 * $price;
					$ctp = number_format($count2, 2, '.', '');
				}
				else
				{
					$price = intval($config['price']);
					$mysetc = $config['commission'];
					$ctp = number_format($mysetc, 2);
				}
			}
			if($gcat == "0")
			{
				$error .= "<li>".$lang['93']."</li>";
			}
			if($gdesc == "")
			{
				$error .= "<li>".$lang['94']."</li>";
			}
			elseif(strlen($gdesc) > 450)
			{
				$error = "<li>".$lang['510']."</li>";
			}
			if($ginst == "")
			{
				$error .= "<li>".$lang['95']."</li>";
			}
			if($gtags == "")
			{
				$error .= "<li>".$lang['96']."</li>";
			}
			if($gdays == "0")
			{
				if($instanturl=="" && $_FILES['instantfile']['tmp_name']=="")
				{
					$error .= "<li>".$lang['97']."</li>";
				}
			}
			if($instanturl!="" || $_FILES['instantfile']['tmp_name']!="")
			{
				include("new_instant.scriptolution.com.php");
			}
			$gphoto = $_FILES['gphoto']['tmp_name'];
			if($gphoto != "")
			{
				$ext = substr(strrchr($_FILES['gphoto']['name'], '.'), 1);
				$ext2 = strtolower($ext);
				if($ext2 == "jpeg" || $ext2 == "jpg" || $ext2 == "gif" || $ext2 == "png")
				{
					$theimageinfo = getimagesize($gphoto);
					if($theimageinfo[2] != 1 && $theimageinfo[2] != 2 && $theimageinfo[2] != 3)
					{
						$error .= "<li>".$lang['100']."</li>";
					}
				}
				else
				{
					$error .= "<li>".$lang['100']."</li>";
				}
			}
			else
			{
				$error .= "<li>".$lang['101']."</li>";
			}
			if($gyoutube != "")
			{
				$gyoutube = str_replace("https://", "http://", $gyoutube);
				$pos = strpos($gyoutube, "http://www.youtube.com/watch?v=");
				$posb = strpos($gyoutube, "http://www.youtu.be/");
				$posc = strpos($gyoutube, "http://youtu.be/");
				if ($pos === false)
				{
					if ($posb === false)
					{
						if ($posc === false)
						{
							$error .= "<li>".$lang['133']."</li>";
						}
					}
				}
			}
			if($error == "")
			{			
				$approve_stories = $config['approve_stories'];
				if($approve_stories == "1")
				{
					$active = "0";
				}
				else
				{
					$active = "1";
				}
				$query="INSERT INTO posts SET USERID='".mysql_real_escape_string($_SESSION['USERID'])."', gtitle='".mysql_real_escape_string($gtitle)."',gtags='".mysql_real_escape_string($gtags)."', gdesc='".mysql_real_escape_string($gdesc)."', ginst='".mysql_real_escape_string($ginst)."', days='".mysql_real_escape_string($gdays)."', youtube='".mysql_real_escape_string($gyoutube)."', category='".mysql_real_escape_string($gcat)."', price='".mysql_real_escape_string($price)."', time_added='".time()."', date_added='".date("Y-m-d")."', pip='".$_SERVER['REMOTE_ADDR']."', active='$active', ctp='".mysql_real_escape_string($ctp)."' $scriptolution_add_multiple $addship $scriptolution_add_instant";
				$result=$conn->execute($query);
				$pid = mysql_insert_id();
				
				if($scriptolution_process_extras == "1")
				{
					include("new_extras.scriptolution.com.php");
				}
				if($gphoto != "")
				{
					$thepp = $pid."-1";
					if($theimageinfo[2] == 1)
					{
						$thepp .= ".gif";
					}
					elseif($theimageinfo[2] == 2)
					{
						$thepp .= ".jpg";
					}
					elseif($theimageinfo[2] == 3)
					{
						$thepp .= ".png";
					}
					if($error == "")
					{
						$myvideoimgnew=$config['pdir']."/".$thepp;
						if(file_exists($myvideoimgnew))
						{
							unlink($myvideoimgnew);
						}
						move_uploaded_file($gphoto, $myvideoimgnew);
						do_resize_image($myvideoimgnew, "380", "265", false, $config['pdir']."/t/".$thepp);
						do_resize_image($myvideoimgnew, "102", "72", false, $config['pdir']."/t2/".$thepp);
						if(file_exists($config['pdir']."/".$thepp))
						{
							$query = "UPDATE posts SET p1='$thepp' WHERE PID='".mysql_real_escape_string($pid)."'";
							$conn->execute($query);
						}
					}
				}
				$gphoto2 = $_FILES['gphoto2']['tmp_name'];
				if($gphoto2 != "")
				{
					$ext = substr(strrchr($_FILES['gphoto2']['name'], '.'), 1);
					$ext2 = strtolower($ext);
					if($ext2 == "jpeg" || $ext2 == "jpg" || $ext2 == "gif" || $ext2 == "png")
					{
						$theimageinfo = getimagesize($gphoto2);
						if($theimageinfo[2] != 1 && $theimageinfo[2] != 2 && $theimageinfo[2] != 3)
						{
							$gstop = "1";
						}
						else
						{
							$gstop = "0";
						}
					}
					if($gstop == "0")
					{
						$thepp = $pid."-2";
						if($theimageinfo[2] == 1)
						{
							$thepp .= ".gif";
						}
						elseif($theimageinfo[2] == 2)
						{
							$thepp .= ".jpg";
						}
						elseif($theimageinfo[2] == 3)
						{
							$thepp .= ".png";
						}
	
						$myvideoimgnew=$config['pdir']."/".$thepp;
						if(file_exists($myvideoimgnew))
						{
							unlink($myvideoimgnew);
						}
						move_uploaded_file($gphoto2, $myvideoimgnew);
						do_resize_image($myvideoimgnew, "380", "265", false, $config['pdir']."/t/".$thepp);
						do_resize_image($myvideoimgnew, "102", "72", false, $config['pdir']."/t2/".$thepp);
						if(file_exists($config['pdir']."/".$thepp))
						{
							$query = "UPDATE posts SET p2='$thepp' WHERE PID='".mysql_real_escape_string($pid)."'";
							$conn->execute($query);
						}
					}
				}
				$gphoto3 = $_FILES['gphoto3']['tmp_name'];
				if($gphoto3 != "")
				{
					$ext = substr(strrchr($_FILES['gphoto3']['name'], '.'), 1);
					$ext2 = strtolower($ext);
					if($ext2 == "jpeg" || $ext2 == "jpg" || $ext2 == "gif" || $ext2 == "png")
					{
						$theimageinfo = getimagesize($gphoto3);
						if($theimageinfo[2] != 1 && $theimageinfo[2] != 2 && $theimageinfo[2] != 3)
						{
							$gstop = "1";
						}
						else
						{
							$gstop = "0";
						}
					}
					if($gstop == "0")
					{
						$thepp = $pid."-3";
						if($theimageinfo[2] == 1)
						{
							$thepp .= ".gif";
						}
						elseif($theimageinfo[2] == 2)
						{
							$thepp .= ".jpg";
						}
						elseif($theimageinfo[2] == 3)
						{
							$thepp .= ".png";
						}
	
						$myvideoimgnew=$config['pdir']."/".$thepp;
						if(file_exists($myvideoimgnew))
						{
							unlink($myvideoimgnew);
						}
						move_uploaded_file($gphoto3, $myvideoimgnew);
						do_resize_image($myvideoimgnew, "380", "265", false, $config['pdir']."/t/".$thepp);
						do_resize_image($myvideoimgnew, "102", "72", false, $config['pdir']."/t2/".$thepp);
						if(file_exists($config['pdir']."/".$thepp))
						{
							$query = "UPDATE posts SET p3='$thepp' WHERE PID='".mysql_real_escape_string($pid)."'";
							$conn->execute($query);
						}
					}
				}
				if($approve_stories == "1")
				{
					$message = $lang['126'];
				}
				else
				{
					$gurl = $config['baseurl']."/".get_cat_seo($gcat)."/".$pid."/".seo_clean_titles($gtitle);
					$feurl = $config['baseurl']."/feature?id=".$pid;
					header("Location:$feurl");exit;
				}
			}
			else
			{
				STemplate::assign('gtitle',$gtitle);
				STemplate::assign('gcat',$gcat);
				STemplate::assign('gdesc',$gdesc);
				STemplate::assign('ginst',$ginst);
				STemplate::assign('gtags',$gtags);
				STemplate::assign('gdays',$gdays);
				STemplate::assign('gyoutube',$gyoutube);
			}
		}
		else
		{
			$gtitle = cleanit($_REQUEST['quicktitle']);
			STemplate::assign('gtitle',$gtitle);
		}
		$templateselect = "new.tpl";
	}
	elseif($allowposting == "2")
	{
		$error = $lang['498'];
		$templateselect = "new2.tpl";
	}
	else
	{
		$error = $lang['445'];
		$templateselect = "new2.tpl";
	}
	$pagetitle = $lang['61'];
	STemplate::assign('pagetitle',$pagetitle);
}
else
{
	header("Location:$config[baseurl]/");exit;
}

//TEMPLATES BEGIN
STemplate::assign('sm0',"1");
STemplate::assign('error',$error);
STemplate::assign('message',$message);
STemplate::display('header.tpl');
STemplate::display($templateselect);
STemplate::display('footer.tpl');
//TEMPLATES END
?>