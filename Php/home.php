<!DOCTYPE html> 
<html> 
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="style.css" rel="stylesheet" type="text/css"> 
</head> 
<body>
<div class="background-image"></div>
<div class="content">
<?php
	if(!session_id()) session_start();
		$login = $_POST["userId"];
		$pwd = $_POST["pwd"];

		if($login == "" || $login == null || $login == undefined)
			$login = "u36";
		if($pwd == "" || $pwd == null || $pwd == undefined)
			$pwd = "wallHAND46";
		

		$server = "mcda5540.cs.smu.ca";
		if(!isset($_SESSION['login'])) {
			$_SESSION['login'] = $login;
		}
		if(!isset($_SESSION['pass'])) {
			$_SESSION['pass'] = $pwd;
		}
		if(!isset($_SESSION['server'])) {
			$_SESSION['server'] = $server;
		}
?>

<center>
<h2 class='hslTitle'>Halifax Science Library (HSL)</h2>
<p class="p1">
	Please select one of the following options:
</p>
<p class="homeA"><a href="showtables.php"> Show Table</a>
<a href="addarticles.php"> Add New Article</a>
<a href="addcustomers.php"> Add New Customer</a>
<a href="addtransactions.php"> Add New Transaction</a>
<a href="canceltransactions.php"> Cancel Transaction</a></p>
</center>
</div>
</body>