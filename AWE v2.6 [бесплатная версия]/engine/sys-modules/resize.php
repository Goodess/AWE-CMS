<?php
Header('Content-type: image/png');
Header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
Header('Cache-Control: no-store, no-cache, must-revalidate');
Header('Cache-Control: post-check=0, pre-check=0', FALSE);
Header('Pragma: no-cache');

$needle_width = addslashes($_GET['width']);
$needle_height = addslashes($_GET['height']);
$source_file = addslashes(str_replace('https://', 'http://', $_GET['source']));

list($width, $height) = getimagesize($source_file);
$image = imagecreatefromstring(file_get_contents($source_file));

if(empty($needle_height)) {
	$needle_height = ($height/$width)*$needle_width;
}

$temp = imagecreatetruecolor($needle_width, $needle_height);
imagecopyresampled($temp, $image, 0, 0, 0, 0, $needle_width, $needle_height, $width, $height);

imagepng($temp);
imagedestroy($image);
imagedestroy($temp);
?>