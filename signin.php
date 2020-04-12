<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign-In</title>
	<script language="javascript" type="text/javascript">
		function checkPassword(form){
			password = form.password.value;	
			repassword = form.repassword.value;
			
			if(password == ''){
				alert("Please enter your Password.");
			}
			else if(repassword == ''){
				alert("Please confirm your Password.");
			}
			else if(password != repassword){
				alert("\nPassword did not match: Plwase try again...");
				return false;
			}
			else{
				return true;
			}
		}
	</script>
</head>

<body>
	<?php include("connection.php")?>
	<h1 align="center">Sign-in</h1>
	<form onSubmit = "return checkPassword(this)" action="updateSignup.php" method="post">
	<table border="0" align="center" name="signinTable">
		<tr>
			<td align="right">Username : </td>
			<td><input type="text" name="username" id="username" placeholder="Enter your Username" required></td>
		</tr>
		<tr>
			<td align="right">Password : </td>
			<td><input type="password" name="password" id="password" placeholder="Enter your Password" required></td>
		</tr>
		<tr>
			<td align="right">Confirm Password : </td>
			<td><input type="password" id="repassword" placeholder="Confirm your password" required></td>
		</tr>
		<tr>
			<td align="right">Sex : </td>
			<td>
				<input type="radio" name="sex" value="male" checked>Male
				<input type="radio" name="sex" value="female">Female
			</td>
		</tr>
		<tr>
			<td align="right">Phone : </td>
			<td><input type="tel" name="phone" placeholder="Enter your Phone number" required></td>
		</tr>
		<tr><td></td><td><input type="submit" value="submit"></td></tr>
	</table>
	</form>
	<div align="center"><a href="index.html" >cancle.</a></div>

</body>
</html>