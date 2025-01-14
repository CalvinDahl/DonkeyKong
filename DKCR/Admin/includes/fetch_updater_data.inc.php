<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){	

	try {
		require_once 'dbh.inc.php';
		$count_all_rows = $pdo->query('select count(*) from users')->fetchColumn();
		$filtered_rows = $count_all_rows;
		
		$query = "SELECT username, Contributions FROM users ORDER BY Contributions ASC";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$data = array();
		foreach ($results as $row){
			$subarray = array();
			$subarray[] = $row['username'];
			$subarray[] = $row['Contributions'];
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