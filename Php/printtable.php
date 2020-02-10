<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table Data</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="background-image"></div>
<div class="content tblCont">

<?php
	#Establish MySQL Connection
	if(!session_id()) session_start();
		$l = $_SESSION['login'];
		$p = $_SESSION['pass'];
		$server = $_SESSION['server'];
		
	$connection = new mysqli($server, $l, $p, $l);

	#Required query
	$table = $_POST["tablename"];
	$query = "select * from $table";
	$columnHeaders = "select column_name from information_schema.columns where table_name='$table' ORDER BY ordinal_position";

	#Function that prints content in table format
	function printTable($headers,$table){		
		print "<table class='tdata'><thead>";
		print "<tr>";
		while($header = mysqli_fetch_row($headers)){
			foreach ($header as $field) print "<th>$field</th>";
		}
		print "</tr></thead><tbody>";

		while ($a_row = mysqli_fetch_row($table)) {
			print "<tr>";
			foreach ($a_row as $field) print "<td>$field</td>";
			print "</tr>";
		}
		print "</tbody></table>";
	}

	$result = mysqli_query($connection, $query);
	$colHeaders = mysqli_query($connection, $columnHeaders);
	if (!$result || !$colHeaders) {
		print("ERROR: ".mysqli_error($connection));
	}
	else {
		$num_rows = mysqli_num_rows($result);
		print "<h1><b>$table</b></h1>";
		print "Total Records: $num_rows";
		printTable($colHeaders,$result);
		
	}

	#Close MySQL Connection
	mysqli_close($connection);
		
	?>

	<p>
		<a href="showtables.php"> <b>&lt;&nbsp;Change table </b></a><br><br>
		<a href="home.php"><b> &lt;&nbsp;Go to Home</b></a>
	</p>
</div>
</body>
</html>