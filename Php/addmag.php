<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Magazine</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="background-image"></div>
	<div class="content tblCont">
		
	<form action="" method="POST">
		<h1>Add new Magazine</h1>
		<table style="color:#fff;">
			<tr><td>Name</td><td><input type="text" name="name" required></td></tr>
		</table>
		<br/>
		<input name="submit" type="submit" value="Add Magazine">
	</form>

<?php
	if(isset($_POST['submit']) || isset($_POST['Yes']) || isset($_POST['No'])){		
		#Establish MySQL Connection
		if(!session_id()) session_start();
		$l = $_SESSION['login'];
		$p = $_SESSION['pass'];
		$server = $_SESSION['server'];
			
		$connection = new mysqli($server, $l, $p, $l);

		$name = htmlentities($_POST["name"]);
		
		$existingMag = "SELECT * FROM MAGAZINE where name = '$name'";
		
		if(!(isset($_POST['Yes']) || isset($_POST['No']))){
			$check = mysqli_query($connection, $existingMag);
			if (!$check) print("ERROR: ".mysqli_error($connection));
			if (mysqli_num_rows($check) != 0){
				echo "A magazine with same name already exists.";
			}
			else{
				$result = mysqli_query($connection, "INSERT into MAGAZINE (name) VALUES ('$name')");
				if (!$result) print("Error: ".mysqli_error($connection));
				else{
					print "<b>Magazine added</b>";
				}
			}
		}
		elseif(isset($_POST['Yes'])){
			$result = mysqli_query($connection, "INSERT into MAGAZINE (name) VALUES ('$name')");
			if ($result) print "<b>Magazine added</b>";
			else{
    			print("ERROR: ".mysqli_error($connection));
			}
		}
		else{
			print "<b>Magazine could not be added</b>";
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