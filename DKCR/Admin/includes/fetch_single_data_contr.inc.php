<?php

function validate_database($database){
	if(($database == " upload ") || ($database == " changelog ")){
		return true;
	} else return false;
}
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