<meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Transaction</title>
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

if (!$connection) die("You couldn't connect to MySQL");
mysqli_select_db($connection, $l) or die("You couldn't open $l: ".mysqli_error($connection));
$itemid = $_POST['itemid'];
$cid = $_POST['cid'];
$items = explode(",", $itemid);
$ch = True;

for ($j =0; $j<count($items);$j++)
{
	$itemInside = $items[$j];
	$chItems = "SELECT * FROM ITEM WHERE _id = '".$itemInside."'";
	$runch = mysqli_query($connection, $chItems);
	if (!mysqli_num_rows($runch)) {
		$ch = False;
		}
}
echo "<br> Customer ID: ";
echo $cid;
echo "<br>";
function discountcode($cid, $connection){
	$discountquery = "SELECT SUM(total_price) AS totalpurchaseprice FROM TRANSACTIONS WHERE customer_id= '{$cid}' AND transaction_date> DATE_SUB(NOW(),INTERVAL 5 YEAR)";
	$discountexecution = mysqli_query($connection, $discountquery);
	$row = mysqli_fetch_assoc($discountexecution);
	$sum = $row['totalpurchaseprice'];
	global $discode;
	if($sum){
		if($sum > 500){
			$discode = 5;
		} 
		else if($sum > 400 && $sum <= 500){
				$discode = 4;
			} 
		else if($sum > 300 && $sum <= 400){
				$discode = 3;
			} 
		else if($sum > 200 && $sum <= 300){
				$discode = 2;
			} 
		else if($sum > 100 && $sum <= 200){
				$discode = 1;
			}
		} 
	else{
		$sum = 0;
		$discode = 0;
		}
	}

if ($ch == True){
	discountcode($cid, $connection);
	$total = 0;
	for ($k =0; $k<count($items);$k++)
	{
		$priceqry = "SELECT price FROM ITEM where _id = '".$items[$k]."'";
		$runpriceqry = mysqli_query($connection, $priceqry);
		while ($row = mysqli_fetch_row($runpriceqry)){
			$priceperitem = $row[0];
			$total += $priceperitem;
		}
	}
	$totalprice = $total*(1-2.5*$discode/100);
	$newInsertTransaction = "INSERT into TRANSACTIONS(transaction_date,customer_id,total_price) VALUES(now(),'$cid','$totalprice')";
	$resTransactionInsert = mysqli_query($connection, $newInsertTransaction);
	$transactionNo = mysqli_insert_id($connection);
	echo " <br> Transaction Number : ";
	echo $transactionNo;
	echo "<br> Discount Code ";
	echo " : ";
	echo $discode;
	$newUpdateCustomerDC = mysqli_query($link, "UPDATE CUSTOMER SET discount_code= ".$discountcode." WHERE CID = ".$cid);
	for ($i =0; $i<count($items);$i++)
	{
		$priceqry = "SELECT price FROM ITEM where _id = '".$items[$i]."'";
		$runpriceqry = mysqli_query($connection, $priceqry);
		$row = mysqli_fetch_row($runpriceqry);
		$quantprice = ($quantities[$i] * $row[0])*(1-2.5*$discode/100);
		$insertTransItemStm = "INSERT INTO TRANSACTION_DETAILS(transaction_num, item_id) VALUES (".$transactionNo.",".$items[$i].")";
		$runInsertTransItemStm = mysqli_query($connection,$insertTransItemStm);
	}
	echo "<br> Total Price ";
	echo " : ";
	echo $totalprice;
	echo "<br> Transaction Success";
	}
else{
	echo "<br> Input Error. Try Again.";
	}
mysqli_close($connection);
?>
<p>
	<a href="addtransactions.php"><b> &lt;&nbsp;Go Back</b></a><br/>
	<a href="home.php"><b> &lt;&nbsp;Go to Home</b></a>
</p>

</div>
</body>
</html>