<?php
class tool{
	public function secToMs($secToMsa, $secToMsb = 5000){
	    if (is_string($secToMsa)){
	        if ( preg_match("/[0-9]/", substr($secToMsa, 0, -1)) ){
	            if ( substr($secToMsa, -1) === 's' ){
	                $secToMsa = (substr($secToMsa, 0, -1))*1000;
	            } else {
	                return $secToMsb;
	            }
	        } elseif ( !preg_match("/[0-9]{1,11}/", $secToMsa) ) {
	            return $secToMsb;
	        }
	    }
	    return $secToMsa;
	}
	public function rndString($rndStringa = 16) {
	    $rndStringb = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $rndStringc = strlen($rndStringb);
	    $rndStringd = "";
	    for ($i = 0; $i < $rndStringa; $i++) {
	        $rndStringd .= $rndStringb[rand(0, $rndStringc - 1)];
	    }
	    return $rndStringd;
	}
	public function png2jpg($filePath){
		$image = imagecreatefrompng($filePath);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		imagedestroy($image);
		$quality = 100; // 0 = worst / smaller file, 100 = better / bigger file
		imagejpeg($bg, $filePath . ".jpg", $quality);
		imagedestroy($bg);
	}
	public function outputJpg($file){
		if (file_exists($file)){
			if(exif_imagetype($file) == IMAGETYPE_JPEG){
				$type = 'image/jpeg';
				header('Content-Type:'.$type);
				header('Content-Length: ' . filesize($file));
				readfile($file);
			} else {
				die('ERROR: util.tools.php -> outputJpg -> file not JPG');
			}
		} else {
			die('ERROR: util.tools.php -> outputJpg -> file does not exist');
		}
	}
}
