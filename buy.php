<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<!--a href="customer.php">back</a-->
	<!-- comment this <a> when this page is finished -->
	<?php
	include("connection.php");
	session_start();
	
	$userID = $connect->query("SELECT * FROM login WHERE username = '".$_SESSION['username']."'")->fetch_array()['userID'];
	
	//this is cart page so you have to create the cart table for apply stock later
	//you have to insert into cart table and then insert to activitylog when cart is confrimed
	
	if(!empty($_POST['ispostback']) && $_POST['ispostback'] == 'true'){
		if(!empty($_POST['buy'])){
			$itemID = implode($_POST['buy']);
			$stockOBJ = $connect->query("SELECT * FROM itemtosell WHERE productID = '".$itemID."'");
			$stockResult = $stockOBJ->fetch_array();
			$sellerID = $stockResult['userID'];
			$stock = $stockResult['stock'];
			$sold = $stockResult['sold'];
			$price = $stockResult['price'];
			$pic = $stockResult['picture'];
			$delivery = $stockResult['delivery'];
			$pID = $stockResult['productID'];
			$pName = $stockResult['name'];
			$stock = $stock-1;
			$sold = $sold+1;
			
			if($stock == 0){
				$strUpdate = "UPDATE `itemtosell` SET `userID` = '".$sellerID."' , `productID` = '".$pID."' , `name` = '".$pName."' , `stock` = 0 , `price` = '".$price."' , `sold` = '".$sold."' , `picture` = '".$pic."' , `delivery` = '".$delivery."' WHERE `productID` = '".$pID."' ";
				$updateStock = $connect->query($strUpdate);
				$insertCart = $connect->query("INSERT INTO `cart`(`userID`, `username`, `product_name`, `productID`, `amount`, `price`) VALUES ('".$userID."','".$_SESSION['username']."','".$pName."','".$pID."',1,'".$price."')");
				header("location:customer.php");
			}
			else if($stock < 0){ ?>
				<script> 
					alert("threr is on item left...");
					location.replace("customer.php");
				</script>
		<?	}
			else{
				$strUpdate = "UPDATE `itemtosell` SET `userID` = '".$sellerID."' , `productID` = '".$pID."' , `name` = '".$pName."' , `stock` = '".$stock."' , `price` = '".$price."' , `sold` = '".$sold."' , `picture` = '".$pic."' , `delivery` = '".$delivery."' WHERE `productID` = '".$pID."' ";
				$updateStock = $connect->query($strUpdate);
				$insertCart = $connect->query("INSERT INTO `cart`(`userID`, `username`, `product_name`, `productID`, `amount`, `price`) VALUES ('".$userID."','".$_SESSION['username']."','".$pName."','".$pID."',1,'".$price."')");
				header("location:customer.php");
			}
		}
		else{
			echo "1";
		}
	}
	else{
		echo "2";
	}
	//echo $_POST['ispostback'];
	//echo implode($_POST['buy']);
	?>
</body>
</html>