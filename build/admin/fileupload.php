<?php
//Andrew Nyland
$dir = "../images";
if (!is_dir($dir."/thumbs")) {
	mkdir($dir."/thumbs");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$tmpFile = $_FILES['pic']['tmp_name'];
	$newFile = $dir."/".$_FILES['pic']['name'];
	$result = move_uploaded_file($tmpFile, $newFile);
	echo $_FILES['pic']['name'];
	$img = imagecreatefromjpeg($newFile);
    	$width = imagesx($img);
	$w = 350;
	$ratio = $w/$width;
	$height = imagesy($img);
	$h = $ratio*$height;
	$new_img = imagecreatetruecolor($w, $h);
	imagecopyresampled($new_img, $img, 0, 0, 0, 0, $w, $h, $width, $height);
	imagejpeg($new_img, $dir."/thumbs/".$_FILES['pic']['name'], 75);
}
?>