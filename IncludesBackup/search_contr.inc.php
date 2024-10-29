<?php

declare(strict_trypes=1);

function is_input_empty($player,$nation,$level_id,$level_time,$date_set,$kong_used,$video_link){
	if(empty($player) && empty($nation) && empty($level_id) && empty($level_time) && empty($date_set) && empty($kong_used) && empty($video_link)){
		return true;
	}
	return false;
}

function is_results_empty($results){
	if(empty($results)){
		return true;
	}
	return false;
}