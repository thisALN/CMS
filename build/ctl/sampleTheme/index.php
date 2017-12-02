<?php ?>
<!doctype html>
<html>
	<head>
		<title><?php title(); ?></title>
		<!--RESET-->
		<style type="text/css">
			html, body, img {max-width: 100%;}
		</style>
	</head>
	<body class="<?php echo body_class(); ?>">
		<h1><?php get_title(); ?>Title isn't working yet</h1>
		<small>Implement the theme part to have a fallback for the homepage to do something else. Maybe setup the server (cause it's blank) or something.</small>
		<h2>Content</h2><hr>
		<?php
		ripContent("");
		query_content();
		?>
		<h2>Images</h2><hr>
		<?
		query_imgs();
		?>
		<?php get_content(); get_footer(); ?>
	</body>
</html>