<?php

	$dbhost = 'localhost';
	$dbname = 'dkctf_om_database';
	
	$dsn = 'mysql:host=localhost;dbname=dkctf_om_database';
	$dbusername = 'mysql.infoschema';
	$dbpassword = 'xkcs*IAUP-X6US4w';
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}