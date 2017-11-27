<?php
/**
 * Andrew Nyland, 11/27/17
 * Main function file for my CMS
 */

include realpath(__DIR__."/../")."/data/database.php";
DB_config();
$GLOBALS["title"] = getData("sitetitle"); //Site title
$GLOBALS["tagline"] = getData("sitetag"); //Site tagline
$GLOBALS["description"] = getData("sitedesc"); //Site description
$_SESSION["auth"] = true; //toggled when admin login

function init_theme() {
	
}
function theme_exists() {
	return strcmp("full", $GLOBALS["theme"]["valid"]);
}
function load_theme() {
	$str = "testTheme";
	if (!is_dir(realpath(__DIR__."/../../")."/themes")) {
		mkdir("themes");
	}
	//adding fails due to permissions
	//mkdir("themes/".$str);
	//echo realpath()
	//copy("/ctl/sampleTheme/index.php", "themes/".$str."/")
	new_theme("TestTheme", $str);
}
function new_theme($newTitle, $newHandle) {
	$GLOBALS["theme"] = array(
		"title" => $newTitle,
		"valid" => "full", //set based on whether the files exist
		"handle" => $newHandle
	);
}
function get_content() {
    echo $_SESSION["data"]["content"];
}
function get_title() {
    echo $_SESSION["dataload"] ? $_SESSION["data"]["title"] : $GLOBALS["title"] . " - " . $_SESSION["data"]["title"];
}
function get_footer() {
    include realpath(__DIR__."/../")."/parts/footer.php";
}
function body_class() {
	$_SESSION["dataload"] = $_SESSION["dataload"] ? false : true;
	if ($_SESSION["auth"]) { //remove false after adding exception to not add margin to /ctl/
		return " admin-active";
	}
}





//load last so it can use internal variables
include(realpath(__DIR__."/../")."/includes/parts/functions.php");