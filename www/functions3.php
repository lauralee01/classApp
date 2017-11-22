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
	function adminLogin($dbconn, $input) {
		$result = [];

		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");

		$stmt->bindParam(':e', $input['email']);

		$stmt->execute();

		$count = $stmt->rowCount();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($count != 1 || !password_verify($input['password'], $row['hash'])) {
			$result[] = false;
		} else {
			$result[] = true;
			$result[] = $row;
		}
		return $result;
	}
	function addCategory($dbconn, $input) {

		$stmt = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:catName)");

		$stmt->bindParam(':catName', $input['cat_name']);

		$stmt->execute();

		 }
	function checkLogin() {
		if(!isset($_SESSION['aid']))  {
			header("Location: login.php");
		}
	}
	function redirect($location, $msg) {
		header("Location: ".$location.$msg);
	}
	function viewCategory($dbconn) {
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM category");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
			$result .= '<tr><td>'.$row[0].'</td>';
			$result .= '<td>'.$row[1].'</td>';
			$result .= '<td><a href="edit_category.php?cat_id='.$row[0].'">edit</a></td>';
			$result .= '<td><a href="delete_category.php?cat_id='.$row[0].'">delete</a></td></tr>';
		}
		return $result;
	}
	function getCategoryById($dbconn, $id) {

		$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_id=:catId");

		$stmt->bindParam(':catId', $id); 

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);

		return $row;
	}
	function updateCategory($dbconn, $input) {

		$stmt = $dbconn->prepare("UPDATE category SET category_name=:catName WHERE category_id=:catId");

		$data =[
			":catName" => $input['cat_name'],
			":catId" =>$input['id']
		];

		$stmt->execute($data);
	}
	function curNave($page) {
		$curPage = basename($_SERVER['SCRIPT_FILENAME']);

		if($curPage == $page) {
			echo 'class="selected"';
		}
	}
	function deleteCategory($dbconn, $input) {

		$stmt = $dbconn->prepare("DELETE FROM category WHERE category_id=:catId AND category_name=:catName");

		$data = [
			":catName" => $input['cat_name'],
			":catId" => $input['id']
		];

		$stmt->execute($data);
	}
	function numeric($input) {

		$result = false;

		if(!is_numeric($input)) {

			$result = true;
		}
		return $result;
	}
	function addProducts($dbconn, $input, $id) {

		$stmt = $dbconn->prepare("INSERT INTO books(title, author, price, publication_date, quantity, category_id)VALUES(:t, :a, :p, :pD, :q, :cId)");

		$data = [

			":t" => $input['title'],
			":a" => $input['author'],
			":p" => $input['price'],
			":pD" => $input['pub_date'],
			":q" => $input['quantity'],
			":cId" => $id

		];
		$stmt->execute($data);
	}
?>