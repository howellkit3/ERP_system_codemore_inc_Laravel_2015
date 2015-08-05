<?php
/**
 * Image resize while uploading
 * @author Resalat Haque
 * @link http://www.w3bees.com/2013/03/resize-image-while-upload-using-php.html
 */
 
/**
 * Image resize
 * @param int $width
 * @param int $height
 */
class ImageUploader {

	function resize($data,$time = null,$folder = 'meta_value'){


		$img_tmp = $data['tmp_name'];
		$name = $data['name'];
		$type = $data['type'];

		if(!empty($data['x'])) {
			$x = $data['x'];
			$y = $data['y'];
			$new_width = $data['w'];
			$new_height = $data['h'];

			$image_info = getimagesize($img_tmp);
			$source_width = $image_info[0];
			$source_height = $image_info[1];

			$ratio = max($new_width/$source_width, $new_height/$source_height);

			$imgString = file_get_contents($img_tmp);
			$image = imagecreatefromstring($imgString);
			$tmp = imagecreatetruecolor($new_width, $new_height);
			imagecopy($tmp, $image, 0, 0, $x, $y, $new_width, $new_height);
			$folder_path = WWW_ROOT.'/img/uploads/'.$folder.'/';

			if (!file_exists($folder_path)) {
				mkdir($folder_path, 0777, true);
			}
			$image_name = $time.'_'.round($width)."x".$height."_".str_replace(' ','_',$name);
            $path = $folder_path.$image_name;

		} else {

			list($w, $h) = getimagesize($img_tmp);
			/* calculate new image size with ratio */
			$width = $w;
			$height = $h;
			$ratio = max($width/$w, $height/$h);
			$h = ceil($height / $ratio);
			$x = ($w - $width / $ratio);
			$w = ceil($width / $ratio);
			/* new file name */
			/* read binary data from image file */
			$imgString = file_get_contents($img_tmp);
			/* create image from string */
			$image = imagecreatefromstring($imgString);
			$tmp = imagecreatetruecolor($width, $height);
			imagecopy($tmp, $image,0, 0,$x, 0,$width, $height);

			$folder_path = WWW_ROOT.'/img/uploads/'.$folder.'/';

			if (!file_exists($folder_path)) {
				mkdir($folder_path, 0777, true);
			}
			$image_name = $time.'_'.round($width)."x".$height."_".str_replace(' ','_',$name);
            $path = $folder_path.$image_name;
       
		}
		

		switch ($type) {
			case 'image/jpeg':
				imagejpeg($tmp, $path, 70);
				break;
			case 'image/png':
				imagepng($tmp, $path, 9);
				break;
			case 'image/gif':
				imagegif($tmp, $path, 70);
				break;
			default:
				exit;
				break;
		}
		return $image_name;
		/* cleanup memory */
		imagedestroy($image);
		imagedestroy($tmp);
	}
}