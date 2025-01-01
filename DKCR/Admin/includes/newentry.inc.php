<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$player = $_POST["player"];
	$nation = $_POST["nation"];
	$level_id = $_POST["level_id"];
	$level_time = $_POST["level_time"];
	$date_set = $_POST["date_set"];
	$video_link = $_POST["video_link"];
	$change_log = "Added New Entry!";
	
	try {
		require_once "dbh.inc.php";
		require_once "newentry_contr.inc.php";
		
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
		
		if(!array_filter($errors)){
			$query = 'INSERT INTO changelog (player,nation,level_id,level_time,date_set,video_link,change_log) VALUES
				(:player,:nation,:level_id,:level_time,:date_set,:video_link,:change_log);';
			
			$stmt = $pdo->prepare($query);
			
			$stmt->bindParam(":player", $player);
			$stmt->bindParam(":nation", $nation);
			$stmt->bindParam(":level_id", $level_id);
			$stmt->bindParam(":level_time", $level_time);
			$stmt->bindParam(":date_set", $date_set);
			$stmt->bindParam(":video_link", $video_link);
			$stmt->bindParam(":change_log", $change_log);
			$stmt->execute();
			
			$errors['status'] = "success";
		}
		require_once 'config_session.inc.php';
		if(isset($_SESSION['user_id'])){
			$username = $_SESSION['user_id'];
			$query = 'UPDATE Users SET Contributions = Contributions + 1 WHERE username = :username;';
			$stmt = $pdo->prepare($query);
			
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			
			$pdo = null;
			$stmt = null;
		}
		echo json_encode($errors);
		
	} catch (PDOException $e){
        $errors = array(
            'status'=>'failed'
        );
		echo json_encode($errors);
	}
}