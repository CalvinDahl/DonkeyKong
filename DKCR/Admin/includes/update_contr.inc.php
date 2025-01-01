<?php

declare(strict_types=1);

function decode_data_nation($nation){
	
	$str = file_get_contents(__DIR__ .'/../../../country-flags-main/countries.json');
	$nation_types = json_decode($str,true);
	$decode = $nation_types[$nation] ?? null;
	if($decode != NULL){
		return $decode;
	} else return $nation;
}
function decode_data_level_id($level_id){	
	include "level_id_types.inc.php";
	$decode = $level_id_types[$level_id] ?? null;
	if($decode != NULL){
		return $decode;
	} else return $level_id;
}

function find_changelog_message(object $pdo,$current_id,$player,$nation,$level_id,$level_time,$date_set,$video_link){
	
	$old_data = set_old_data($pdo,$current_id);
	
	$changes = "";
	foreach ($old_data as $old_data){
		if($old_data["player"] != $player){
			$changes .= "Changed Player Name From " . $old_data['player'] . " to " . $player ."! ";
		}
		if($old_data["nation"] != $nation){
			$old_data['nation'] = decode_data_nation($old_data['nation']);
			$nation = decode_data_nation($nation);
			$changes .= "Changed Nation From " . $old_data['nation'] . " to " . $nation ."! ";
		}
		if($old_data["level_id"] != $level_id){
			$old_data['level_id'] = decode_data_level_id($old_data['level_id']);
			$level_id = decode_data_level_id($level_id);
			$changes .= "Changed Level ID From " . $old_data['level_id'] . " to " . $level_id ."! ";
		}
		if($old_data["level_time"] != $level_time){
			$changes .= "Changed Level Time From " . $old_data['level_time'] . " to " . $level_time ."! ";
		}
		if($old_data["date_set"] != $date_set){
			$changes .= "Changed Date Set From " . $old_data['date_set'] . " to " . $date_set ."! ";
		}
		if($old_data["video_link"] != $video_link){
			$changes .= "Changed Video Link From " . $old_data['video_link'] . " to " . $video_link ."! ";
		}
	}
	return $changes;
}

function validate_data_nation($nation){
	
	$str = file_get_contents(__DIR__ .'/../../../country-flags-main/countries.json');
	$nation_types = json_decode($str,true);
	
	$key = array_search($nation,$nation_types);
	return $key;
}
function validate_data_level_id($level_id){	
	include "level_id_types.inc.php";
	
	$key = array_search($level_id,$level_id_types) ?? null;
	if($key != NULL){
		return $key;
	} else return NULL;
}

function validate_data_level_time($level_time)
{
    $pattern ='/^(?:[01]\d|2[0-3]):(?:[0-5]\d):(?:[0-5]\d).(?:\d\d)$/';
    
    if (preg_match($pattern, $level_time)) {
        return true; // Time is valid
    } else {
        return false; // Time is invalid
    }

}

function validate_data_date_set($date_set, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date_set);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && strtolower($d->format($format)) === strtolower($date_set);
}

function validate_data_text_length($text,$size){	
	if(strlen($text) <= $size){
		return true;
	};
	return false;
}