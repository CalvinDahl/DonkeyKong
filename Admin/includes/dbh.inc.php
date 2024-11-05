<?php

	$dsn = 'mysql:host=localhost;dbname=dkctf_database';
	$dbusername = getenv('DBUSER');
	$dbpassword = getenv('DBPASS');
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}