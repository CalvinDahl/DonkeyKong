<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$check_date = $_POST['check_date'];
	try {
		if(isset($_POST['database'])){
			if($_POST['database'] == "dkctf_om_database"){
				require_once "dbh2.inc.php";
			}else{
				require_once "dbh.inc.php";
			}
		}
		require_once "fetch_data_contr.inc.php";
		
		$count_all_rows = $pdo->query('select count(*) from upload')->fetchColumn();
		$filtered_rows = $count_all_rows;
		
		if($_POST['level_id'] == "All"){
			
			$query = "SELECT *
			FROM(
				SELECT
					*,
					SUM(Y.datedifference) OVER (PARTITION BY level_id,level_time 
												ORDER BY date_set DESC, level_time DESC) AS difference
					FROM(
						SELECT
							*,
							DATEDIFF(next_date,date_set) AS datedifference
							FROM( 
								SELECT
								*,
								COALESCE(
									(LEAD(date_set,1) OVER( 
										PARTITION BY level_id 
										ORDER BY date_set ASC, level_time DESC
									)
									),:check_date
								) AS next_date
								FROM upload WHERE date_set <= :check_date
						) AS X
					) AS Y
				) AS Z
			WHERE difference >= 0
			ORDER BY difference DESC";
			
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(":check_date", $check_date);
		}else{
			$level_id_page = $_POST['level_id'];
			
			$query = "SELECT *
			FROM(
				SELECT
					*,
					SUM(Y.datedifference) OVER (PARTITION BY level_id,level_time 
												ORDER BY date_set DESC, level_time DESC) AS difference
				FROM(
					SELECT
						*,
						DATEDIFF(next_date,date_set) AS datedifference
						FROM( 
							SELECT
							*,
							COALESCE(
								(LEAD(date_set,1) OVER( 
									PARTITION BY level_id
									ORDER BY date_set ASC, level_time DESC
								)
								),:check_date
							) AS next_date
							FROM upload WHERE level_id = :level_id_page AND date_set <= :check_date
						) AS X
					) AS Y
				) AS Z
			WHERE difference >= 0
			ORDER BY difference DESC";
			
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(":check_date", $check_date);
			$stmt->bindParam(":level_id_page", $level_id_page);
		}
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$data = array();
		$i = 1;
		foreach ($results as $row){
			$subarray = array(
				'rank' => $i,
				'level_id' => decode_data_level_id($row['level_id']),
				'player' => $row['player'],
				'nation' => decode_data_nation($row['nation']),
				'kong_used' => decode_data_kong_used($row['kong_used']),
				'level_time' => decode_data_video_link($row['video_link'],$row['level_time']),
				'date_set' => $row['date_set'],
				'difference' => decode_data_difference($row['difference']),
				'current' => decode_data_current_wr($row['next_date'],$check_date)
			);
			$data[] = $subarray;
			$i++;
		}
		
		echo json_encode($data);
	} catch(PDOException $e){
		die("Query Failed: " . $e->getMessage());
	}
}