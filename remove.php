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
	$user = $_SESSION['username'];
	$getUserID = "SELECT * FROM login WHERE username = '".$user."'";
	$userID = $connect->query($getUserID)->fetch_array()['userID'];
	$strRemove = "DELETE FROM itemtosell WHERE userID = '".$userID."' AND name = '".$_POST['remove']."'";
	$objRemove = $connect->query($strRemove);
	
	if($objRemove){
		header("location:seller.php");
	}
	else{
		echo "Fail..";
	}
	?>
</body>
</html>