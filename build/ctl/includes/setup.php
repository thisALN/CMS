<?php
$admin_home = "ctl";
$site_home = "";
$images_home = "images";
$GLOBALS["home"] = "";
$GLOBALS["homedir"] = realpath(__DIR__ . '/..');
session_start();
$_SESSION["data"] = array(
    "title" => "",
    "author" => "",
    "id" => 0,
    "content" => "",
);
//capture and analyze request query
$url = $_SERVER['REQUEST_URI'];
$_SESSION["fullUrl"] = $url;
$_SESSION["urlParts"] = explode("/", $url);
//bring in the troops
include("functions.php");