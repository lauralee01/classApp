<?php 
	session_start();
	include('include/db.php');
	include('include/function.php');
	echo "Logged in as " . $_SESSION['username'] . "<br>";


	if (array_key_exists("user_id", $_SESSION)) {
	$reciever_id = $_GET['id'];
	$query2 = mysqli_query($db,"SELECT * FROM user WHERE user_id = '".$reciever_id."' ") or die(mysqli_error($db));
	$fetch = mysqli_fetch_array($query2);
	echo '<h3>Chat with ' . $fetch['username'] . " - Id " . $reciever_id . '</h3>';

	$error = [];
	if (array_key_exists('send', $_POST)) {
		validate_error('text', 'Please type in a message');
		if (empty($error)) {

			$query_send = mysqli_query($db, "INSERT INTO text_msg VALUES(NULL, 
				'".$_POST['text']."',
				'".$_SESSION['user_id']."',
				'".$_GET['id']."',
				 NOW())
				") or die(mysqli_error($db));
			$done = "message sent";
		}
	}

	$fetch_messages = "SELECT * FROM text_msg WHERE sender_id = '".$_SESSION['user_id']."' AND reciever_id = '".$reciever_id."'";
	$messages = mysqli_query($db, $fetch_messages) or die(mysqli_error($db));
	while ($result = mysqli_fetch_array($messages)){
		echo "<p>" .$_SESSION['username']. " - " . $result['msg'] . "</p>";
	}
	$fetch_messages2 = "SELECT * FROM text_msg WHERE reciever_id = '".$_SESSION['user_id']."' AND sender_id = '".$reciever_id."'";
	$messages2 = mysqli_query($db, $fetch_messages2) or die(mysqli_error($db));
	while ($result2 = mysqli_fetch_array($messages2)){
		echo "<p>" . $fetch['username'] . " - " . $result2['msg'] . "</p>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
</head>
<body>
	<form method="POST">
		<textarea  name="text" placeholder="Your message"></textarea><br>
		<?php echo display_error('text'); ?>
		<input type="submit" name="send" value="Send"><br>
		<?php if (isset($done)){ echo $done; } ?>
	</form>
	<a href="index.php">home</a>
	<a href="logout.php">logout</a>
</body>
</html>


<?php
	}
	else{
		header("Location:login.php");
	}
	
?>