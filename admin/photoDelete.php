<?php
$url = $_REQUEST["url"];
echo unlink("../".$url);
echo "\n a deleted $url";
echo " ".unlink("thumbs/".$id)." thumb deleted";