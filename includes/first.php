<?php

mysqli_query( $db, 'SET NAMES "utf8" COLLATE "utf8_general_ci"' );
    if (!$db->query("SELECT * FROM 'entries'")) {
        $db->query("CREATE TABLE entries (
            url VARCHAR(150) PRIMARY KEY NOT NULL,
            name VARCHAR(64) NOT NULL,
            id INT(10),
            author INT(6),
            tdate VARCHAR(8),
            content BLOB,
            comments BLOB,
            metadata BLOB
        )");
		$sql = "INSERT INTO entries (url, name, id, content) VALUES ('/hi', 'Welcome', 0, 'Welcome to this cms thing. Chamge this content at some point, this is a welcome page that you should probably delete. May have useful info on it sometime.')";
    	$db->query($sql);
    }
    if (!$db->query("SELECT * FROM 'users'")) {
        $db->query("CREATE TABLE users (
            name VARCHAR(40),
            username VARCHAR(20) PRIMARY KEY NOT NULL,
            password VARCHAR(32) NOT NULL,
			id INT(6),
            description BLOB,
            sites BLOB,
            articles BLOB,
            level INT(1)
        )");
		$sql = "INSERT INTO users (name, username, password, id, level) VALUES ('admin', 'admin', '', 0, 5)";
    	$db->query($sql);
    }
    init_theme();
	aln_query();
	determine();
	
?>