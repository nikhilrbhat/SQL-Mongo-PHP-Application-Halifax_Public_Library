<!DOCTYPE html> 
<html> 
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Transaction</title>
  <link href="style.css" rel="stylesheet" type="text/css">
</head> 
<body>
<div class="background-image"></div>
<div class="content">
<h1><b>Delete Transaction</b></h1>
<form action="canceltransdb.php" method="POST" style="color:#fff;">
	Transaction Number: <input type="text" name="transaction_number"required> <br/><br/>
	<input type="submit" name="SUBMIT">
</form>
<p>
	<a href="home.php"><b>&lt;&nbsp;Go to Home</b></a>
</p>
</div>	
</body>
</html>