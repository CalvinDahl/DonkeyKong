<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id = $_POST["id"];
	$database = $_POST["database"];
	
	if(isset($_POST['db_switch'])){
		if($_POST['db_switch'] == "dkcr_tm_database"){
			require_once "dbh2.inc.php";
		}else{
			require_once "dbh.inc.php";
		}
	}
	require_once "fetch_single_data_contr.inc.php";
	
	if(validate_database($database)){
		$query = " SELECT * FROM ".$database." WHERE id = :id LIMIT 1;";
		$stmt = $pdo->prepare($query);
		
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($results as $result){
			$result['level_id'] = decode_data_level_id($result['level_id']);
			$result['nation'] = decode_data_nation($result['nation']);
		}
		$pdo = null;
		$stmt = null;
		
		echo json_encode($result);
	} else echo 'failed query';
}