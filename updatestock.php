<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
	
	session_start();
	include("connection.php");
	$username = $_SESSION['username'];
	$target_dir = "upload/";
	$picture = $target_dir . basename($_FILES['picture']["name"]);
	$uploadOK = 1;
	$imageFileType = strtolower(pathinfo($picture,PATHINFO_EXTENSION));
	
	if(isset($_POST['submit'])){
		$check = getimagesize($_FILES['picture']["tmp_name"]);
		if($check != false){
			echo "File is an image - " . $check["mine"] . ".";
			$uploadOK = 1;
		}
		else{
			echo "File is not an image...";
			$uploadOK = 0;
		}
	}
	if(file_exists($picture)){
		echo "File is already exists.";
		$uploadOK = 0;
	}
	
	if($uploadOK == 1){
		$user = $_SESSION['username'];
		$strUser = "SELECT * FROM `login` WHERE `username` = '".$user."'";
		$objQuery1 = $connect->query($strUser);
		$objResult1 = $objQuery1->fetch_array();
		
		if(!$objResult1){
			echo "fail to connect to database..";
		}
		else{
			$userID = $objResult1['userID'];
			$strUpdate = "INSERT INTO `itemtosell`(`userID`, `productID`, `name`, `stock`, `price`, `sold`, `picture`, `delivery`) VALUES ('".$userID."',0,'".$_POST['name']."','".$_POST['stock']."','".$_POST['price']."',0,'".$_POST['picture']."','".$_POST['service']."')";
			$objQuery2 = $connect->query($strUpdate);
			if(!$objQuery2){ ?>
				<script language="javascript">
					alert("cannot insert your data...");
				</script>
			<?
				//header('location:seller.php');
				echo $strUpdate;
			}
			else{ ?>
				<script language="javascript">
					alert("Insert completed!!");
				</script><?
				header('location:seller.php');
			}
		}
	}
	else{
		echo "can't insert your data.";
	}
	?>
</body>
</html>