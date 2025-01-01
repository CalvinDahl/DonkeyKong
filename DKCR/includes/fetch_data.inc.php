<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	try {
		require_once "dbh.inc.php";
		require_once "fetch_data_contr.inc.php";
		
		$count_all_rows = $pdo->query('select count(*) from upload')->fetchColumn();
		$filtered_rows = $count_all_rows;
		
		$query = "SELECT *
		FROM
		(
		SELECT *,
		MIN(level_time) OVER (PARTITION BY level_id) AS min_time,
		RANK() OVER (PARTITION BY level_id ORDER BY date_set ASC) AS rank_partition
		FROM upload
		)X
		WHERE level_time = min_time";
		$stmt = $pdo->prepare($query); 
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$data = array();
		foreach ($results as $row){
			$subarray = array();
			$subarray[] = decode_data_level_id($row['level_id']);
			$subarray[] = $row['player'];
			$subarray[] = decode_data_nation($row['nation']);
			$subarray[] = $row['date_set'];
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