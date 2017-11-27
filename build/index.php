<?php
session_start();
include("includes/functions.php");
//include "includes/first.php";
if (theme_exists()) {
	//load_theme();
	include("themes/testTheme/index.php");
} else {
	echo "no theme found"; //debug, change later
}
?>
<?php //$GLOBALS["db"]->close();
session_destroy();?>