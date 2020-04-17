<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Sign-In</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script language="javascript" type="text/javascript">
		function checkPassword(form) {
			password = form.password.value;
			repassword = form.repassword.value;

			if (password == '') {
				alert("Please enter your Password.");
			} else if (repassword == '') {
				alert("Please confirm your Password.");
			} else if (password != repassword) {
				alert("\nPassword did not match: Plwase try again...");
				return false;
			} else {
				return true;
			}
		}
	</script>
</head>

<body>
	<?php include("connection.php") ?>
	<h1 align="center">Sign-in</h1>
	<form onSubmit="return checkPassword(this)" action="updateSignup.php" method="post">
		<div class="card">
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
				<tr>
					<td align="right"><input class="btn btn-success" type="submit" value="submit"></td>
					<td>
						<div align="left"><a class="btn btn-danger" href="index.html">cancle.</a></div>
					</td>
				</tr>
			</table>
		</div>
	</form>

</body>

</html>