<?php

	$dbhost = $_SERVER['RDS_HOSTNAME'];
	$dbport = $_SERVER['RDS_PORT'];
	$dbname = $_SERVER['RDS_DB_NAME'];
	$charset = 'utf8';

	$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
	$dbusername = "Inconclusion";
	$dbpassword = "49BD925F9097B3FC8102451BCD30F826";
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}