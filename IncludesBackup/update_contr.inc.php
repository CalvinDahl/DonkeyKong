<?php

declare(strict_types=1);


function find_changelog_message(object $pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link){
	
	$old_data = set_old_data($pdo,$current_id);
	$changes = "";
	foreach ($old_data as $old_data){
		if($old_data["player"] != $player){
			$changes .= "Changed Player Name From " . $old_data['player'] . " to " . $player ."! ";
		}
		if($old_data["nation"] != $nation){
			$changes .= "Changed Nation From " . $old_data['nation'] . " to " . $nation ."! ";
		}
		if($old_data["level_id"] != $level_id){
			$changes .= "Changed Level ID From " . $old_data['level_id'] . " to " . $level_id ."! ";
		}
		if($old_data["level_time"] != $level_time){
			$changes .= "Changed Level Time From " . $old_data['level_time'] . " to " . $level_time ."! ";
		}
		if($old_data["date_set"] != $date_set){
			$changes .= "Changed Date Set From " . $old_data['date_set'] . " to " . $date_set ."! ";
		}
		if($old_data["kong_used"] != $kong_used){
			$changes .= "Changed Kong Used From " . $old_data['kong_used'] . " to " . $kong_used ."! ";
		}
		if($old_data["video_link"] != $video_link){
			$changes .= "Changed Video Link From " . $old_data['video_link'] . " to " . $video_link ."! ";
		}
	}
	return $changes;
}