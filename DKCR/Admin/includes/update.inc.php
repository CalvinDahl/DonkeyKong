<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$current_id = $_POST["id"];
	$player = $_POST["player"];
	$nation = $_POST["nation"];
	$level_id = $_POST["level_id"];
	$level_time = $_POST["level_time"];
	$date_set = $_POST["date_set"];
	$video_link = $_POST["video_link"];
	
	try {
		require_once "dbh.inc.php";
		require_once "update_model.inc.php";
		require_once "update_contr.inc.php";
		
		//ERROR HANDLERS
		$errors['status'] = "";
		
		if(!validate_data_text_length($player,30)){
			$errors['status'] = "".$errors['status']."Player Name Too Long!   ";
		}
		
		$eval = validate_data_nation($nation);
		if(!$eval){
			$errors['status'] = "".$errors['status']."Invalid Nation!   ";
		} else $nation = $eval;
		
		$eval = validate_data_level_id($level_id);
		if(!$eval){
			$errors['status'] = "".$errors['status']."Invalid Level Id!   ";
		} else $level_id = $eval;
		
		if(!validate_data_level_time($level_time)){
			$errors['status'] = "".$errors['status']."Invalid Level Time!   ";
		}
		
		if(!validate_data_date_set($date_set)){
			$errors['status'] = "".$errors['status']."Invalid Date!   ";
		}
		
		if(!validate_data_text_length($video_link,255)){
			$errors['status'] = "".$errors['status']."Video Link Too Long!   ";
		}
		
		if ($errors['status'] == ""){
			$errors['message'] = find_changelog_message($pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$video_link);
			if($errors['message'] != ""){
				set_data($pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$video_link,$errors['message']);
			}else{
				remove_entry($pdo,$current_id);
			}
		}
		$pdo = null;
		$stmt = null;
		
		echo json_encode($errors);
		die();
	} catch (PDOException $e){
		die("Query failed: " . $e->getMessage());
	}
}