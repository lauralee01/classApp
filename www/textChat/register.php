<?php 

	include('include/db.php');
	include('include/function.php');

	if (array_key_exists('register', $_POST)) {
		$error = [];
		validate_error('username', 'Please type in a name');
		validate_error('password', 'Please type in a password');
		
		if (empty($error)) {
			$query = mysqli_query($db, "INSERT INTO user VALUES (NULL, '".$_POST['username']."', '".$_POST['password']."')") or die(mysqli_error($db));
			$done = "user added";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<h3> Register</h3>
	<form method="POST">
		<input type="text" name="username" placeholder="Username"><br>
		<?php echo display_error('username'); ?>
		<input type="password" name="password" placeholder="Password"><br>
		<?php echo display_error('password'); ?><br>
		<input type="submit" name="register" value="Register"><br>
		<?php if (isset($done)){ echo $done; } ?>
		<a href="login.php">Login</a>
	</form>
</body>
</html>