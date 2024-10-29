<?php
try {
	require_once "dbh.inc.php";
	require_once "compare_model.inc.php";
	require_once "compare_view.inc.php";
	require_once "compare_contr.inc.php";
	
	
	//ERROR HANDLER
	collect_compare_data();
	
	
	
	$_SESSION["compare_data"] = $result2;
	
	$pdo = null;
	$stmt = null;
	
} catch (PDOException $e){
	die("Query failed: " . $e->getMessage());
}
?>