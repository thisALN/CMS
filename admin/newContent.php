<?php
include "../includes/functions.php";
include "functions.php";
$db = loadDB();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	echo
	$url = $_GET["url"];
	$title = $_GET["title"];
	$id = $_GET["id"];
	$author = $_GET["author"];
	$tdate = $_GET["tdate"];
	$content = $_GET["content"];
	//echo addEntry($url, $title, $id, $author, $tdate, $content);
	$sql = "INSERT INTO 'entries' ('url', 'title', 'id', 'author', 'tdate', 'content') VALUES ($url, $title, $id, $author, $tdate, $content)";
	if ($result = $db->query($sql)) {
		echo result;
	} else {echo "no success";echo mysql_error(); echo $db;}
	echo "received data ". $content . " called " . $title;
	//echo $GLOBALS["db"]->query("SELECT * FROM entries WHERE id=$id")->fetch_assoc()["url"];
} else {echo "no request received";}