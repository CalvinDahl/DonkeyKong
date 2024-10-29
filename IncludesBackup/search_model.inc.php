<?php

declare(strict_trypes=1);

function Search_database($pdo, $player, $nation, $level_id, $level_time, $date_set, $kong_used, $video_link){
	$query = "SELECT * FROM upload WHERE 'id' >='1' ";
			
	if($player && !empty($player)){
		$query .= " AND player = :player";
	}
	if($nation && !empty($nation)){
		$query .= " AND nation = :nation";
	}
	if($level_id && !empty($level_id)){
		$query .= " AND level_id = :level_id";
	}
	if($level_time && !empty($level_time)){
		$query .= " AND level_time = :level_time";
	}
	if($date_set && !empty($date_set)){
		$query .= " AND date_set = :date_set";
	}
	if($kong_used && !empty($kong_used)){
		$query .= " AND kong_used = :kong_used";
	}
	if($video_link && !empty($video_link)){
		$query .= " AND video_link = :video_link";
	}

	$query .= " ORDER BY date_set;";
	
	$stmt = $pdo->prepare($query);

	if($player && !empty($player)){
		$stmt->bindParam(":player", $player);
	}
	if($nation && !empty($nation)){
		$stmt->bindParam(":nation", $nation);
	}
	if($level_id && !empty($level_id)){
		$stmt->bindParam(":level_id", $level_id);
	}
	if($level_time && !empty($level_time)){
		$stmt->bindParam(":level_time", $level_time);
	}
	if($date_set && !empty($date_set)){
		$stmt->bindParam(":date_set", $date_set);
	}
	if($kong_used && !empty($kong_used)){
		$stmt->bindParam(":kong_used", $kong_used);
	}
	if($video_link && !empty($video_link)){
		$stmt->bindParam(":video_link", $video_link);
	}

	$stmt->execute();

	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
}