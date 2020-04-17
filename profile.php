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
	?>
	<div>
		<a href="customer.php">
			< Home</a> <h2 align="center"><?php echo $user; ?></h2>
	</div>

	<div>
		<table align="center" border="1">
			<tr>
				<th>id</th>
			</tr>
			<tr>
				<td>itemId</td>
			</tr>
		</table>
	</div>
</body>

</html>