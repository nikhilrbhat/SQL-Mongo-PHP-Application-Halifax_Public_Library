<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Transaction</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="background-image"></div>
<div class="content tblCont">

<form action="addtransactiondb.php" method="POST">
	<h1><b>Add new transaction</b></h1>
	<table style="color:#fff;">
		<tr><td>Item ID</td><td><input type="text" name="itemid"></td></tr>
		<tr><td>Customer ID</td><td><select name="cid">
			<?php

	#Establish MySQL Connection
	if(!session_id()) session_start();
		$l = $_SESSION['login'];
		$p = $_SESSION['pass'];
		$server = $_SESSION['server'];
		
	$connection = new mysqli($server, $l, $p, $l);

	if (!$connection) die("You couldn't connect to MySQL");
	mysqli_select_db($connection, $l) or die("You couldn't open $l: ".mysqli_error($connection));
	function printtable($tab) {
	while ($row = mysqli_fetch_row($tab)) {
		print "<option value=\"$row[0]\">$row[0]</option>";
		}
	}
	$res = mysqli_query($connection, "SELECT CID FROM CUSTOMER");
	printtable($res);
	mysqli_close($connection);
?>
</select>
</td></tr>
	</table>
	<br/>
<input name="submit" type="submit" value="Add Transaction">
</form>


<p>
	<a href="home.php"><b> &lt;&nbsp;Go to Home</b></a>
</p>

</div>
</body>
</html>