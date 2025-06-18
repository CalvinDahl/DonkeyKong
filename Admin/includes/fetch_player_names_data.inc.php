<?php
	if(isset($_POST['db_switch'])){
		if($_POST['db_switch'] == "dkctf_om_database"){
			require_once "dbh2.inc.php";
		}else{
			require_once "dbh.inc.php";
		}
	}
	$query = "SELECT DISTINCT player FROM upload;";
	$stmt = $pdo->prepare($query); 
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($results);