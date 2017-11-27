<?php include "../includes/functions.php"; ?>
<!doctype html>
<html>
    <head>
        <title>Admin - Home</title>
        <style type="text/css">
            img {max-width: 100%;}
        </style>
		<link rel="stylesheet" type="text/css" href="styles/admin.css">
		<script src="scripts/admin.js"></script>
    </head>
    <body class="<?php echo body_class(); ?>">
		<?php include "parts/header.php"; ?>
		<div class="section">
			<div class="highlight">
				<h1>A CMS</h1>
				<p>emulating a filesystem where the content is output via a theme. Can do dynamic (loaded without a new server query, AJAX) and static (generates and caches content via php to html).</p>
				<em>Andrew Nyland</em>
				<h3>Parts</h3>
				<ul>
					<li><a href="data/site.txt">Info</a>
						<ol>
							<li><?php echo $GLOBALS["title"];?></li>
							<li><?php echo $GLOBALS["tagline"];?></li>
							<li><?php echo $GLOBALS["description"];?></li>
						</ol>
						<p><?php str_replace("\n", "<br />", putData());?></p>
					</li>
					<li><a href="data/content.txt">Content</a> - <small><em>Already listed <a href="#edit">below</a></em></small></li>
					<li><a href="data/notes.txt">Notes</a> - <small>also</small> <a href="about">about</a>
						<p><?php echo nl2br(file_get_contents("data/notes.txt", false, null, 0, 200));?></p>
					</li>
				</ul>
			</div>
			<h2 id="edit">Edit</h2>
		</div>
		<div class="section">
			<div class="highlight">
				<?php ripContent(""); query_content(); ?>
			</div>
			<h2 id="media">Media</h2>
		</div>
		<div class="section">
			<div class="highlight">
				<h3>Current Images</h3>
				<?php 
				$dir = "../images/thumbs";
				$imgs = scandir($dir);
				for ($i=2; $i<count($imgs); $i++) {
					if ($imgs[$i] == ".htaccess") {
						continue;
					}
					echo "<div class=\"thumb-img\">";
					echo "<a href=\"/images/".$imgs[$i]."\" target=\"_blank\">";
					echo "<img src=\"/images/thumbs/".$imgs[$i]."\" class=\"thumb\"/>";
					echo "</a>";
					echo "<div onclick=\"deleteImg('images/$imgs[$i]', this)\" class=\"delete-button\">Delete</div>";
					echo "</div>";
				}
				?>
				<div class="clearfix"></div>
				<hr>
				<h3>Upload</h3>
				<form action="" enctype="multipart/form-data" method="POST" onsubmit="uploadImage();" id="inputform">
					<input type="file" name="pic" id="pic-upload" onchange="handleFileSelect(this);" onclick="alert('Doesnt work. No upload.'); return;" multiple/>
					<input type="submit" value="Upload" disabled/>
				</form>
				<canvas id="img-preview">Image preview but your browser doesn't support a canvas.</canvas>
			</div>
		</div>
		<?php get_footer(); ?>
    </body>
</html>