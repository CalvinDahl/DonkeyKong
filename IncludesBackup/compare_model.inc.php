<?php

declare(strict_types=1);

function collect_compare_data(){
	$query1 = "SELECT * FROM changelog;";
	
	$stmt = $pdo->prepare($query1);
	$stmt->execute();
	$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$query2 = "SELECT * FROM changelog;";
	
	$stmt = $pdo->prepare($query2);
	$stmt->execute();
	$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
}