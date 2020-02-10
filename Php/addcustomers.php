<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Customer</title>
  <link href="style.css" rel="stylesheet" type="text/css"> 
</head> 
<body>
<div class="background-image"></div>
<div class="content">

<form action="" method="POST">
	<h1>Add new customer</h1>
	<table style="color:#fff;">
		<tr><td>First Name</td><td><input type="text" name="fname"></td></tr>
		<tr><td>Last Name</td><td><input type="text" name="lname"></td></tr>
		<tr><td>Mailing Address</td><td><input type="text" name="address"></td></tr>
		<tr><td>Mobile Number</td><td><input type="text" name="telephone"></td></tr>
	</table>
	<br/>
	<input name="submit" type="submit" value="Add Customer">
</form>

<?php
	if(isset($_POST['submit']) || isset($_POST['Yes']) || isset($_POST['No'])){
		
		#Establish MySQL Connection
		if(!session_id()) session_start();
		$l = $_SESSION['login'];
		$p = $_SESSION['pass'];
		$server = $_SESSION['server'];
			
		$connection = new mysqli($server, $l, $p, $l);


		$fname = htmlentities($_POST["fname"]);
		$lname = htmlentities($_POST["lname"]);
		$address = htmlentities($_POST["address"]);
		$telephone = htmlentities($_POST["telephone"]);
		
		$existingCust = "SELECT * FROM CUSTOMER where fname = '$fname' and lname = '$lname'";
		
		if(!(isset($_POST['Yes']) || isset($_POST['No']))){
			$check = mysqli_query($connection, $existingCust);
			if (!$check) print("ERROR: ".mysqli_error($connection));
			if (mysqli_num_rows($check) != 0){
				echo "<form action=\"\" method=\"POST\">A customer with the same first and last name already exists. Are you sure you want to add another customer with same name?
					<br> <input type=\"submit\" name=\"Yes\" value=\"yes\"> <input type=\"submit\" name=\"No\" value=\"no\"> 
					<input type=\"hidden\" name=\"fname\" value=\"".$fname."\">
					<input type=\"hidden\" name=\"lname\" value=\"".$lname."\">
					<input type=\"hidden\" name=\"address\" value=\"".$address."\">
					<input type=\"hidden\" name=\"telephone\" value=\"".$telephone."\"></form>";
				exit;
			}
			else{
				$result = mysqli_query($connection, "INSERT into CUSTOMER (fname,lname,mailing_address,telephone) VALUES ('$fname','$lname','$address','$telephone')");
				if (!$result) print("Error: ".mysqli_error($connection));
				else{
					print "<b>Customer added</b>";
				}

			}
		}
		elseif(isset($_POST['Yes'])){
			$result = mysqli_query($connection, "INSERT into CUSTOMER (fname,lname,mailing_address,telephone) VALUES ('$fname','$lname','$address','$telephone')");

			if ($result) print "<b>Customer added</b>";
			else{
	    		print("ERROR: ".mysqli_error($connection));
			}
		}
		else{
			print "<b>Customer could not be added</b>";
		}
		#Close MySQL Connection
		mysqli_close($connection);
	}
?>

<p>
	<a href="home.php"><b> &lt;&nbsp;Go to Home</b></a>

</p>
</div>
</body>
</html>