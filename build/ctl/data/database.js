/**
 * Andrew Nyland, 11/27/17
 * Database related javascript, should be able to leave as a single file for a while
 */

var content;

function updateContentToDone() {
	
}

function updateQueryUrl(e) {
	var query = e.value == "" ? "root" : e.value,
		ans = getContentByUrl(query);
	console.log(query, ans);
	document.getElementById("content-area").innerHTML = ans;
}


//Returns [ideally an ID for reference to] the content,
//	404 if not found, 
function getContentByUrl(q) {
	var ans = document.getElementById(q);
	if (ans === null) {
		return "404";
	}
	return ans.innerHTML;
}