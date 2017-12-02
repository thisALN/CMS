
/**
 *Args: (a) action- options are (a) append, (d) delete, (e) edit
 					if (e) is set, title/url input is required
 (t,u,i,c,d) title/url/id/author/date
 [added later] - (don't look at previous until totally working) "details" is assumed to be a complete/valid set of data for that entry and containing 5 parts.
*/

function assertMuted(action, details) {
	var repo = new XMLHttpRequest();
	repo.onreadystatechange = function() {
      	if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
			if (!this.responseText) {
				console.log("no response found");
			}
			alert(this.responseText);
		}
	};
	repo.open("GET", formRequest(action, details), true);
}

function formRequest(action, details) {
	var outAction = "", outMD = "";
	switch (action) {
		case "d":
			//delete
			outAction = "d";
			break;
		case "e":
			//edit
			outAction = "e";
			//reassign old data to be rewritten even tho wasn't changed
		case "a" :
			//append
			outAction = "a";
			break;
	}
	outMD = encodeURI(
		details[0] + "," + 
		details[1] + "," + 
		details[2] + "," + 
		details[3] + "," + 
		details[4]);
	var str = "edit.php?action="+outAction+"&metadata="+outMD;
	return str;
}

function watch(argg) {
	for (i=0; i<argg.length; i++) {
		argg[i].addEventListener("blur", function() {
			//assertMuted();
		})
	}
}


// from gist.github.com/revolunet/843889
// LZW-compress a string
function lzw_encode(s) {
    var dict = {};
    var data = (s + "").split("");
    var out = [];
    var currChar;
    var phrase = data[0];
    var code = 256;
    for (var i=1; i<data.length; i++) {
        currChar=data[i];
        if (dict[phrase + currChar] != null) {
            phrase += currChar;
        }
        else {
            out.push(phrase.length > 1 ? dict[phrase] : phrase.charCodeAt(0));
            dict[phrase + currChar] = code;
            code++;
            phrase=currChar;
        }
    }
    out.push(phrase.length > 1 ? dict[phrase] : phrase.charCodeAt(0));
    for (var i=0; i<out.length; i++) {
        out[i] = String.fromCharCode(out[i]);
    }
    return out.join("");
}

// Decompress an LZW-encoded string
function lzw_decode(s) {
    var dict = {};
    var data = (s + "").split("");
    var currChar = data[0];
    var oldPhrase = currChar;
    var out = [currChar];
    var code = 256;
    var phrase;
    for (var i=1; i<data.length; i++) {
        var currCode = data[i].charCodeAt(0);
        if (currCode < 256) {
            phrase = data[i];
        }
        else {
           phrase = dict[currCode] ? dict[currCode] : (oldPhrase + currChar);
        }
        out.push(phrase);
        currChar = phrase.charAt(0);
        dict[code] = oldPhrase + currChar;
        code++;
        oldPhrase = phrase;
    }
    return out.join("");
}