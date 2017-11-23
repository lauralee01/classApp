<?php 
	session_start();
	include('include/db.php');
	include('include/function.php');

	if (array_key_exists('login', $_POST)) {
		$error = [];
		validate_error('username', 'Please type in a name');
		validate_error('password', 'Please type in a password');

		if (empty($error)) {
			
			$query = mysqli_query($db, "SELECT * FROM user WHERE username = '".$_POST['username']."' AND user_password = '".$_POST['password']."'") or die(mysqli_error($db));
			if (mysqli_num_rows($query) == 1) {
				$fetch = mysqli_fetch_array($query);

				$_SESSION['user_id'] = $fetch['user_id'];
				$_SESSION['username'] = $fetch['username'];
				header("Location:index.php");
			}
			else{
				echo "invalid credentials";
			}
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h3> Login</h3>
	<form method="POST">
		<input type="text" name="username" placeholder="Username"><br>
		<?php echo validate_error('username', 'enter username'); ?>
		<input type="password" name="password" placeholder="Password"><br>
		<?php if (isset($done)){ echo $done; } ?>
		<input type="submit" name="login" value="Login"><br>
		<a href="register.php">New User? Register</a>
	</form>
</body>
</html>