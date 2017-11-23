<?php

	function validate_error($data, $error_){
	$result = "";
	$error = [];
	if (empty($_POST[$data])){
	$error[$data] = $error_;
	$result = $error[$data];
	}
	return $result;
}

function display_error($data){
	$result = "";
	if (isset($error[$data])){
	$result = $error[$data] . "<br>";
	echo $result;
	}
	return $result;
}

?>