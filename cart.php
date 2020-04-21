<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cart</title>
</head>

<body>
	<?php include("connection.php");
	session_start();
	$userID = $connect->query("SELECT * FROM login WHERE username = '".$_SESSION['username']."'")->fetch_array()['userID'];
	$cart = $connect->query("SELECT * FROM cart WHERE userID = '".$userID."' AND username = '".$_SESSION['username']."'");
	$item_name = $cart->fetch_array()['product_name'];
	$stock = $connect->query("SELECT * FROM itemtosell WHERE name = '".$item_name."'");
	$total_amount = 0;
	$total_price = 0;
	
		$item = $connect->query("SELECT * FROM itemtosell WHERE productID = '".$_POST['cancel']."'")->fetch_array();
		$itemUserID = $item['userID'];
		$name = $item['name'];
		$inStock = $item['stock'];
		$price = $item['price'];
		$sold = $item['sold'];
		$pic = $item['picture'];
		$delivery = $item['delivery'];
	if(!empty($_POST['cancel'])){
		//echo $_POST['cancel'];
		
		$inStock = $inStock+1;
		
		$cancel = $connect->query("DELETE FROM cart WHERE productID = '".$_POST['cancel']."'"); //fix the query condition later
		$stock = $connect->query("UPDATE `itemtosell` SET `userID`='".$itemUserID."',`productID`='".$_POST['cancel']."',`name`='".$name."',`stock`='".$inStock."',`price`='".$price."',`sold`='".$sold."',`picture`='".$pic."',`delivery`='".$delivery."' WHERE `productID`='".$_POST['cancel']."'");
		header("location:cart.php");
		
	}
	
	if($_POST['buy'] == "true"){
		//confirm buy
		$inCart = $connect->query("SELECT * FROM cart WHERE userID = '".$userID."'");
		foreach($inCart as $row){
			$seller = $connect->query("SELECT * FROM itemtosell WHERE productID = '".$row['productID']."'");
			$sellerID = $seller->fetch_array()['userID'];
			$sellerName = $connect->query("SELECT * FROM login WHERE userID = '".$sellerID."'")->fetch_array()['username'];
			
			$activity = $connect->query("INSERT INTO `activitylog`(`userID`, `username`, `sellerID`, `sellerName`, `productID`, `product_name`, `total_price`) VALUES ('".$userID."','".$_SESSION['username']."','".$sellerID."','".$sellerName."','".$row['productID']."','".$row['product_name']."','".$row['price']."')");
			$confirm = $connect->query("DELETE FROM cart WHERE userID = '".$row['userID']."' AND productID = '".$row['productID']."'");
			header("location:cart.php");
		}
	}
	
	?>
	<div align="center">
		<table border="0">
			<tr>
				<th>Item name</th>
				<th>Item ID</th>
				<th>Amount</th>
				<th>Price</th>
				<th></th>
			</tr>
			<? foreach($cart as $row){ 
				$total_price = $total_price+$row['price'];
				$total_amount = $total_amount+$row['amount'];
			?>
			<form method="post" action="">
			<tr>
				<td><? echo $row['product_name']?></td>
				<td><? echo $row['productID']?></td>
				<td><? echo $row['amount']?></td>
				<td><? echo $row['price']?></td>
				<td><button type="submit" name="cancel" value="<? echo $row['productID']?>">Cancel</button></td>
			</tr>
			</form>
		<?	} ?>
			<tr>
				<th align="left">Total</th>
				<td></td>
				<td><? echo $total_amount?></td>
				<td><? echo $total_price?></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div align="center"><form method="post" action=""><button type="submit" name="buy" value="true">BUY</button>&nbsp;&nbsp;<form method="post" action=""></form>&nbsp;&nbsp;<a href="customer.php"><button>Back</button></a></div>
</body>
</html>