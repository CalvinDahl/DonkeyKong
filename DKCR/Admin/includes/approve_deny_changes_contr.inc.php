<?php

function decode_changes($pdo,$id,$player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link,$change_log){
	$pattern1 ='/^([A][d][d][e][d][ ][N][e][w][ ][E][n][t][r][y][!])/';
	$pattern2 ='/^([R][e][m][o][v][e][ ][E][n][t][r][y][!])/';
	$pattern3 ='/^([C][h][a][n][g][e][d][ ])/';
	
	if (preg_match($pattern1, $change_log)) {
		//Added New Entry!
		update_data($pdo,$id,$player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link);
		return;
	}
	else if (preg_match($pattern2, $change_log)) {
		//Remove Entry!
		remove_upload_data($pdo,$id);
		return;
	}
	else if (preg_match($pattern3, $change_log)) {
		//Changed
		update_data($pdo,$id,$player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link);
		return;
	}
}