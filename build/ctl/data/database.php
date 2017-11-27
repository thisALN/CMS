<?php
/**
 * Andrew Nyland, 11/27/17
 * API interface to get data from a custom database for the CMS
 */

//vars
$GLOBALS["siteData"] = array();
$contents = array();


//instantiate
function DB_config() {
	
	ripData();
	ripContent();
}


function leftoverSetup() {
	if (!isset($GLOBALS["imgs"])) {
		$p = realpath(__DIR__."/../../")."/images/thumbs/";
		$dir = scandir($p);
		$ans = array();
		for ($i=2; $i<count($dir); $i++) {
			if ($dir[$i] == ".htaccess") {
				continue;
			}
			array_push($ans, $dir[$i]);
		}
		$GLOBALS["imgs"] = $ans;
	}
}


function getData($arg) {
	switch ($arg) {
		case "sitetitle":
			return $GLOBALS["siteData"][0];
			break;
		case "sitetag":
			return $GLOBALS["siteData"][1];
			break;
		case "sitedesc":
			return $GLOBALS["siteData"][2];
			break;
		default:
			return "";
			break;
	}
}

function ripData() {
	$cPath = realpath(__DIR__."/../")."/data/site.txt";
	foreach(file($cPath) as $line) {
		array_push($GLOBALS["siteData"], $line);
	}
}

function ripContent() {
	$cPath = realpath(__DIR__."/../")."/data/content.txt";
	$output = array();
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
		$output[$ans["url"]] = $ans["ctnt"];
	}
	$contents = $output;
	return $contents;
}
function getAllContent() {
	//$GLOBALS["content"]; reset?
	$cPath = realpath(__DIR__."/../")."/data/content.txt";
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
	return $datas;
}

function putData($name = "", $tag = "", $desc = "") {
	if ($name == "") {$name = $GLOBALS["title"];}
	if ($tag == "") {$tag = $GLOBALS["tagline"];}
	if ($desc == "") {$desc = $GLOBALS["description"];}
	$ccat = "\n";
	$ans = $name.$ccat.$tag.$ccat.$desc;
	echo $ans;
}

function putContent() {
	
}