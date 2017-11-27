<?php
session_start();
echo "working";
include("includes/functions.php");
echo "again";
if (theme_exists() || true) {
	load_theme(); //sets global.theme, keep them loaded indefinitely somehow if future
	query_data();
	include("themes/".$GLOBALS["theme"]["handle"]."/index.php");
} else {
	//echo "no theme found"; //debug, change later
	echo $_SESSION["baseurl"] . "anotha";
	load_theme();
}
session_destroy();?>