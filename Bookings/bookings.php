<?php
session_start();
?>
<html>

<head>

<title>Bookings </title>
	
	<link rel="stylesheet" href="../style.css" /> 

</head>

<body >
 <nav>
    <div class="nav-wrapper">
      <a href="../hair/hair.php" class="brand-logo">Home</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
     
       <?php
	   if (isset($_SESSION["that"])) 
	 {
		if ($_SESSION["that"] == "admin") {
			 echo '<li><a href="../admin/admin.php">admin</a></li>';
		}
		else {
			echo '<li><a href="../Databases/logout.php">'.$_SESSION["that"].'  Log Out</a></li>';
		}
	 }
	 else 
	{
		echo '<li><a href="../index.php">Log in</a></li>';
	}
		
       
    ?> 
      </ul>
    </div>
  </nav>
<?php

 if (isset($_SESSION["that"]) && isset($_SESSION["image_selected"])& isset($_SESSION["set_price"])& isset($_SESSION["set_style"])) 
	 {
	

$btn =$_SESSION["image_selected"];
$price = $_SESSION["set_price"]; 
$location =  $_SESSION["locate"];
$style = $_SESSION["set_style"]; 
if (isset($_SESSION["image_selected"])) {
	echo'

	<div 	
		class="yo" 
		style="width:25%; height:80%; margin: 15px 0;
		border: 1px solid #ABADB1;
		display: block;
		box-shadow: 0 1px 2px rgba(43,59,93,0.29);
		font-family: Roboto, Helvetica Neue, Helvetica, Arial, sans-serif;
		font-size: 14px;
		font-weight: normal;
		color: rgb(51, 51, 51);
		margin:auto;"
		>

						
	<img src="../assets/'.$btn.'" alt="hair number 1" style="width:100%;height:72%; padding-bottom:2%; border-radius: 15px;" /><br/>
	<div class="outer" style="width:75%; height:20%; float:left;" >
	
	<img id="testStar" alt="uk" src="../assets/uk.png"  name="testStar" style=" width:23%;height:50%; float:left;">
	<p name="price" style=" 
	text-align:center;
	font-size:18px;"> 
	'.$price.' </p></br>
	
	</select>
	</div>
	
	';


	echo '
	<form action="success_booking.php" method="post">
	<input type="date" name="date" required><input type="time" name="usr_time" required>
	<input type="image" src="../assets/send.png" name="send"alt="send" style="width:15%; position:relative;float:right; "><br/>
	<input type="hidden" value="'.$style.'" name="style" id="style" />
	</div>
	';
	

}


	}
	else if (!isset($_SESSION["that"])){
				 echo 'please sign in to book an appointment<br/> This page will redirect in automatically redirect you in 5 seconds or <a href="../index.php" >click here</a> to log in';
		 header('Refresh: 5; URL=../index.php');
	}
	else {
		echo "please choose a style, Redirecting in 5 seconds..";
		header('Refresh: 5; URL=../hair/hair.php');
	}

?>
<form/>



</body>

<html>