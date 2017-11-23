<?php 
	session_start();
	include('include/db.php');
	echo "Logged in as " . $_SESSION['username'] . "<br>";

	if (array_key_exists("user_id", $_SESSION)) {

	$query = mysqli_query($db,"SELECT * FROM user") or die(mysqli_error($db));
	$fetch = mysqli_fetch_array($query);
	while ($fetch = mysqli_fetch_array($query)) {
		echo '<a href="chat.php?id='.$fetch['user_id'].'">' . $fetch['username'] . '</a><br>';
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>
	<a href="logout.php">logout</a>
</body>
</html>

<?php
	}
	else{
		header("Location:login.php");
	}
	
?>