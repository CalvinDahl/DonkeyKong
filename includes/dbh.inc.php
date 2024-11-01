<?php
	define('DBHOST', getenv('DBHOST'));
	define('RDSPORT', getenv('RDSPORT'));
	define('DBUSER', getenv('DBUSER'));
	define('DBPASS', getenv('DBPASS'));
	
	$dbhost = DBHOST;
	$dbport = RDSPORT;
	$dbname = 'dkctf_database';
	$charset = 'utf8mb3' ;

	$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
	$username = DBUSER;
	$password = DBPASS;
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}