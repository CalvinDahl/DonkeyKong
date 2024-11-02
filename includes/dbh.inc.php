<?php

	$dbhost = "localhost";
	$dbname = 'dkctf_database';
	$charset = 'utf8';

	$dsn = "mysql:host={$dbhost};dbname={$dbname};charset={$charset}";
	$dbusername = "USERNAME_REMOVED";
	$dbpassword = "PASSWORD_REMOVED";
	
	try {
		$pdo = new PDO($dsn, $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}