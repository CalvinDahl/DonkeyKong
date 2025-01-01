<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	require_once "dbh.inc.php";
	
	$count_all_rows = $pdo->query('select count(*) from changelog')->fetchColumn();;
	
	$query = "SELECT * FROM changelog ORDER BY change_date DESC";
	
	if($_POST['length'] != -1){
		$start = $_POST['start'];
		$length = $_POST['length'];
		$query .=" LIMIT ".$length." OFFSET ".$start."";
	}
	
	$stmt = $pdo->prepare($query);
	
	
	$stmt->execute();

	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$data = array();
	
	foreach ($results as $row){
		$subarray = array();
		$subarray[] = $row['change_log'];
		$subarray[] = $row['change_date'];
		$subarray[] = '<a href="javascript:void(0);" data-id="'.$row['id'].'" class="btn btn-sm btn-success approveBtn">Approve</a> <a 
			href="javascript:void(0);" data-id="'.$row['id'].'" class="btn btn-sm btn-info infoBtn">Info</a> <a 
			href="javascript:void(0);" data-id="'.$row['id'].'" class="btn btn-sm btn-danger denyBtn">Deny</a>';;
		$data[]= $subarray;
	}
	
	$output = array(
		'draw'=>intval($_POST['draw']),
		'recordsTotal'=>$count_all_rows,
		'recordsFiltered'=>$count_all_rows,
		'data'=>$data,
	);
	
	echo json_encode($output);
}