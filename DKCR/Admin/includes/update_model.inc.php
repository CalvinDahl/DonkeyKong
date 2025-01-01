<?php

declare(strict_types=1);


function set_old_data(object $pdo,$current_id){

	$query = "SELECT * FROM upload WHERE :current_id = id;";
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":current_id", $current_id);
	
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	return $result;
}

function set_data(object $pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$video_link,$change_log){
	$query = 'REPLACE INTO changelog (id,player,nation,level_id,level_time,date_set,video_link,change_log) VALUES
		(:current_id,:player,:nation,:level_id,:level_time,:date_set,:video_link,:change_log);';
		
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":current_id", $current_id);
	$stmt->bindParam(":player", $player);
	$stmt->bindParam(":nation", $nation);
	$stmt->bindParam(":level_id", $level_id);
	$stmt->bindParam(":level_time", $level_time);
	$stmt->bindParam(":date_set", $date_set);
	$stmt->bindParam(":video_link", $video_link);
	$stmt->bindParam(":change_log", $change_log);
	
	$stmt->execute();
}

function remove_entry(object $pdo,$current_id){
	$query = "DELETE FROM changelog WHERE :current_id = id;";
	$stmt = $pdo->prepare($query);
	
	$stmt->bindParam(":current_id", $current_id);
	
	$stmt->execute();
}