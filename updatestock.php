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
	$uploadOK = 1;
	
	$target_dir = "upload/";
	$image = $_FILES['picture']['name'];
	$pic_name = basename($image);
	$target_path = $target_dir.$pic_name;
	$file_type = pathinfo($target_path,PATHINFO_EXTENSION);
	
	if(isset($_POST['add']) && !empty($_FILES['picture']['name'])){
		$allow_type = array('JPG','PNG','JPEG','gif','jpg');
		if(in_array($file_type,$allow_type)){
			if(move_uploaded_file($_FILES['picture']['tmp_name'],$target_path)){
				$uploadOK = 1;
			}
			else {
				$uploadOK = 0;
				echo "fuck1";
			}
		}
		else{
			$uploadOK = 0;
			echo "fuck2";
		}
	}
	else{
		$uploadOK = 0;
		echo "fuck3";
	}
	/*$target_dir = "DB_Project-master/upload/";
	$pic_name = basename($_FILES['picture']['name']);
	$picture = $target_dir.$pic_name;
	$imageFileType = pathinfo($picture,PATHINFO_EXTENSION);
	
	if(isset($_POST['submit']) && !empty($_FILES['picture']["name"])){
		$check = getimagesize($_FILES['picture']["name"]);
		if($check != false){
			echo "File is an image - ".$check["mine"].".";
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
	*/
	if($uploadOK == 1){
		$strUser = "SELECT * FROM `login` WHERE `username` = '".$username."'";
		$objQuery1 = $connect->query($strUser);
		$objResult1 = $objQuery1->fetch_array();
		
		if(!$objResult1){
			echo "fail to connect to database..";
		}
		else{
			
			$userID = $objResult1['userID'];
			$checkStock = $connect->query("SELECT * FROM itemtosell WHERE userID = '".$userID."' AND name = '".$_POST['name']."' AND price = '".$_POST['price']."' AND delivery = '".$_POST['service']."' AND picture = '".$image."'");
			$objResult2 = $checkStock->fetch_array();
			$objStock = $objResult2['stock'];
			$totalStock = $objStock+$_POST['stock'];
			
			if($objResult2){
				//UPDATE
				$strUpdate = "UPDATE `itemtosell` SET `userID`= '".$userID."',`productID`= '0',`name`='".$_POST['name']."',`stock`= '".$totalStock."',`price`= '".$_POST['price']."',`sold`= '0',`picture`= '".$image."',`delivery`= '".$_POST['service']."' WHERE userID = '".$userID."' AND name = '".$_POST['name']."' AND delivery = '".$_POST['service']."' AND picture = '".$image."' AND price = '".$_POST['price']."'";
			}
			else{
				//INSERT
				$strUpdate = "INSERT INTO `itemtosell`(`userID`, `productID`, `name`, `stock`, `price`, `sold`, `picture`, `delivery`) VALUES ('".$userID."',0,'".$_POST['name']."','".$_POST['stock']."','".$_POST['price']."',0,'".$image."','".$_POST['service']."')";
				
			}
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
				<!--script language="javascript">
					alert("Insert completed!!");
				</script--><?
				//echo $image;
				/*echo $strUpdate;
				echo $check ['name'];
				echo $check ['price'];
				echo $check ['delivery'];
				echo $totalStock;
				echo $objStock;*/
				header('location:seller.php');
			}
		}
	}
	else{
		echo "can't insert your data.";
		echo $uploadOK;
	}
	?>
</body>
</html>