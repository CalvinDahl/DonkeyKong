<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$level_id = $_POST['level_id'];
	try {
		if(isset($_POST['database'])){
			if($_POST['database'] == "dkcr_tm_database"){
				require_once "dbh2.inc.php";
			}else{
				require_once "dbh.inc.php";
			}
		}
		require_once "fetch_data_contr.inc.php";
		
		$gamemode = "funky";
		$count_all_rows = $pdo->query('select count(*) from upload')->fetchColumn();
		$filtered_rows = $count_all_rows;
		
		$query = "SELECT * FROM upload WHERE level_id = :level_id ORDER BY date_set ASC, level_time DESC";
		$stmt = $pdo->prepare($query);
		$stmt->bindParam(":level_id", $level_id);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$data = array();
		foreach ($results as $row){
			$subarray = array();
			$subarray[] = $row['date_set'];
			$subarray[] = $row['player'];
			$subarray[] = decode_data_nation($row['nation']);
			$subarray[] = decode_data_kong_used($row['kong_used']);
			$subarray[] = decode_data_video_link($row['video_link'],$row['level_time']);
			$data[]= $subarray;
		}

		
		$output = array(
			'draw'=>intval($_POST['draw']),
			'recordsTotal'=>$count_all_rows,
			'recordsFiltered'=>$filtered_rows,
			'data'=>$data,
		);
		
		echo json_encode($output);
	} catch(PDOException $e){
		die("Query Failed: " . $e->getMessage());
	}
}