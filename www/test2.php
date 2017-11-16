<?php

	include("functions/functions.php");
	
	define('MAX_FILE_SIZE', '2097152');
	$ext = ['image/jpg', 'image/jpeg', 'image/png'];

	if(array_key_exists('save', $_POST)) {
		//print_r($_FILES);
		$errors = [];

		$name = $_FILES['pics']['name'];
		$size = $_FILES['pics']['size'];
		$tmp_name = $_FILES['pics']['tmp_name'];

		$file = picupload($name, $size, $tmp_name);
		
		if(!in_array($_FILES['pics']['type'], $ext)) {
			$errors[] = "File format not supported";
		}
		if(empty($errors)) {
			echo "File upload successful";
		} else {
			foreach ($errors as $err) {
				echo $err.'</br>';
			}
		}
	}



?>



<form id="register" method="POST", enctype="multipart/form-data">
	<p>Please upload a picture</p>
	<input type="file" name="pics">
	

	<input type="submit" name="save">

</form>