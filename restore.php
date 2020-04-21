<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
		include("connection.php");
		session_start();
	
		$userID = $connect->query("SELECT * FROM login WHERE username = '".$_SESSION['username']."'")->fetch_array()['userID'];
	
		$restore = $connect->query("DELETE FROM itemtosell WHERE userID = '".$userID."'");
	header("location:seller.php");
	?>
</body>
</html>