<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$player = $_POST["player"];
	$nation = $_POST["nation"];
	$level_id = $_POST["level_id"];
	$level_time = $_POST["level_time"];
	$date_set = $_POST["date_set"];
	$kong_used = $_POST["kong_used"];
	$video_link = $_POST["video_link"];
	
	try {
		require_once "dbh.inc.php";
		require_once "search_model.inc.php";
		require_once "search_view.inc.php";
		require_once "search_contr.inc.php";
		
		
		// ERROR HANDLE
		$errors = [];
		$results = [];
		if(!is_input_empty($player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link)){
			$results = Search_database($con, $player, $nation, $level_id, $level_time, $date_set, $kong_used, $video_link);
			if(is_results_empty($results)){
				$errors["no_results"] = "No Results!";
			}
		} else{
			$errors["no_input"] = "Try Searching For Something!";
		}
		require_once "config_session.inc.php";
		
		if($errors){
			$_SESSION["search_errors"] = $errors;
		}
		
		$searchData = [
			"player" => $player,
			"nation" => $nation,
			"level_id" => $level_id,
			"level_time" => $level_time,
			"date_set" => $date_set,
			"kong_used" => $kong_used,
			"video_link" => $video_link
		];
		$_SESSION["search_data"] = $searchData;
		
		$_SESSION["search_results"] = $results;
		
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

?>
