<?php

function get_changelog_data($pdo,$id){
	$query = " SELECT * FROM changelog WHERE id = :id LIMIT 1;";
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":id", $id);
	$stmt->execute();
	
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $results[0];
}

function remove_changelog_data($pdo,$id){
	$query = " DELETE FROM changelog WHERE id = :id LIMIT 1;";
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":id", $id);
	$stmt->execute();
}

function update_data($pdo,$id,$player,$nation,$level_id,$level_time,$date_set,$video_link){
	$query = 'REPLACE INTO upload (id,player,nation,level_id,level_time,date_set,video_link) VALUES
		(:id,:player,:nation,:level_id,:level_time,:date_set,:video_link);';
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":id", $id);
	$stmt->bindParam(":player", $player);
	$stmt->bindParam(":nation", $nation);
	$stmt->bindParam(":level_id", $level_id);
	$stmt->bindParam(":level_time", $level_time);
	$stmt->bindParam(":date_set", $date_set);
	$stmt->bindParam(":video_link", $video_link);
	
	$stmt->execute();
}

function remove_upload_data($pdo,$id){
	$query = " DELETE FROM upload WHERE id = :id LIMIT 1;";
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":id", $id);
	$stmt->execute();
}