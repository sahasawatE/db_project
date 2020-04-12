<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	include("connetion.php");
	
	session_start();
	
	session_destroy();
	header("location:index.html");
	?>
</body>
</html>