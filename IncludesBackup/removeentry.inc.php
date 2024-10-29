<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$current_id = $_POST["id"];
	$change_log = "Remove Entry!";
	
	try {
		require_once "dbh.inc.php";
		
		$query = "UPDATE changelog SET change_log = :change_log WHERE id = :current_id;";
		
		$stmt = $pdo->prepare($query);
		
		$stmt->bindParam(":current_id", $current_id);
		$stmt->bindParam(":change_log", $change_log);
		
		$stmt->execute();
		
		$pdo = null;
		$stmt = null;
		
		header("Location: ../index.php");
		
		die();
	} catch (PDOException $e){
		die("Query failed: " . $e->getMessage());
	}
	
} else{
	header("Location: ../index.php");
}