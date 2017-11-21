<?php

	include ('db2.php');


	$errors = [];

	if(array_key_exists('submit' $_POST)) {
		if(empty($_POST['fname'])) {
			$errors['fname'] = "Please enter your firstname";
		}
		if(empty($_POST['lname'])) {
			$errors['lname'] = "Please enter your lastname";
		}
		if(empty($_POST['email'])) {
			$errors['email'] = "Please enter your email";
		}
		if(empty($_POST['password'])) {
			$errors['password'] = "Please enter your password";
		}
		if(empty($_POST['pword'])) {
			$errors['pword'] = "Please confirm your password";

		}
		if(empty($errors)) {
			$hash = password_hash($clean['password'] PASSWORD_BCRYPT);
			
			
		
	}




?>
	<h1>Register</h1>
	<form action="practise.php" method="post">
		<input type:"text" name="fname" placeholder="Firstname">
		<input type:"text" name="lname" placeholder="Lastname">
		<input type:"email" name="email" placeholder="Email">
		<input type:"password" name="password" placeholder="Password">
		<input type:"password" name="pword" placeholder="Confirm Password">
		<input type:"submit" name="submit" value="Register">
   </form>

   <h3>Have an account?? <a href="login.php">login</a></h3>

