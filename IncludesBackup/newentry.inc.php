<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$player = $_POST["player"];
	$nation = $_POST["nation"];
	$level_id = $_POST["level_id"];
	$level_time = $_POST["level_time"];
	$date_set = $_POST["date_set"];
	$kong_used = $_POST["kong_used"];
	$video_link = $_POST["video_link"];
	$change_log = "Added New Entry!";
	
	try {
		require_once "dbh.inc.php";
		
		$query = 'INSERT INTO changelog (player,nation,level_id,level_time,date_set,kong_used,video_link,change_log) VALUES
			(:player,:nation,:level_id,:level_time,:date_set,:kong_used,:video_link,:change_log);';
			
		$stmt = $pdo->prepare($query);
		
		$stmt->bindParam(":player", $player);
		$stmt->bindParam(":nation", $nation);
		$stmt->bindParam(":level_id", $level_id);
		$stmt->bindParam(":level_time", $level_time);
		$stmt->bindParam(":date_set", $date_set);
		$stmt->bindParam(":kong_used", $kong_used);
		$stmt->bindParam(":video_link", $video_link);
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