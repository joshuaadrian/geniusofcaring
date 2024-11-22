<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/

$imgUrl = '/nas/content/live/geniusofcaring' . $_POST['imgUrl'];
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];

$jpeg_quality = 100;
$rand = rand();
$image_filename = str_replace(' ','_',str_replace('/wp-content/themes/caring2024/images/uploads/','',$_POST['imgUrl']));
$time = time();
$php_file = "/nas/content/live/geniusofcaring/wp-content/themes/caring2024/images/uploads/cropped/".$image_filename.'-'.$rand . $time;
$php_thumb = "/nas/content/live/geniusofcaring/wp-content/themes/caring2024/images/uploads/cropped/".$image_filename.'-'.$rand . $time . '_thumb';
$web_file = "/wp-content/themes/caring2024/images/uploads/cropped/".$image_filename.'-'.$rand . $time;

$what = getimagesize($imgUrl);
switch(strtolower($what['mime']))
{
    case 'image/png':
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.png';
        break;
    case 'image/jpeg':
		$source_image = imagecreatefromjpeg($imgUrl);
		$type = '.jpeg';
        break;
    case 'image/gif':
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.gif';
        break;
    default: die('image type not supported');
}
	
	$resizedImage = imagecreatetruecolor($imgW, $imgH);
	imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, 
				$imgH, $imgInitW, $imgInitH);	
	
    imagedestroy($source_image);
	
	$dest_image = imagecreatetruecolor($cropW, $cropH);
	imagecopyresampled($dest_image, $resizedImage, 0, 0, $imgX1, $imgY1, $cropW, 
				$cropH, $cropW, $cropH);	


	imagejpeg($dest_image, $php_file.'.jpeg', $jpeg_quality);
    imagedestroy($resizedImage);
	
	$thumbImage = imagecreatetruecolor(300, 300);
	imagecopyresampled($thumbImage, $dest_image, 0, 0, 250, 0, 300, 
				300,300, 300);	

	imagejpeg($thumbImage, $php_thumb.'.jpeg', $jpeg_quality);
    imagedestroy($dest_image);
    imagedestroy($thumbImage);
	
	$response = array(
			"status" => 'success',
			"url" => $web_file.'.jpeg' 
		  );
	 print json_encode($response);

?>