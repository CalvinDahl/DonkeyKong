<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$check_date = $_POST['check_date'];
	$start_date = $_POST['start_date'];
	try {
		require_once "dbh.inc.php";
		require_once "fetch_rankingpage_data_model.inc.php";
		require_once "fetch_data_contr.inc.php";
		
		$gamemode = "funky";
		$count_all_rows = $pdo->query('select count(*) from upload')->fetchColumn();
		$filtered_rows = $count_all_rows;
		
		if($gamemode == "original"){
			$query = "SELECT * FROM upload WHERE level_id = :level_id ORDER BY date_set ASC, level_time DESC";
		}else if($gamemode == "funky"){
			if($_POST['level_id'] == "All"){
				$results = model_all_levels($pdo,$check_date,$start_date);
			}else{
				$level_id_page = $_POST['level_id'];
				
				$results = model_levels($pdo,$check_date,$start_date,$level_id_page);
			}
		}
		
		$data = array();
		$i = 1;
		foreach ($results as $row){
			$subarray = array(
				'rank' => $i,
				'player' => $row['player'],
				'nation' => decode_data_nation($row['nation']),
				'total_wr' => $row['total_wr'],
				'total_duration' => $row['total_duration'],
				'game_percent' => ''.$row['game_percent'].' %',
				'unique_wr' => $row['unique_wr'],
			);
			$data[] = $subarray;
			$i++;
		}
		
		echo json_encode($data);
	} catch(PDOException $e){
		die("Query Failed: " . $e->getMessage());
	}
}