<?php
function newTable() {
    
}
/*
update entry:
	content
	url
	title
	//others later, these for now
*/
function updateEntryContent($id, $content) {
	$go = "UPDATE entries SET content='$content' WHERE id='$id'";
	$GLOBALS["db"]->query($go);
}
function updateEntryURL($id, $url) {
	$go = "UPDATE entries SET url='$url' WHERE id='$id'";
	$GLOBALS["db"]->query($go);
}
function updateEntryTitle($id, $title) {
	$go = "UPDATE entries SET name='$title' WHERE id='$id'";
	$GLOBALS["db"]->query($go);
}