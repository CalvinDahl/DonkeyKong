<?php

function decode_data_nation($nation){
	if($nation != "AA"){
		$path = 'country-flags-main/svg/'.$nation.'.svg';
		return '<img class = "flag" src='.$path.'>';
	} else return "";
}
function decode_data_level_id($level_id){	
	include "level_id_types.inc.php";
	$decode = $level_id_types[$level_id] ?? null;
	if($decode != NULL){
		return $decode;
	} else return $level_id;
}
function decode_data_level_time($level_time){
	$level_time = ltrim($level_time,"0:");
	return $level_time;
}
function decode_data_video_link($video_link,$level_time) {
	$level_time = decode_data_level_time($level_time);
    if($video_link == ""){
		return $level_time;
	} else return '<a href="'.$video_link.'" target="_blank">'.$level_time.'</a>';
}