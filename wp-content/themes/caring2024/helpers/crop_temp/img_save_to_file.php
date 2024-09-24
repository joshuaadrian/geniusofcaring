<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
    $webPath = '/wp-content/themes/caring/images/uploads/';
    $phpPath = "/nas/content/live/geniusofcaring/wp-content/themes/caring/images/uploads/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);

	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);
			echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
		}
	  else
		{
			
		  $filename = $_FILES["img"]["tmp_name"];
		  $image_filename = str_replace(' ','_',$_FILES["img"]["name"]);
            $whatimage = getimagesize( $filename );
		  list($width, $height) = $whatimage;
          if($_POST['profile']){
            $min_width = 300;
            $min_height = 300;
          }else{
            $min_width = 600;
            $min_height = 400;
          }
          
          if($width < $min_width || $height < $min_height){
                $widthRatio = $min_width / $width;
                $heightRatio = $min_height / $height;
                if($widthRatio > $heightRatio){
                    $multiplyBy = $widthRatio;
                } else {
                    $multiplyBy = $heightRatio;
                }
                $newHeight = $height * $multiplyBy;
                $newWidth = $width * $multiplyBy;
                $whatimage = getimagesize( $filename );
                switch(strtolower($whatimage['mime']))
                {
                    case 'image/png':
                        $new_image = imagecreatefrompng($filename);
                        $type = '.png';
                        break;
                    case 'image/jpeg':
                        $new_image = imagecreatefromjpeg($filename);
                        $type = '.jpeg';
                        break;
                    case 'image/gif':
                        $new_image = imagecreatefromgif($filename);
                        $type = '.gif';
                        break;
                    default: die('image type not supported');
                }
                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($resizedImage, $new_image, 0, 0, 0, 0, $newWidth, 
                            $newHeight, $width, $height);	
                imagejpeg($resizedImage , $phpPath . $image_filename, 100);
                $width = $newWidth;
                $height = $newHeight;

          } else {

              move_uploaded_file($filename,  $phpPath . $image_filename);
          }
		  $response = array(
			"status" => 'success',
			"url" => $webPath.$image_filename,
			"width" => $width,
			"height" => $height
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'something went wrong',
		);
	  }
	  
	  print json_encode($response);

?>
