<?php
	declare(strict_types=1);
	
	function get_user(object $pdo, string $username){
		$query = "SELECT * FROM users WHERE username = :username;";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":username",$username);
		$stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function create_user(object $pdo){
		$username = "";
		$password = "";
		$options = [
			'cost' => 12
		];
		$hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);
		$query = "INSERT INTO users (username, pwd) VALUES (:username, :hashedPwd);";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":hashedPwd",$hashedPwd);
		$stmt->bindParam(":username",$username);
		$stmt->execute();
	}