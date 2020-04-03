<?php
session_start();
include("connection.php");



$strSQL = "SELECT * FROM login WHERE username = '".mysqli_real_escape_string($connect,$_POST['username'])."' AND password = '".mysqli_real_escape_string($connect,$_POST['password'])."' ";

$objQuery = $connect->query($strSQL);
$objResult = $objQuery->fetch_array();

$username = $objResult['username'];
$status = $objResult['status'];

if(!$objResult){
	echo "fail to login...";
	//header("location : index.html");
}
else{
	
	if($status == "Admin"){
		header("location:admin.html");
	}
	else{
		$_SESSION['login'] = true;
		$_SESSION['username'] = $username;
		header("location:customer.php");
	}
} 
?>