<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>

	<?php
	include("connection.php");
	session_start();

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
	<div id="tableCustomer" class="d-flex justify-content-center" style="margin:0px;">
		<table class="table" id="tableCustomerS" style="width: 45vw; margin:0px">
			<tr>
				<th class="text-center">Customer id</th>
				<th class="text-center">Customer name</th>
			</tr>
			<?php
			$getUserInfo = $connect->query("SELECT * FROM itemtosell");

			foreach ($getUserInfo as $row) {
				$userID = $row['userID'];
				$getUsername = $connect->query("SELECT * FROM login WHERE userID = '" . $userID . "'")->fetch_array()['username']; ?>

				<tr>
					<td class="text-center"><?php echo $userID; ?></td>
					<td class="text-center"><?php echo $getUsername ?></td>
				</tr>
			<?php }
			?>
		</table>
	</div>
	<hr style="border:5px solid gray; width:80vw">
	<div id="tableSeller" class="d-flex justify-content-center">
		<table class="table" id="tableSellerS" style="width: 45vw;">
			<tr>
				<th class="text-center">seller id</th>
				<th class="text-center">seller name</th>
			</tr>
		</table>
	</div>
</body>

</html>