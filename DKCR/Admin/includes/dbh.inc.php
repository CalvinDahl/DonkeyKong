<?php
	$dsn = "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_NAME3');
	$dbusername = getenv('DB_USER');
	$dbpassword = getenv('DB_PASS');
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}