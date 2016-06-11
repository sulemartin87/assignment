<?php
session_start();


?>
<html>
<head>

	<title>hair </title>
	<link href="../style.css" rel="stylesheet" type="text/css"/>
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
			 echo '<li><a href="../admin/admin.php">admin</li><li></a><a href="../Databases/logout.php">Log Out</a></li>';
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
  
  
<form action="#" method="post">

<select name="locale" style="color: rgb(39, 1, 45)";">
<option >Choose a Salon Location</option>
  <option value="london">london</option>
  <option value="paris">paris</option>
  <option value="new york">new york</option>
</select>

<input type="submit" name="submit" value="Get Hair Styles" />



<?php 
error_reporting(E_ALL ^ E_DEPRECATED);

$servername="localhost";
$username="root";
$password="";
$database="assignment_db";


	function convertCurrency($amount, $from, $to)
	{
	$data = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from&to=$to");
	preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
	$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
	return number_format(round($converted, 3),2);
	}

if(isset($_POST['submit']))
{
	$selected_val = $_POST['locale'];  
	echo '<b style="color: rgb(181, 126, 126)";">Location :' .$selected_val;  
	echo '</form>';

	mysql_connect($servername, $username, $password);
	mysql_select_db($database);

	$sql = mysql_query("Select * FROM hair WHERE location='".$selected_val."'");


	$i = 1;
	while ($row = mysql_fetch_assoc($sql)) 
	{ 

		$sql2 = mysql_query("Select * FROM hair WHERE style_ID = '".$i."'");
		while ($row = mysql_fetch_assoc($sql2)) 
		{ 
		$hair_name = mysql_query("Select style_name FROM hair WHERE style_ID = '".$i."'");
		$hair_name_style = mysql_fetch_assoc($hair_name); 
		$print_hair=$hair_name_style['style_name'];

		$hair_price = mysql_query("Select price FROM hair WHERE style_ID = '".$i."'");
		$hair_style_price = mysql_fetch_assoc($hair_price); 
		$print_hair_price=$hair_style_price['price'];

		$hair_res = mysql_query("Select image_resource FROM hair WHERE style_ID = '".$i."'");
		$hair_style_res = mysql_fetch_assoc($hair_res); 
		$print_hair_res=$hair_style_res['image_resource'];
		echo '
		<form name="menuForm"'.$i.'" id="menuForm" action="../bookings/bookings.php" method="post">
		<div 	
		class="yo"'.$i.'" 
		style="width:25%; height:60%; 
		margin:auto;
		position:relative;
		box-shadow: 0 1px 2px rgb(228, 16, 16);
		font-family: Roboto, "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size: 14px;
		font-weight: normal;
		color: rgb(51, 51, 51);
		background-color: #fcfcfc;
		"
		>		
				
		<img src="../assets/'.$print_hair_res.'" alt="hair number 1" style="width:100%;height:75%; padding-bottom:2%; " name="res"><br/>
		
		<p 
		 
		style="
		color: rgb(181, 126, 126);
		 text-align:center; 
		  padding:0;
		 font-size:18px;" 
		 value="'.$print_hair_price.'">
		 
		 <input type="hidden" value="'.$selected_val.'" name="location" id="location" />
		 <input type="hidden" value="'.$print_hair.'" name="style" id="style" />
		 '.$print_hair. '';
		 if ($selected_val == "london") {
			 
			   $print_hair_price = " " .$print_hair_price." pounds</p>";
			   echo $print_hair_price;
			
			 $_SESSION["locate"] = $selected_val; 
			   $_SESSION["image_selected"] = $print_hair_res; 
			   $_SESSION["set_price"] = $print_hair_price;
			   $_SESSION["set_style"] = $print_hair;
		 }
		 if ($selected_val == "paris") {
			  $print_hair_price = convertCurrency("".$print_hair_price."", "GBP", "FRF");
			  $print_hair_price = " " .$print_hair_price." franc</p>";
			   
			   echo $print_hair_price;
			   $_SESSION["locate"] = $selected_val; 
			   $_SESSION["image_selected"] = $print_hair_res; 
			   $_SESSION["set_price"] = $print_hair_price;
			   $_SESSION["set_style"] = $print_hair;
		
		 }
		
		 else if ($selected_val == "new york") {
			 $print_hair_price = convertCurrency("".$print_hair_price."", "GBP", "USD");
			$print_hair_price = " " .$print_hair_price." dollars</p>";
			   
			   echo $print_hair_price;
			   
			   $_SESSION["locate"] = $selected_val; 
			   $_SESSION["image_selected"] = $print_hair_res; 
			   $_SESSION["set_price"] = $print_hair_price;
			   $_SESSION["set_style"] = $print_hair;
		 }
		 
		echo '<input type="image" title="Make a Booking" value="'.$print_hair_res.'" src="../assets/fab.png" alt="fab" style="width:20%;position: absolute;
right:    0;
bottom:   0; " name="button"><br/>
		</form>

		</div>
		';
		
		}
	 $i++;
	}
	
}
?>
</body>

<html>