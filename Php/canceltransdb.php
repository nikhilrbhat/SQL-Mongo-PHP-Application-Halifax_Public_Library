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
	<?php
		#Establish MySQL Connection
		if(!session_id()) session_start();
		$l = $_SESSION['login'];
		$p = $_SESSION['pass'];
		$server = $_SESSION['server'];
			
		$connection = new mysqli($server, $l, $p, $l);

		#Establish MySQL Connection
		$transaction_number= $_POST["transaction_number"];

		$check = mysqli_query($connection, "select DATE_FORMAT(transaction_date, '%Y%m%d'), DATE_FORMAT(NOW(), '%Y%m%d') from TRANSACTIONS where transaction_num = '$transaction_number'");
		if (mysqli_num_rows($check) > 0)
		{
			$current = mysqli_fetch_row($check);
			$days = (int)$current[1] - (int)$current[0];
			if ($days <= 30)
			{
				
				$deletefromTransItems = mysqli_query($connection,"delete from TRANSACTION_DETAILS where transaction_num = '$transaction_number'");
				if ($deletefromTransItems) {
					echo '<br/><b><span style="color:#fff">Deleted transaction items</span></b><br/>';
				}
				$deletefromTransaction = mysqli_query($connection,"delete from TRANSACTIONS where transaction_num = $transaction_number");
				if($deletefromTransaction){
					echo '<br/><b><span style="color:#fff">Deleted transaction Successfully</span></b><br/>';
				}
			}
		}
		else
		{
			echo '<br/><b><span style="color:#fff">Transaction does not exist or is older than 30 days</span></b><br/>';
		}
		mysqli_close($connection);
	?>

</div>	
</body>
</html>