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

$rquery = "select PID from posts order by PID asc"; 
$rresults = $conn->execute($rquery);
$p = $rresults->getrows();
for($i=0;$i<count($p);$i++)
{
	$PID = $p[$i]['PID'];
	echo "Processing Gig #".$PID."... please wait... ";	
	
		$query = "select good, bad from ratings where PID='".mysql_real_escape_string($PID)."'"; 
		$results=$conn->execute($query);
		$f = $results->getrows();
		$t = 0;
		$grat = 0;
		$brat = 0;
		for($k=0;$k<count($f);$k++)
		{
			$tgood = $f[$k]['good'];
			$tbad = $f[$k]['bad'];
			if($tgood == "1")
			{
				$grat++;	
			}
			elseif($tbad == "1")
			{
				$brat++;	
			}
		}
		$g = $grat;
		$b = $brat;
		$t = $g + $b;
		if($t > 0)
		{
			$r = (($g / $t) * 100);
			$gr = round($r, 1);
		}
		else
		{
			$gr = 0;
		}
		
	echo "*** Feedback: ".$t." ";
	echo "Rating: ".$gr."% *** ";
	echo "Gig #".$PID." Completed.<br />";
	
	$uquery = "UPDATE posts SET rating='".$gr."', rcount='".$t."' WHERE PID='".mysql_real_escape_string($PID)."'";
	$conn->execute($uquery);
}
echo "All gigs have been processed, you can delete this file now.";

?>