<?php

	$dbhost = "localhost";
	$dbname = 'dkctf_database';
	$charset = 'utf8';

	$dsn = "mysql:host={$dbhost};dbname={$dbname};charset={$charset}";
	$dbusername = "mysql.infoschema";
	$dbpassword = "xkcs*IAUP-X6US4w";
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}