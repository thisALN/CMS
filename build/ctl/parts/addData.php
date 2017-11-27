<?php
$filename = $_REQUEST['name'];
$mode = $_REQUEST['m'];
$data = urldecode($_REQUEST['data']);
switch ($mode) {
	case "a":
		file_put_contents("data/".$filename.".txt", "\n".$data, FILE_APPEND);
		break;
	case "r":
		file_put_contents("data/".$filename.".txt", "\n".$data);
		break;
echo file_get_contents("data/".$filename.".txt");
?>