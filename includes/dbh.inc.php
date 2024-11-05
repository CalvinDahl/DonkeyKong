<?php

	$dbhost = 'localhost';
	$dbname = 'dkctf_database';
	
	$dsn = 'mysql:host=localhost;dbname=dkctf_database';
	$dbusername = 'USERNAME_REMOVED';
	$dbpassword = 'PASSWORD_REMOVED';
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}