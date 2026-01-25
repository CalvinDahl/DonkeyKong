<?php

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

function validate_data_kong_used($kong_used){	
	if($kong_used == "Funky" || $kong_used == "Cranky" || $kong_used == "Diddy" || $kong_used == "Dixie" || $kong_used == "Default"){
		return true;
	};
	return false;
}

function validate_data_text_length($text,$size){	
	if(strlen($text) <= $size){
		return true;
	};
	return false;
}