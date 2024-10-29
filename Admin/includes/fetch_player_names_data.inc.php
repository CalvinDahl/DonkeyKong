<?php
	require_once "dbh.inc.php";
	$query = "SELECT DISTINCT player FROM upload;";
	$stmt = $pdo->prepare($query); 
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($results);