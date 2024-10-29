<?php

function white_list(&$value, $allowed, $message) {
    if ($value === null) {
        return $allowed[0];
    }
    $key = array_search($value, $allowed, true);
    if ($key === false) { 
        throw new InvalidArgumentException($message); 
    } else {
        return $value;
    }
}

function validate_data_nation($nation){
	
	$str = file_get_contents(__DIR__ .'/../../country-flags-main/countries.json');
	$nation_types = json_decode($str,true);
	
	$key = array_search($nation,$nation_types) ?? null;
	if($key != NULL){
		return $key;
	} else return NULL;
}
function validate_data_level_id($level_id){	
	include "level_id_types.inc.php";
	
	$key = array_search($level_id,$level_id_types) ?? null;
	if($key != NULL){
		return $key;
	} else return NULL;
}

function decode_data_nation($nation){
	
	$str = file_get_contents(__DIR__ .'/../../country-flags-main/countries.json');
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
