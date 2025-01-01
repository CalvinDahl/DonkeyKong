<?php

function level_query($pdo,$level_id){
	$query = "SELECT * FROM upload
	WHERE level_id = :level_id
	AND level_time = (SELECT :level_id, MIN(level_time) FROM upload)
	ORDER BY date_set DESC
	LIMIT 3";
	
	$query = "SELECT *,MIN(level_time) OVER (PARTITION BY level_id
            ORDER BY date_set ASC) AS min_time
		FROM upload";
	
	
	$query = "SELECT *
		FROM
		(
		SELECT *, ROW_NUMBER() OVER (PARTITION BY level_id
            ORDER BY date_set ASC) AS min_time FROM upload
		)X
		WHERE min_time < 6";
	
	$query = "SELECT *
		FROM
		(
		SELECT *, MIN(level_time) OVER (PARTITION BY level_id
            ORDER BY date_set ASC) AS min_time FROM upload
		)X
		WHERE level_time = min_time";	
	
	$stmt = $pdo->prepare($query); 
	$stmt->bindParam(":level_id", $level_id);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}
