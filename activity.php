<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<a href="customer.php">back</a>
	<?PHP
	include("connection.php");
	session_start();
	$user = $_SESSION['username'];
	
	
	?>
</body>
</html>