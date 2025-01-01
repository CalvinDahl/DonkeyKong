<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$id = $_POST["id"];
	$approved = $_POST["approved"];
	require_once "dbh.inc.php";
	require_once "approve_deny_changes_model.inc.php";
	require_once "approve_deny_changes_contr.inc.php";
	
	$data = get_changelog_data($pdo,$id);
	
	if($approved){
		decode_changes($pdo,$data['id'],$data['player'],$data['nation'],$data['level_id'],$data['level_time'],
			$data['date_set'],$data['video_link'],$data['change_log']);
	}
	remove_changelog_data($pdo,$id);
	
	$data = array(
		'status'=>'success',
	);
	$pdo = null;
	$stmt = null;
	echo json_encode($data);
}