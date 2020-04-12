<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
	
	<?php
	include("connection.php");
	session_start();
	
	$user = $_SESSION['username'];
	$strGetInfo = $connect->query("SELECT * FROM login WHERE status = 'Admin' AND username = '".$user."'")->fetch_array();
	if($strGetInfo){
		$AdminName = $strGetInfo['username'];
	}
	else{
		echo "Fail to connect to database";
	}
	
	?>
  <h1>Admin</h1>
	<a href="logout.php">logout</a>
  <div>
    <p>Name : <span id="userNameAdmin"><? echo $AdminName;?></span></p>
  </div>
  <div id="tableCustomer" align="center">
    <table id="tableCustomerS" style="width: 25vw;" border="1" align="center">
		<tr>
			<th>Customer id</th>
      		<th>Customer name</th>
		</tr>
		<?
		$getUserInfo = $connect->query("SELECT * FROM itemtosell");
		
		foreach($getUserInfo as $row){
			$userID = $row['userID'];
			$getUsername = $connect->query("SELECT * FROM login WHERE userID = '".$userID."'")->fetch_array()['username']; ?>
			
			<tr>
				<td align="center"><? echo $userID;?></td>
				<td align="center"><? echo $getUsername?></td>
			</tr>
		<? }
		?>
    </table>
  </div>
  <div id="tableSeller">
    <table id="tableSellerS" style="width: 100vw;" border="1">
      <tr>
        <th>seller id</th>
        <th>seller name</th>
      </tr>
    </table>
  </div>
</body>

</html>