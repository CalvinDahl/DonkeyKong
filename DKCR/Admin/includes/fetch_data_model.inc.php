<?php

function filteredDataCount($pdo,$search_value){
	$query = "SELECT count(*) FROM upload";
	$query .= " WHERE player like :search_value ";
	$query .= "OR nation like :search_value ";
	$query .= "OR level_id like :search_value ";
	$query .= "OR level_time like :search_value ";
	$query .= "OR date_set like :search_value ";
	$query .= "OR kong_used like :search_value; ";	
	$stmt = $pdo->prepare($query); 
	$stmt->bindParam(":search_value", $search_value);
	$stmt->execute();
	$result = $stmt->fetchColumn();
	return $result;
}