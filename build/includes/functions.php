<?php

//Set global variables, instances are sessions?
$GLOBALS["home"] = "";
$GLOBALS["homedir"] = realpath(__DIR__ . '/..');
$_SESSION["data"] = array(
    "title" => "",
    "author" => "",
    "id" => 0,
    "content" => "",
);

$GLOBALS["title"] = ripData("sitetitle"); //Site title
$GLOBALS["tagline"] = ripData("sitetag"); //Site tagline
$GLOBALS["description"] = ripData("sitedesc"); //Site description
$_SESSION["auth"] = true; //toggled when admin login

if (!isset($GLOBALS["imgs"])) {
	$dir = scandir(realpath(__DIR__.'/../images/thumbs'));
	$ans = array();
	for ($i=2; $i<count($dir); $i++) {
		if ($dir[$i] == ".htaccess") {
			continue;
		}
		array_push($ans, $dir[$i]);
	}
	$GLOBALS["imgs"] = $ans;
}


function ripData($arg) {
	$cPath = realpath(__DIR__.'/../admin/data/')."/site.txt";
	$datas = array();
	foreach(file($cPath) as $line) {
		array_push($datas, $line);
	}
	switch ($arg) {
		case "sitetitle":
			return $datas[0];
			break;
		case "sitetag":
			return $datas[1];
			break;
		case "sitedesc":
			return $datas[2];
			break;
		default:
			return "";
			break;
	}
}
function ripContent($arg) {
	//$GLOBALS["content"]; reset?
	$cPath = realpath(__DIR__.'/../admin/data/')."/content.txt";
	$datas = array();
	foreach(file($cPath) as $line) {
		$subd = preg_split("/[\t]/", $line);
		$ans = array(
			"url" => $subd[0],
			"id" => (int)$subd[1],
			"author" => (int)$subd[2],
			"tdate" => $subd[3],
			"title" => $subd[4],
			"ctnt" => $subd[5]
		);
		array_push($datas, $ans);
	}
	$GLOBALS["content"] = $datas;
}

function putData($name = "", $tag = "", $desc = "") {
	if ($name == "") {$name = $GLOBALS["title"];}
	if ($tag == "") {$tag = $GLOBALS["tagline"];}
	if ($desc == "") {$desc = $GLOBALS["description"];}
	$ccat = "\n";
	$ans = $name.$ccat.$tag.$ccat.$desc;
	echo $ans;
}
function init_theme() {
	
}
function theme_exists() {
	return $GLOBALS["theme"]["valid"];
}
function load_theme() {
	$str = "testTheme";
	if (!is_dir("themes")) {
		mkdir("themes");
	}
	//adding fails due to permissions
	//mkdir("themes/".$str);
	//echo realpath()
	//copy("/admin/sampleTheme/index.php", "themes/".$str."/")
	new_theme("TestTheme", $str);
}
function new_theme($newTitle, $newHandle) {
	$GLOBALS["theme"] = array(
		"title" => $newTitle,
		"valid" => true, //set based on whether the files exist
		"handle" => $newHandle
	);
}

function aln_query() {
    $url = $_SERVER['REQUEST_URI'];
    $_SESSION["baseurl"] = $url;
    $_SESSION["surl"] = explode("/", $url);
    return $url;
}
function determine() {
    $found = false;
    if ($_SESSION["surl"][1] == $GLOBALS["home"]) {
        //include top theme part
        $_SESSION["data"]["content"] = "Working successfully. "."<a href=\"/hi\">Hi</a>";
		$_SESSION["data"]["title"] = "Home";
        $found = true;
    } else if ($_SESSION["surl"][1] == "reset") {
        include("includes/reset.php");
        $found = true;
    } else {
        $sql = "SELECT * FROM entries";
        if ($result = $GLOBALS["db"]->query($sql)) {
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    if ($_SESSION["baseurl"] == $row["url"]) {
                        $_SESSION["data"]["title"] = $row["name"];
                        $_SESSION["data"]["content"] = $row["content"];
						$_SESSION["data"]["id"] = $row["id"];
                        $found = true;
                    }
                }
                if (!$found) {require("parts/aln404.php");}
            }
        }
    }
}
function get_content() {
    echo $_SESSION["data"]["content"];
}
function get_title() {
    echo $_SESSION["dataload"] ? $_SESSION["data"]["title"] : $GLOBALS["title"] . " - " . $_SESSION["data"]["title"];
}
function get_footer() {
    include realpath(__DIR__)."/footer.php";
}
function body_class() {
	$_SESSION["dataload"] = $_SESSION["dataload"] ? false : true;
	if ($_SESSION["auth"]) { //remove false after adding exception to not add margin to /admin/
		return " admin-active";
	}
}





//load last so it can use internal variables
include(realpath(__DIR__."/../parts/functions.php"));