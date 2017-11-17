<?php

	function uploadFile($files, $name, $loc) {
		$result = [];

		$rnd = rand(0000000000, 9999999999);
		$strip_name = str_replace(' ', '_', $files['$name']['name'] );

		$fileName = $rnd.$strip_name;
		$destination = $loc.$filename;

		if(move_uploaded_file($file[$name]['tmp_name'], $destination)) {
			$result[] = true;
		}else {
			$result[] = false;
		}

		return $result;
	}
	function doAdminRegister($dbconn, $input) {
		$hash = password_hash($input['password'], PASSWORD_BCRYPT);

		$stmt = $dbconn->prepare("INSERT INTO admin(firstName, lastName, email, hash)
			VALUES(:f, :l, :e, :h)");

		$data = [
			":f" => $input['fname'],
			":l" => $input['lname'],
			":e" => $input['email'],
			":h" => $hash
		];

		$stmt->execute($data);
	}
	function doesEmailExist($dbconn, $email) {
		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admin WHERE :e=email");

		$stmt->bindParam(":e", $email);

		$stmt->execute();

		$count = $stmt->rowCount();
		if($count > 0) {
			$result = true;
		}

		return $result;
	}
	
	function displayErrors($errors, $name) {
		$result = "";

		if(isset($errors[$name])) {
			$result = '<span class=err>'.$errors[$name].'</span>';
		}
		return $result;
	}

	function validateLogin($dbconn, $email, $password) {
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE :e=email");

		$stmt->bindParam(":e", $email);

		$stmt->execute();

			while($fetch=$stmt->fetch(PDO::FETCH_ASSOC)) {
				$hash = $fetch['hash'];
				if(password_verify($password,$hash)) {
					$result = true ;
				} else {
					$result = false;
				}
				return $result;
			}


	}

?>