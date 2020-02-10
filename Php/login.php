<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <title>Login</title>
   <link href="style.css" rel="stylesheet" type="text/css"> 
  <style>
	.frmDes{
		text-align: center;
		margin: 0;
		position: absolute;
		top: 50%;
		-ms-transform: translateY(-50%);
		transform: translateY(-50%);
		margin-left: 40%;
	}
  </style>
</head> 
<body>
<div class="background-image"></div>
<div class="content">
	<center>
	<form action="home.php" method="POST" class="frmDes">
		<table style="color:#fff;">
			<tr><td>User Id:</td><td><input id="user" type="text" name="userId"></td></tr>
			<tr><td>Password:</td><td><input id="pass" type="password" name="pwd"></td></tr>
		</table>
		<br/>
		<input type="submit" class="button" value="Sign In">
	</form>
	</center>
</div>
</body>
</html>