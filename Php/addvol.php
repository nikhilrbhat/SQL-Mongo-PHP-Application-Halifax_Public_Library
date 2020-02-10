<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Volume</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="background-image"></div>
	<div class="content tblCont">
		
<form action="" method="POST">
	<h1>Add new Volume</h1>
	<table style="color:#fff;">
		<tr><td>Volume Number:</td><td><input type="number" name="vnum" required></td></tr>
		<tr><td>Magazine ID:</td><td><input type="number" name="mid" required></td></tr>
		<tr><td>Publication Year:</td><td><input type="number" name="yr" required></td></tr>
	</table>
	<br/>
	<input name="submit" type="submit" value="Add Volume">
</form>

<?php
	if(isset($_POST['submit']) || isset($_POST['Yes']) || isset($_POST['No'])){
		
		#Establish MySQL Connection
		if(!session_id()) session_start();
			$l = $_SESSION['login'];
			$p = $_SESSION['pass'];
			$server = $_SESSION['server'];
			
		$connection = new mysqli($server, $l, $p, $l);


		$mgId = htmlentities($_POST["mid"]);
		$vnum = htmlentities($_POST["vnum"]);
		$yr = htmlentities($_POST["yr"]);
		
		$existingVol = "SELECT * FROM VOLUMES where volume_num = '$vnum' and magazine_id = '$mgId'";
		
		if(!(isset($_POST['Yes']) || isset($_POST['No']))){
			$check = mysqli_query($connection, $existingVol);
			if (!$check) print("ERROR: ".mysqli_error($connection));
			if (mysqli_num_rows($check) != 0){
				echo "A volume with same number already exists for selected magazine.";
			}
			else{
				$result = mysqli_query($connection, "INSERT into VOLUMES (volume_num,magazine_id,publication_year) VALUES ('$vnum','$mgId','$yr')");
				if (!$result) print("Error: ".mysqli_error($connection));
				else{
					print "<b>Volume added</b>";
				}
			}
		}
		elseif(isset($_POST['Yes'])){
			$result = mysqli_query($connection, "INSERT into VOLUMES (volume_num,magazine_id,publication_year) VALUES ('$vnum','$mgId','$yr')");

			if ($result) print "<b>Volume added</b>";
			else{
	    			print("ERROR: ".mysqli_error($connection));
			}
		}
		else{
			print "<b>Volume could not be added</b>";
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