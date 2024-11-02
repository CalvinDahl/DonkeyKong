<?php

	$dbhost = getenv(DBHOST);
	$dbport = getenv(RDSPORT);
	$dbname = 'dkctf_database';
	$charset = 'utf8';

	$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
	$dbusername = getenv(DBUSER);
	$dbpassword =  getenv(DBPASS);
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}