<?php /*
File: functions.php */
function queryEntriesByID($id) {
	//takes an ID as int and returns by where
	//assumes only one entrie per ID
	$sql = "SELECT * FROM entries WHERE id='$id'";
	if ($result = $GLOBALS["db"]->query($sql)) {
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
	}
}
function queryEntriesByURL($url) {
	//takes an url as int and returns by where
	//assumes only one entrie per ID
	$sql = "SELECT * FROM entries WHERE url='$url'";
	if ($result = $GLOBALS["db"]->query($sql)) {
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		else {return false;}
	} else {return "Failed to connect to sql";}
}
function updateContentByURL($url, $content) {
	$sql = "UPDATE entries SET content='$content' WHERE url='$url'";
}
function updateContentByID($id, $content) {
	$sql = "UPDATE entries SET content='$content' WHERE id='$id'";
}
function addEntry($url, $title, $id, $author, $tdate, $content) {
	$sql = "INSERT INTO 'entries' ('url', 'title', 'id', 'author', 'tdate', 'content') VALUES ($url, $title, $id, $author, $tdate, $content)";
	if ($result = $GLOBALS["db"]->query($sql)) {
		return result;
	} else {
		return false;
	}
	
}