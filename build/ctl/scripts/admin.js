var entry, canvas, ctx, changed = false;
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
function uploadImage(imgs) {
	//e.preventDefault();
	var files = imgs;
	if (files.length == 0) {console.log("no files"); return;}
	var repo = new XMLHttpRequest();
	var data = new FormData();
	for (i=0; i<pic.files.length; i++) {
		data.append('pic'+i, pic.files[i]);
	}
	//data.append('pic', pic);
	repo.onreadystatechange = function() {
      	if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
			if (!this.responseText) {
				console.log("no response found");
			}
			console.log(this.responseText);
		}
	};
	repo.open("POST", "fileupload.php", true);
	repo.send(data);
	//return false;
}
function addData(filename, mode, data) {
	var repo = new XMLHttpRequest();
	repo.onreadystatechange = function() {
      	if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
		}
	};
	
	repo.open("GET", data, true);
	repo.send();
}
//Draws image previews on page, 
function handleFileSelect(evt) {
	if (changed) {return;}
	changed = true; //onChange getting called twice fix
	var files = evt.files; // FileList object
	var length = files.length;//files.length;
	for (var j=0; j<length; j++) {
		(function(file, j) {
			var elem = new Image();
			elem.onload = function () {
				console.log(elem);
				ctx.clearRect(0, 0, canvas.width, canvas.height);
				var width = 300;
				var height = width*elem.naturalHeight/elem.naturalWidth;
				canvas.width = (20+width)*(j+1);
				canvas.height = height;
				ctx.drawImage(elem, j*(width+20), 0, width, height);
				goWrap(elem, j);
			}
 			elem.src = URL.createObjectURL(file);
 		})(files[j], j);
	}
}
function goWrap(img, i) {
	return go(img, i);
}
function go(img, i) {
	console.log(img.naturalHeight, img.naturalWidth);
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	var width = 300;
	var height = width*img.naturalHeight/img.naturalWidth;
	canvas.width = (20+width)*(i+1);
	canvas.height = height;
	ctx.drawImage(img, i*(width+20), 0, width, height);
}

function Entry(url, name, id, author, tdate, content, comments, metadata) {
	this.url = url;
	this.id = id;
	this.author = author;
	this.tdate = tdate;
	this.content = content;
	this.comments = comments;
	this.metadata = metadata;
}
onload = function () {
	canvas = document.getElementById("img-preview");
	ctx = canvas.getContext("2d");
	document.getElementById('pic-upload').addEventListener('change', handleFileSelect, false);
	var sections = document.getElementsByClassName("section");
	var sum = 140; //intial position of sections
	for (i=0; i<sections.length; i++) {
		sections[i].style.top = sum + "px";
		sum += sections[i].offsetHeight + 72;
	}
	document.body.style.height = sum + "px";
	//entry = new Entry(
	//	document.getElementById('0-url').innerHTML,
	//	document.getElementById('0-title').innerHTML,
	//	document.getElementById('0-id').innerHTML,
	//	document.getElementById('0-author').innerHTML,
	//	document.getElementById('0-tdate').innerHTML,
	//	document.getElementById('0-content').innerHTML,
	//	document.getElementById('0-comments').innerHTML,
	//	document.getElementById('0-metadata').innerHTML
	//)
	//console.log(entry);
}
function updateContents(elem) {
	var repo = new XMLHttpRequest();
	repo.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    repo.open("POST", "updateContent.php?", true);
	var data = "url=" + encodeURIComponent(entry.url) + "&content" + encodeURIComponent(entry.content);
    repo.send(data);
	return false;
}
function newEntry() {
	var url = encodeURIComponent(document.getElementById("new-url").value),
		title = encodeURIComponent(document.getElementById("new-title").value),
		id = parseInt(document.getElementById("new-id").value),
		author = parseInt(document.getElementById("new-author").value),
		tdate = document.getElementById("new-tdate").value,
		content = encodeURIComponent(document.getElementById("new-content").value),
		comments = encodeURIComponent(document.getElementById("new-comments").value),
		metadata = encodeURIComponent(document.getElementById("new-metadata").value);
	console.log(new Entry(url, title, id, author, tdate, content, comments, metadata));
	var repo = new XMLHttpRequest();
    repo.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
			if (!this.responseText) {
				console.log("didn't access server");
			}
            //location.reload(true);
        }
    };
	var data = "newContent.php?url=" + url + "&title=" + title + "&id=" + id + "&author=" + author + "&tdate=" + encodeURIComponent(tdate) + "&content=" + content;
	console.log(data);
    repo.open("GET", data, true);
    repo.send();
}
function deleteImg(url, elem) {
    var repo = new XMLHttpRequest();
    repo.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
			if (!this.responseText) {
				console.log("didn't access server");
			}
            elem.parentNode.remove();
        }
    }
    repo.open("GET", "photoDelete.php?url=" + url, true);
    repo.send();
}
// create function, it expects 2 values.
function insertAfter(newElement,targetElement) {
    // target is what you want it to go after. Look for this elements parent.
    var parent = targetElement.parentNode;

    // if the parents lastchild is the targetElement...
    if (parent.lastChild == targetElement) {
        // add the newElement after the target element.
        parent.appendChild(newElement);
    } else {
        // else the target has siblings, insert the new element between the target and it's next sibling.
        parent.insertBefore(newElement, targetElement.nextSibling);
    }
}