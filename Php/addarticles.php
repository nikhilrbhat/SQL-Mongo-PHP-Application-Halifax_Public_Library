<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Article</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="background-image"></div>
	<div class="content tblCont">
		<form name="newart" action="newart.php" method="post">
			<h1><b>Add New Article</b></h1>
			<table name="articleData"> 
				<tbody>	
					<tr>
						<td>Title :</td><td><input name="title" type="text" required></td>
					</tr>
					<tr>
						<td>Pages:</td><td><input name="pgStrtEnd" type="text" required></td>
					</tr>
					<tr>
						<td>Magazine ID:</td><td><input name="magazine" type="number" required></td>
					</tr>
					<tr>
						<td>Volume ID:</td><td><input type="number" name="vol" required></td>
					</tr>
					<tr>
						<td>Author :</td>
						<td>
							<table>
								<tr><td colspan="2"><b>Author 1</b></td></tr>
								<tr><td>First Name</td><td><input type="text" name="fname1"required></td></tr>
								<tr><td>Last Name</td><td><input type="text" name="lname1"required></td></tr>
								<tr><td>Email</td><td><input type="text" name="email1"required></td></tr>
								<tr><td colspan="2"></td></tr>
								<tr><td colspan="2"><b>Author 2</b></td></tr>
								<tr><td>First Name</td><td><input type="text" name="fname2"></td></tr>
								<tr><td>Last Name</td><td><input type="text" name="lname2"></td></tr>
								<tr><td>Email</td><td><input type="text" name="email2"></td></tr>
								<tr><td colspan="2"></td></tr>
								<tr><td colspan="2"><b>Author 3</b></td></tr>
								<tr><td>First Name</td><td><input type="text" name="fname3"></td></tr>
								<tr><td>Last Name</td><td><input type="text" name="lname3"></td></tr>
								<tr><td>Email</td><td><input type="text" name="email3"></td></tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="submit" value="submit" name="submit"> 
			<input type="reset" value="reset" name="reset">
		</form>
	<p>
		<a href="home.php"><b> &lt;&nbsp;Go to Home</b></a>
	</p>
  </div>
</body>
</html>