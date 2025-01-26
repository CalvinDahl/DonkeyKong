<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	try {
		require_once "dbh.inc.php";
		$query = "SELECT * FROM upload;";
		$stmt = $pdo->prepare($query); 
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		function array_to_csv_download($array, $filename = "dkcrhd_wrs.csv", $delimiter=",") {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename="'.$filename.'";');
			
			$f = fopen('php://output', 'w');

			foreach ($array as $line) {
				fputcsv($f, $line, $delimiter);
			}
		}
		array_to_csv_download($results);
	} catch(PDOException $e){
		die("Query Failed: " . $e->getMessage());
	}
}