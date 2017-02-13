<?php
include("connect.php");
error_reporting(E_ERROR|E_PARSE);
function showContents($array)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

@mysql_query("INSERT INTO menu(name,url,content,parent) VALUES ('$_POST[name]','$_POST[url]','$_POST[content]','$_POST[parent_id]')");
$id = mysql_insert_id();  
$TARGET_PATH = "images/$id/";
$result = mkdir($TARGET_PATH, 0755); 

foreach($_FILES['image']["tmp_name"] as $key => $tmp_name){
	$galleryimg = $key.$_FILES['image']['name'][$key];
	$file_size = $_FILES['image']['size'][$key];
	$sourceImage = $_FILES['image']['tmp_name'][$key];
	$file_type = $_FILES['image']['type'][$key];
	
	$targetImage = "images/$id/".$galleryimg;
	resizeimgtojpeg($id, $sourceImage, $targetImage, 600,450);
}
//@$image = $_FILES['image']["name"];
//@$sourceImage = $_FILES['image']["tmp_name"];
//@$error = $_FILES['image']['error'];


//resizeimgtojpeg($id, $sourceImage, $image, 600,450);

function resizeimgtojpeg ($id, $sourceImage, $targetImage, $forcedWidth, $forcedHeight, $keepWHRatio = true, $jpegQuality = 75, $deleteOriginal = false)
{
	if(file_exists($sourceImage))
	{
		if ($keepWHRatio == true)
		{
			$sourceSize = getimagesize($sourceImage);
	
			// For a landscape picture or a square
			if ($sourceSize[0] >= $sourceSize[1])
			{
				$finalWidth = $forcedWidth;
				$finalHeight = ($forcedWidth / $sourceSize[0]) * $sourceSize[1];
			}
			// For a potrait picture
			else
			{
				$finalWidth = ($forcedHeight / $sourceSize[1]) * $sourceSize[0];
				$finalHeight = $forcedHeight;
			}
		}
		else
		{
			$finalWidth = $forcedWidth;
			$finalHeight = $forcedHeight;
		}
		
		$sourceID = imagecreatefromstring(file_get_contents($sourceImage));
		$targetID = imagecreatetruecolor($finalWidth, $finalHeight);
		$target_pic = imagecopyresampled($targetID, $sourceID, 0, 0, 0, 0 , $finalWidth, $finalHeight, $sourceSize[0], $sourceSize[1]);
		imagejpeg($targetID,$targetImage);
		imagedestroy($targetID);
		imagedestroy($sourceID);
		
		if ($deleteOriginal && file_exists($sourceImage))
		{ unlink($sourceImage); }
			
		return true;	
	}
	
	else { return false; }
}
  echo "<script type='text/javascript'>alert('You file is uploaded successfully. Thank you!!!');
window.location='http://orakonto.com/wp-admin/mobile-menu-view2.php?post_type=page';
</script>";
exit;
?>
