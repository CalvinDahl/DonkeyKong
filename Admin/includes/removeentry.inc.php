<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$current_id = $_POST["id"];
	$change_log = "Remove Entry!";
	
	try {
		if(isset($_POST['db_switch'])){
			if($_POST['db_switch'] == "dkctf_om_database"){
				require_once "dbh2.inc.php";
			}else{
				require_once "dbh.inc.php";
			}
		}
		
		function get_changelog_data($pdo,$id){
			$query = " SELECT * FROM upload WHERE id = :id;";
			$stmt = $pdo->prepare($query);
			
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $results[0];
		}
		function set_data(object $pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link,$change_log){
			$query = 'REPLACE INTO changelog (id,player,nation,level_id,level_time,date_set,kong_used,video_link,change_log) VALUES
				(:current_id,:player,:nation,:level_id,:level_time,:date_set,:kong_used,:video_link,:change_log);';
				
			$stmt = $pdo->prepare($query);
			
			$stmt->bindParam(":current_id", $current_id);
			$stmt->bindParam(":player", $player);
			$stmt->bindParam(":nation", $nation);
			$stmt->bindParam(":level_id", $level_id);
			$stmt->bindParam(":level_time", $level_time);
			$stmt->bindParam(":date_set", $date_set);
			$stmt->bindParam(":kong_used", $kong_used);
			$stmt->bindParam(":video_link", $video_link);
			$stmt->bindParam(":change_log", $change_log);
			
			$stmt->execute();
		}
		
		$values = get_changelog_data($pdo,$current_id);
		set_data($pdo,$current_id,$values["player"],$values["nation"],$values["level_id"],$values["level_time"],$values["date_set"],$values["kong_used"],$values["video_link"],$change_log);
		
		$pdo = null;
		$stmt = null;
		
		$data = array(
			'status'=>'success',
		);
		echo json_encode($data);
		die();
	} catch (PDOException $e){
		$data = array(
			'status'=>'failed',
		);
		echo json_encode($data);
		die("Query failed: " . $e->getMessage());
	}	
}