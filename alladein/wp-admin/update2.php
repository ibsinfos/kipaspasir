<?php
include("connect.php");
error_reporting(E_ERROR | E_PARSE);
$id = $_POST['ID'];
function showContents($array)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

$TARGET_PATH = "images/$id/";
$result = mkdir($TARGET_PATH, 0755);

foreach($_FILES['image']["tmp_name"] as $key => $tmp_name){
	$galleryimg = $key.$_FILES['image']['name'][$key];
	$file_size = $_FILES['image']['size'][$key];
	$sourceImage = $_FILES['image']['tmp_name'][$key];
	$file_type = $_FILES['image']['type'][$key];
	
	$targetImage = "images/$id/".$galleryimg;
	resizeimgtojpeg($id, $sourceImage, $targetImage, 215,80);
}

//@$image = $_FILES['image']["name"];
//@$sourceImage = $_FILES['image']["tmp_name"];
//@$error = $_FILES['image']['error'];

$sql="UPDATE mainmenu SET name='$_POST[name]',url='$_POST[url]',parent='$_POST[parent_id]',content='$_POST[content]' WHERE ID = '$id'";
mysql_query($sql) or die (mysql_error());
mysql_close();

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
window.location='http://v2.ncn.com.my/wp-admin/mobile-menu-view2.php?post_type=page';
</script>";
exit;
?>
