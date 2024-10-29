<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$current_id = $_POST["id"];
	$player = $_POST["player"];
	$nation = $_POST["nation"];
	$level_id = $_POST["level_id"];
	$level_time = $_POST["level_time"];
	$date_set = $_POST["date_set"];
	$kong_used = $_POST["kong_used"];
	$video_link = $_POST["video_link"];
	
	try {
		require_once "dbh.inc.php";
		require_once "update_model.inc.php";
		require_once "update_view.inc.php";
		require_once "update_contr.inc.php";
		
		//ERROR HANDLERS
		$change_log = find_changelog_message($pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link);
		if($change_log != ""){
			set_data($pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link,$change_log);
		}else{
			remove_entry($pdo,$current_id);
		}
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