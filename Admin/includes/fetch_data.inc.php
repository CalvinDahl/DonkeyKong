<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	require_once "dbh.inc.php";
	require_once "fetch_data_contr.inc.php";
	require_once "fetch_data_model.inc.php";
	
	$columns = array(
		0 => 'player',
		1 => 'nation',
		2 => 'level_id',
		3 => 'level_time',
		4 => 'date_set',
		5 => 'kong_used',
		6 => 'video_link',
	);
	
	$count_all_rows = $pdo->query('select count(*) from upload')->fetchColumn();
	
	$query = "SELECT * FROM upload ";
	if(isset($_POST['search']['value'])){
		$search_value = $_POST['search']['value'];
		
		$test1 = validate_data_level_id($search_value);
		$test2 = validate_data_nation($search_value);
		if($test1 != NULL){
			$search_value = "%".$test1."%";
			$filtered_rows = filteredDataCount($pdo,$search_value);
			$query .= "WHERE level_id like :search_value ";
		}
		else if($test2 != NULL){
			$search_value = "%".$test2."%";
			$filtered_rows = filteredDataCount($pdo,$search_value);
			$query .= "WHERE nation like :search_value ";
		}
		else{
			$search_value = "%".$search_value."%";
			$filtered_rows = filteredDataCount($pdo,$search_value);
			$query .= " WHERE player like :search_value ";
			$query .= "OR level_time like :search_value ";
			$query .= "OR date_set like :search_value ";
			$query .= "OR kong_used like :search_value ";
		}
	} else $filtered_rows = $count_all_rows;
	
	if(isset($_POST['order'])){
		$column = white_list($columns[$_POST['order'][0]['column']],['player','nation','level_id','level_time','date_set','kong_used','video_link'],"Invalid field name");
		$order = white_list($_POST['order'][0]['dir'],['asc','desc'],"Invalid ORDER BY direction");
		if(($order == 'asc') && ($column == 'level_time' || $column == 'date_set')){
			$order = 'desc';
		} else if(($order == 'desc') && ($column == 'level_time' || $column == 'date_set')){
			$order = 'asc';
		}
		$query .= " ORDER BY ".$column." ".$order."";
	}
	else{
		$query .="ORDER BY id ASC";
	}
	
	if($_POST['length'] != -1){
		$start = $_POST['start'];
		$length = $_POST['length'];
		$query .=" LIMIT ".$length." OFFSET ".$start."";
	}
	
	$stmt = $pdo->prepare($query);
	
	if(isset($_POST['search']['value'])){
		$stmt->bindParam(":search_value", $search_value);
	}
	
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$data = array();
	
	foreach ($results as $row){
		$subarray = array();
		$subarray[] = $row['player'];
		$subarray[] = decode_data_nation($row['nation']);
		$subarray[] = decode_data_level_id($row['level_id']);
		$subarray[] = $row['level_time'];
		$subarray[] = $row['date_set'];
		$subarray[] = $row['kong_used'];
		$subarray[] = $row['video_link'];
		$subarray[] = '<a href="javascript:void(0);" data-id="'.$row['id'].'" class="btn btn-sm btn-info editBtn">Edit</a> <a 
			href="javascript:void(0);" data-id="'.$row['id'].'" class="btn btn-sm btn-danger deleteBtn">Delete</a>';
		$data[]= $subarray;
	}
	
	$output = array(
		'draw'=>intval($_POST['draw']),
		'recordsTotal'=>$count_all_rows,
		'recordsFiltered'=>$filtered_rows,
		'data'=>$data,
	);
	
	echo json_encode($output);
}