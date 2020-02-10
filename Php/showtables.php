<!DOCTYPE html> 
<html> 
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tables</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head> 
<body>
<div class="background-image"></div>
<div class="content">

<form action="printtable.php" method="POST" style="color:#fff;">

<h1><b>Please select the table to view data:</b></h1>
<?php

	if(!session_id()) session_start();
	$l = $_SESSION['login'];
	$p = $_SESSION['pass'];
	$server = $_SESSION['server'];
		
	$connection = new mysqli($server, $l, $p, $l);
	
	#Required query
	$query = "Show Tables";

	#Function that prints content in table format
	function prinTable($table) {
		print "<table>\n";
		print "<tr><td><select name='tablename'>";
			while ($a_row = mysqli_fetch_row($table)) {
				foreach ($a_row as $field) print "<option value=\"$field\">$field</option>";
			}
		print "</td></tr></table>";
		print "<br><br>";
	}

	$result = mysqli_query($connection, $query);
	if (!$result) {
		print("ERROR: ".mysqli_error($connection));
	}
	else {
		$num_rows = mysqli_num_rows($result);
		print "\n$num_rows tables found in the Halifax Science Library Database<p>";
		prinTable($result);
	}

	#Close MySQL Connection
	mysqli_close($connection);

?>


  <input type="submit" value="Submit">
</form> 
<br/>
<a href="home.php"><b>&lt;&nbsp;Go to Home</b></a>
</div>

</body>