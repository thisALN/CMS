<?php
/**
 * Andrew Nyland, 11/27/17
 * Visual output of just the data in the database and a testing of interaction interfaces
 */

include "database.php";

function listurls() {
	$valls = array_keys($contents);
	foreach ($valls as $v) {
		echo $v." ".$valls[$v]."</br>"."working";
	}
}

$onelines = array(
	"siteTitle",
	"siteTagline"
);
$oneliner = "siteDescription";
DB_config();
$parts = array(getData("sitetitle"), getData("sitetag"), getData("sitedesc"));

?>
<!doctype html>
<html>
	<head>
		<title>Database access</title>
		<style type="text/css">
			table {border-collapse: collapse; width: 100%;}
			tr {border-bottom: 1px solid #777;}
			td {border-right: 1px solid #555;}
			#commands {
				float: right;
				display: block;
				width: 25%;
				min-width: 200px;
				margin: 0; padding: 0; list-style-type: none;
			}
			.clean {
				list-style-type: none;
				margin: 0;
				padding: 1em;
			}
		</style>
		<script src="../scripts/communique.js"></script>
		<script>
			function newEntry() {
				var title = prompt("Give your entry a title:"),
					url = prompt("The URL at which your post lives"),
					id = document.getElementsByClassName("scootchy").length,
					author = 0,
					newD = new Date(),
					date = newD.toLocaleDateString()+"@"+newD.getHours()+":"+newD.getMinutes()+":"+newD.getSeconds();
				console.log(title, url, id, author, date);
				//save to server - [saved [from form calling]] edit.php
				assertMuted("a", [title, url, id, author, date]);
			}
		</script>
	</head>
	<body>
		<h1>Database output and mutation</h1><a href="../data/view.php">DB Home</a> - <a href="/">Full home</a>
		<form action="" name="updatun" method="get" autocomplete="off">
			<table>
				<tr>
					<th>Output</th>
					<th>Input</th>
				</tr>
				<tr>
					<td><h2>Site.data (<?php echo count($GLOBALS["siteData"]); ?>)</h2>
					<ul>
						<?php foreach ($GLOBALS["siteData"] as $it) : ?>
							<li><?php echo $it; ?></li>
						<?php endforeach; ?>
						</ul>
					</td><td>
						<?php
						for ($i=0; $i<count($onelines); $i++) : ?>
							<label><?php echo $onelines[$i]; ?></label><br/>
							<input type="text" name="<?php echo $onelines[$i]; ?>" id="<?php echo $onelines[$i]; ?>-input" value="<?php echo $parts[$i]; ?>" class="updateable"/><br/>
						<?php
						endfor; ?>
						<label><?php echo $oneliner; ?></label><hr>
						<textarea name="<?php echo $oneliner; ?>" id="<?php echo $oneliner; ?>-input" class="updateable" style="width: 100%; height: 200px; padding: 0; border: none;"><?php echo $parts[2]; ?></textarea>
					</td>
				</tr>
				<tr>
					<td><h2><div id="commands"><button onclick="newEntry();">New Entry</button></div>Site.content (<?php $ctnt = getAllContent(); echo count($ctnt); ?>)</h2>
					<table>
						<caption>Metadata (?)</caption>
						<tr>
							<th>Title</th>
							<th>URL</th>
							<th>ID</th>
							<th>Author</th>
							<th>Date</th>
						</tr>
						<?php for($k=0; $k<count($ctnt); $k++) :?>
							<tr><?php echo "<td>".$ctnt[$k]["title"]."</td><td>".$ctnt[$k]["url"]."</td><td>".$ctnt[$k]["id"]."</td><td>".$ctnt[$k]["author"]."</td><td>".$ctnt[$k]["tdate"]."</td>"; ?></tr>
						<?php endfor; ?>
						<tr>
							<ul class="clean">
								<?php for ($l=0; $l<$k; $l++) : ?>
									<li class="scootchy">
										<p>
											<sub>
												<?php echo $ctnt[$l]["id"]; ?>
											</sub>
											<?php $ans = $ctnt[$l]["url"]; echo "<em><small><code>".$ans."</code></small></em>"; ?>: 
												<code class="<?php echo $ans; ?>" id="<?php $ans = str_replace("/", "", $ans); echo $ans; if ($ctnt[$l]["id"] == 0) {echo "root";} ?>">
													<?php echo $ctnt[$l]["ctnt"]; ?>
												</code></p></li>
								<?php endfor; ?>
							</ul>
						</tr>
					</table>
					</td>
					<td>
						<?php
						//type to input url, can use to test responsiveness of content fetching by url apis ?>
						<br/>
						<label>URL input</label><hr><br/><small>Type in a url to search for and the content will be displayed (and editable) below.</small>
						<input type="text" name="url" onkeyup="updateQueryUrl(this);" onblur="updateQueryUrl(this);" id="url-input" style="min-width: 350px;"/><br/>
						<textarea name="content" id="content-area" onblur="updateContentToDone();" style="width: 100%; height: 300px; min-width: 350px; padding: 10px 0; border: none;">Input an entry to see its content...</textarea><br/>
					</td>
				</tr>
			</table>
			<noscript>
				<input type="submit"/>
			</noscript>
		</form>
		<script src="database.js"></script>
	</body>
</html>