<?php
$_SESSION['imgI'] = 0;
function query_imgs() {
	for ($i=0; $i<count($GLOBALS["imgs"]); $i++) {
		echo "<img src=\"/images/thumbs/".$GLOBALS["imgs"][$i]."\"/>"; //"thumbs" instead of "images" due to bandwidth load
	}
}
function query_content() {
	echo "<div class=\"content-wrap-test\">";
	echo "<div class=\"subcontent-test\">";
	for ($i=0; $i<count($GLOBALS["content"]); $i++) {
		if ($i > 0) {
			echo "</div>";
			echo "<div class=\"subcontent-test\">";
		}
		echo "<h1>".$GLOBALS["content"][$i]["title"]."</h1>";
		echo "<small><b>ID:</b> ".$GLOBALS["content"][$i]["id"]." | <b>By</b>  ".$GLOBALS["content"][$i]["author"]." <b>@</b> <code>".$GLOBALS["content"][$i]["url"]."</code></small>";
		echo "<p>".$GLOBALS["content"][$i]["ctnt"]."</p>";
	}
	echo "</div></div>";
}
function title() {
	echo $GLOBALS["title"].' - '.$GLOBALS["tagline"];
}
