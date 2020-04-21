<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cart</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
	<?php include("connection.php");
	session_start();
	$userID = $connect->query("SELECT * FROM login WHERE username = '" . $_SESSION['username'] . "'")->fetch_array()['userID'];
	$cart = $connect->query("SELECT * FROM cart WHERE userID = '" . $userID . "' AND username = '" . $_SESSION['username'] . "'");
	$item_name = $cart->fetch_array()['product_name'];
	$stock = $connect->query("SELECT * FROM itemtosell WHERE name = '" . $item_name . "'");
	$total_amount = 0;
	$total_price = 0;

	$item = $connect->query("SELECT * FROM itemtosell WHERE productID = '" . $_POST['cancel'] . "'")->fetch_array();
	$itemUserID = $item['userID'];
	$name = $item['name'];
	$inStock = $item['stock'];
	$price = $item['price'];
	$sold = $item['sold'];
	$pic = $item['picture'];
	$delivery = $item['delivery'];
	if (!empty($_POST['cancel'])) {
		//echo $_POST['cancel'];

		$inStock = $inStock + 1;

		$cancel = $connect->query("DELETE FROM cart WHERE productID = '" . $_POST['cancel'] . "'"); //fix the query condition later
		$stock = $connect->query("UPDATE `itemtosell` SET `userID`='" . $itemUserID . "',`productID`='" . $_POST['cancel'] . "',`name`='" . $name . "',`stock`='" . $inStock . "',`price`='" . $price . "',`sold`='" . $sold . "',`picture`='" . $pic . "',`delivery`='" . $delivery . "' WHERE `productID`='" . $_POST['cancel'] . "'");
		header("location:cart.php");
	}

	if ($_POST['buy'] == "true") {
		//confirm buy
		$inCart = $connect->query("SELECT * FROM cart WHERE userID = '" . $userID . "'");
		foreach ($inCart as $row) {
			$seller = $connect->query("SELECT * FROM itemtosell WHERE productID = '" . $row['productID'] . "'");
			$sellerID = $seller->fetch_array()['userID'];
			$sellerName = $connect->query("SELECT * FROM login WHERE userID = '" . $sellerID . "'")->fetch_array()['username'];

			$activity = $connect->query("INSERT INTO `activitylog`(`userID`, `username`, `sellerID`, `sellerName`, `productID`, `product_name`, `total_price`) VALUES ('" . $userID . "','" . $_SESSION['username'] . "','" . $sellerID . "','" . $sellerName . "','" . $row['productID'] . "','" . $row['product_name'] . "','" . $row['price'] . "')");
			$confirm = $connect->query("DELETE FROM cart WHERE userID = '" . $row['userID'] . "' AND productID = '" . $row['productID'] . "'");
			if ($inStock == 0) {
				$emptyStock = $connect->query("DELETE FROM itemtosell WHERE productID = '" . $row['productID'] . "'");
				header("location:cart.php");
			} else {
				header("location:cart.php");
			}
		}
	}

	?>
	<div align="center">
		<h3> Cart </h3>
	</div>
	<div align="center" style="width:75vw">
		<table class="table" order="0">
			<tr>
				<th>Item name</th>
				<th>Item ID</th>
				<th>Amount</th>
				<th>Price</th>
				<th></th>
			</tr>
			<?php foreach ($cart as $row) {
				$total_price = $total_price + $row['price'];
				$total_amount = $total_amount + $row['amount'];
			?>
				<form method="post" action="">
					<tr>
						<td><?php echo $row['product_name'] ?></td>
						<td><?php echo $row['productID'] ?></td>
						<td><?php echo $row['amount'] ?></td>
						<td><?php echo $row['price'] ?></td>
						<td><button type="submit" name="cancel" value="<?php echo $row['productID'] ?>">Cancel</button></td>
					</tr>
				</form>
			<?php	} ?>
			<tr>
				<th align="left">Total</th>
				<td></td>
				<td><?php echo $total_amount ?></td>
				<td><?php echo $total_price ?></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div align="center">
		<form method="post" action=""><button class="btn btn-success" type="submit" name="buy" value="true">BUY</button>&nbsp;&nbsp;<form method="post" action=""></form>&nbsp;&nbsp;<a class="btn btn-danger" href="customer.php"><button>Back</button></a>
	</div>
</body>

</html>