<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="MCDA-5540 Final Project">
  <meta name="keywords" content="MySQL, MongoDB, PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Article</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div class="background-image"></div>
	<div class="content tblCont">
	<?php
		$artitle = $_POST['title'];
		$pages = $_POST['pgStrtEnd'];
		$volid = $_POST['vol'];
		$magazineId = $_POST['magazine'];
		  
		$fname1 = $_POST['fname1'];
		$lname1 = $_POST['lname1'];
		$email1 = $_POST['email1'];
		$fname2 = $_POST['fname2'];
		$lname2 = $_POST['lname2'];
		$email2 = $_POST['email2'];
		$fname3 = $_POST['fname3'];
		$lname3 = $_POST['lname3'];
		$email3 = $_POST['email3'];
		   
		if(!session_id()) session_start();
		$l = $_SESSION['login'];
		$p = $_SESSION['pass'];
		$server = $_SESSION['server'];
			
		$connection = new mysqli($server, $l, $p, $l);
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$checkMag = "SELECT * FROM MAGAZINE WHERE  _id = $magazineId ";
		$res = mysqli_query($connection,$checkMag);
		if (mysqli_num_rows($res) == 0){
			echo "<br/>Magazine does not exist";
			echo "<br/><a href= 'addmag.php'> Add Magazine </a> <br>";
			echo "<br/><a href='home.php'><b> &lt;&nbsp;Go to Home</b></a><br>";
			exit;
			}
			
		$checkVol = "SELECT * FROM VOLUMES WHERE  magazine_id = $magazineId and _id = $volid";
		$res1 = mysqli_query($connection,$checkVol);
		if (mysqli_num_rows($res1) == 0){
			echo "<br/>Volume does not exist for the corresponding Magazine";
			echo "<br/><a href= 'addvol.php'> Add Volume </a> <br>";
			echo "<br/><a href='home.php'><b> &lt;&nbsp;Go to Home</b></a><br>";
			exit;
			}
		$newInsertArticle = "INSERT into ARTICLES(title,volume_id,page_number) VALUES('{$artitle}','{$volid}','{$pages}')"; 
		$resArticleInsert = mysqli_query( $connection, $newInsertArticle);
		$articleid = mysqli_insert_id($connection);
						
		if(!$resArticleInsert){
			printf("<br/>Error:".mysqli_error($link)."<br>");
			echo  "<br/><strong> Insertion failed <br>";
			echo "<br/><a href= 'addvol.php'> Add Volume </a> <br>";
			echo "<br/><a href='home.php'><b> &lt;&nbsp;Go to Home</b></a><br>";
			exit;
			}
		else  
			echo "<br/><strong>Insertion done</strong><br>"; 
				 
		$flag = false;
		$authCheck1 = "SELECT _id FROM AUTHOR  WHERE fname = '$fname' and lname = '$lname'";
		$resAuthorName = mysqli_query($connection,$authCheck1);
		while ($row = mysqli_fetch_assoc($resAuthorName)) {
			$flag = true;
			echo "<br/><strong>Author already exists</strong><br>"; 
			$authorid  = $row['_id'];
			}
		if ($flag == false){
			$newInsertAuthor = "INSERT into AUTHOR(fname,lname,email) VALUES('{$fname}','{$lname}','{$email}')";
			$resAuthorInsert = mysqli_query($connection,$newInsertAuthor);
			$authorid = mysqli_insert_id($connection);
						 
			if(!$resAuthorInsert){
				echo "<br/><strong>Author Insertion failed </strong><br>"; 
				exit;
				}
			else  
				echo "<br/><strong>Author Insertion done </strong><br>";  
			}
			   
		$newInsertArticleAuthor = "INSERT into ARTICLE_AUTHORS(article_id,author_id) VALUES('{$articleid}','{$authorid}')";
		$resArticleAuthorInsert = mysqli_query( $connection,$newInsertArticleAuthor);
		if(!$resArticleAuthorInsert){
			echo "<br/><strong>Insertion failed</strong><br>"; 
			exit;
			}
		else 
			echo "<br/><strong>Insertion done</strong><br>"; 
			
		if($fname2 == NULL  or $lname2 == NULL or $email2 == NULL)
			echo "<br/><strong>No values entered for Author 2</strong><br>"; 
		else{
			$flag1 = false;
			$newAuthorName1 = "SELECT _id FROM AUTHOR  WHERE fname = '$fname2' and lname = '$lname2'";
			$resAuthorName1 = mysqli_query($connection,$newAuthorName1);
			while ($row1 = mysqli_fetch_assoc($resAuthorName1)) {
			$flag1= true;
			echo "<br/><strong>Author 2 already  exists</strong><br> "; 
			$authorid1  = $row1['_id'];
			}
			if ($flag1 == false){
				$newInsertAuthor1= "INSERT into AUTHOR(fname,lname,email) VALUES('{$fname2}','{$lname2}','{$email2}')";
				$resAuthorInsert1 = mysqli_query($connection,$newInsertAuthor1);
				$authorid1 = mysqli_insert_id($connection);
						
				if(!$resAuthorInsert1){
					echo "<br/>insertion failed for author 2 ";
					exit; 
					}
				else 
					echo "<br/><strong>insertion done for author 2</strong><br>";  
				} 
			$newInsertArticleAuthor1 = "INSERT into ARTICLE_AUTHORS(article_id,author_id) VALUES('{$articleid}','{$authorid1}')";
			$resArticleAuthorInsert1 = mysqli_query( $connection,$newInsertArticleAuthor1);
			if(!$resArticleAuthorInsert1){
				echo "<br/>insertion failed for author 2<br>";  
				exit;
				}
			else 
				echo "<br/><strong>insertion done for author 2</strong><br>";  
			}
		if($fname3 == NULL  or $lname3 == NULL or $email3 == NULL)
			echo " <strong>No values entered for Author 3</strong><br>";  
		else{
			$flag2 = false;
			$newAuthorName2 = "SELECT _id FROM AUTHOR  WHERE fname = '$fname3' and lname = '$lname3'";
			$resAuthorName2 = mysqli_query($connection,$newAuthorName2);
			while ($row2 = mysqli_fetch_assoc($resAuthorName2)){
				$flag2= true;
				echo "<br/><strong>author3 name already  exists</strong><br>";
				$authorid2  = $row2['_id'];
				}
			if ($flag2 == false){
				$newInsertAuthor2= "INSERT into AUTHOR(fname,lname,email) VALUES('{$fname3}','{$lname3}','{$email3}')";
				$resAuthorInsert2 = mysqli_query($connection,$newInsertAuthor2);
				$authorid2 = mysqli_insert_id($connection);
				 
				if(!$resAuthorInsert2){
					echo "<br/><strong>insertion failed for author 3</strong><br>";
					exit;
					}
				else  
					echo "<br/><strong>insertion done for author 3</strong><br>"; 
			   }
			$newInsertArticleAuthor2 = "INSERT into ARTICLE_AUTHORS(article_id,author_id) VALUES('{$articleid}','{$authorid2}')";
			$resArticleAuthorInsert2 = mysqli_query( $link,$sqlInsertArticleAuthor2);
			if(!$resArticleAuthorInsert2){
				echo "<br/><strong>insertion failed for author 3</strong><br>";
				exit;
				}
			else 
				echo "<br/><strong>insertion for author 3</strong><br>"; 
			}
		mysqli_close($connection)
	?>
	<p>
		<a href="home.php"><b> &lt;&nbsp;Go to Home</b></a>
	</p>
</div>
</body>
</html>