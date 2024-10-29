<?php
	/*
	$dsn = "mysql:host=localhost;dbname=dkctf_database";
	$dbusername = "root";
	$dbpassword = "";
	*/
	
	$dbhost = $_SERVER['RDS_HOSTNAME'];
	$dbport = $_SERVER['RDS_PORT'];
	$dbname = $_SERVER['RDS_DB_NAME'];
	$charset = 'utf8mb3' ;

	$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
	$username = $_SERVER['RDS_USERNAME'];
	$password = $_SERVER['RDS_PASSWORD'];
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}