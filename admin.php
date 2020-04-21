<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin only</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>

	<?php
	include("connection.php");
	session_start();
	
	
	
	if(!empty($_POST['edit'])){
		$editItem = $connect->query("SELECT * FROM itemtosell WHERE productID = '".$_POST['edit']."'")->fetch_array();
		$uID = $editItem['userID'];
		$pID = $editItem['productID'];
		$stock = $editItem['stock'];
		$sold = $editItem['sold'];
		$pic = $editItem['picture'];
		$delivery = $editItem['delivery'];
		$pName = "pName".$_POST['edit'];
		$price = "price".$_POST['edit'];
		$update = $connect->query("UPDATE `itemtosell` SET `userID`='".$uID."',`productID`='".$_POST['edit']."',`name`='".$_POST[$pName]."',`stock`='".$stock."',`price`='".$_POST[$price]."',`sold`='".$sold."',`picture`='".$pic."',`delivery`='".$delivery."' WHERE productID = '".$_POST['edit']."'");
		if($update){
			?>
			<script>
				alert("success!!!");
				location.replace("admin.php");
			</script>
			<?
		}
		else{
			?>
			<script>
				alert("fail...");
				location.reload();
			</script>
			<?
		}
	}
	

	$user = $_SESSION['username'];
	$strGetInfo = $connect->query("SELECT * FROM login WHERE status = 'Admin' AND username = '" . $user . "'")->fetch_array();
	if ($strGetInfo) {
		$AdminName = $strGetInfo['username'];
	} else {
		echo "Fail to connect to database";
	}

	?>
	<h1 align="center">Admin</h1>
	<div class="row">
		<div class="col">
			<h4><span id="userNameAdmin" style="text-decoration: underline;"><?php echo $AdminName; ?></span></h4>
		</div>
		<div class="col">
			<a class="btn btn-danger float-right" href="logout.php">logout</a>
		</div>
	</div>
	<hr style="border:5px solid gray; width:80vw">
	<div id="tableSeller" class="d-flex justify-content-center">
		<form  method="post" action="">
		<table class="table" id="tableSellerS" style="width: 45vw;">
			<tr>
				<th class="text-center">SellerID</th>
				<th class="text-center">Seller name</th>
				<th class="text-center">ProductID</th>
				<th class="text-center">Product name</th>
				<th class="text-center">Product Price</th>
			</tr>
			<? 
			$item = $connect->query("SELECT * FROM itemtosell");
			$i = 0;
			foreach($item as $row){
				$i++;
				$getName = $connect->query("SELECT * FROM login WHERE userID = '".$row['userID']."'")->fetch_array()['username'];
				?>
			<tr>
				<td><div align="center"><? echo $row['userID']?></div></td>
				<td><div align="center"><? echo $getName?></div></td>
				<td><div align="center"><? echo $row['productID']?></div></td>
				<td><div align="center"><input autocomplete="off" name="pName<?echo $row['productID']?>" value="<? echo $row['name']?>"/></div></td>
				<td><div align="center"><input autocomplete="off" type="number" name="price<? echo $row['productID']?>" value="<? echo $row['price']?>"/></div></td>
				<td><button class="btn btn-primary" type="submit" name="edit" value="<? echo $row['productID']?>">Save</button></td>
			</tr>			
	<?		}
			?>
		</table>
		</form>
	</div>
</body>

</html>