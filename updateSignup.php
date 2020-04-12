<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	include("connection.php");
	
	$strSQL = "INSERT INTO `login`(`username`, `password`, `sex`, `status`, `phone number`) VALUES('".($_POST['username'])."','".($_POST['password'])."','".($_POST['sex'])."','User','".($_POST['phone'])."') ";
	
	$objQuery = $connect->query($strSQL);
	
	if($objQuery){ ?>
	
	<script language="javascript">
			alert("Register Completed!");
	</script>
	
	<?php 
		header("location:index.html");		 
		}
	else{ ?>
		<script language="javascript">
			alert("Cannot Insert your Data.");
		</script>
	<?php
		header("location:signin.php");
	}
	?>
	
</body>
</html>