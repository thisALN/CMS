<?php
include "setup.php"; //only have this until reset needs to fully reset the admin part as well, as reset back to either "admin"/"ctl".
echo "GETCWD: ".getcwd()."<br/>";
$cUser = get_current_user();
$workingPath = realpath(__DIR__."/../../");
echo "Working path: ".$workingPath."<br/>";
echo "chown: ".chown($workingPath."/.htaccess", $cUser)."<br/>";
echo "up a few: ".$workingPath;
//generate/fix .htaccess
$htaccess = "<IfModule mod_rewrite.c>\nRewriteEngine On\nRewriteBase /\nRewriteRule ^index\.php$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . /index.php [L]\n</IfModule>";
$hta  = "<IfModule mod_rewrite.c>\nRewriteEngine Off\n</IfModule>";
$pathH = $workingPath."/.htaccess";
file_put_contents($pathH, $htaccess);
echo "success at home";
$pathI = $workingPath."/images/.htaccess";
file_put_contents($pathI, $hta);
echo "success at images";
$pathA = $workingPath."/".$GLOBALS["adminHome"]."/.htaccess";
file_put_contents($pathA, $hta);
echo "success at admin";
//file_put_contents("admin/images/.htaccess", $hta);
//echo "success at admin images";
?>