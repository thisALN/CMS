<?php
$_SESSION['imgI'] = 0;
function query_imgs() {
	for ($i=0; $i<count($GLOBALS["imgs"]); $i++) {
		echo "<img src=\"/images/thumbs/".$GLOBALS["imgs"][$i]."\"/>"; //"thumbs" instead of "images" due to bandwidth load
	}
}
function query_content() {
	ripContent();
	$dat = getAllContent("");
	echo "<div class=\"content-wrap-test\">";
	echo "<div class=\"subcontent-test\">";
	for ($i=0; $i<count($dat); $i++) {
		if ($i > 0) {
			echo "</div>";
			echo "<div class=\"subcontent-test\">";
		}
		echo "<h1>".$dat[$i]["title"]."</h1>";
		echo "<small><b>ID:</b> ".$dat[$i]["id"]." | <b>By</b>  ".$dat[$i]["author"]." <b>@</b> <code>".$dat[$i]["url"]."</code></small>";
		echo "<p>".$dat[$i]["ctnt"]."</p>";
	}
	echo "</div></div>";
}

function query_media() {
	query_images();
}
function query_images() {
	//query by database entries not files
	$dir = realpath(__DIR__."/../../../")."/images";
	$imgs = scandir($dir);
	array_shift($imgs);
	array_shift($imgs);
	echo "<div id=\"admin-image-collage\">";
	for ($i=0; $i<count($imgs); $i++) {
		echo "<img src=\"/images/thumbs/".$imgs[$i]."\" id=\"img-".$i."\"/>";
	}
	echo "</div>";
}

function title() {
	echo $GLOBALS["title"].' - '.$GLOBALS["tagline"];
}
