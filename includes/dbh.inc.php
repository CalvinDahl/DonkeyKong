<?php
	
	define('DBHOST', getenv('DBHOST'));
	define('RDSPORT', getenv('RDSPORT'));
	define('DBUSER', getenv('DBUSER'));
	define('DBPASS', getenv('DBPASS'));
	
	$dbhost = "dkc-database.crqcoww6k3x3.us-east-2.rds.amazonaws.com";
	$dbport = "3306"
	$dbname = 'dkctf_database';
	$charset = 'utf8mb3' ;

	$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
	$dbusername = "USERNAME_REMOVED";
	$dbpassword = "PASSWORD_REMOVED";
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}