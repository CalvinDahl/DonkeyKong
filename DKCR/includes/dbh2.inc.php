<?php

	$dbhost = 'localhost';
	$dbname = 'dkcr_tm_database';
	
	$dsn = 'mysql:host=localhost;dbname=dkcr_tm_database';
	$dbusername = 'USERNAME_REMOVED';
	$dbpassword = 'PASSWORD_REMOVED';
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}