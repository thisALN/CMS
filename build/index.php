<?php
//Set global variables, instances are sessions?
include "ctl/includes/setup.php";
if (theme_exists()) {
	load_theme(); //sets global.theme, keep them loaded indefinitely somehow if future
	include("themes/".$GLOBALS["theme"]["handle"]."/index.php");
} else {
	//echo "no theme found"; //debug, change later
	new_theme("TestTheme", "testTheme");
	echo $_SESSION["baseurl"] . "anotha1".theme_exists();;
	load_theme();
}
session_destroy();
?>