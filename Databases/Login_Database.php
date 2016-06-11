<?php
session_start();
?>
<html>
<head>
<title>Log in</title>
<style>
body{width:50%;;margin:auto;}
div#container{background-color:RGB(192,192,192);text-align:center;font-family:"arial";padding:2%;}
</style>
<link href="../style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
 <nav>
    <div class="nav-wrapper">
      <a href="../hair/hair.php" class="brand-logo">Home</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down"> 
      </ul>
    </div>
  </nav>
<div id="container">
<?php 
error_reporting(E_ALL ^ E_DEPRECATED);
$name=$_POST["userNameLogin"];
$userPassword=$_POST["passwordLogin"];

$servername="localhost";
$username="root";
$password="";
$database="assignment_db";

mysql_connect($servername, $username, $password);
mysql_select_db($database);

if (isset($_POST['userNameLogin'])) 
{
	$bruh = $_POST['userNameLogin'];
	 
	$sql = "Select * FROM users WHERE user_name='".$name."' And password='".$userPassword."' LIMIT 1";
	$result = mysql_query($sql);

	if (mysql_num_rows($result) == 1) 
	{
		$_SESSION["that"] = $bruh;
	if (isset($_SESSION["that"])) 
	 {
		 
		
		echo "you have successfuly logged in ".$_SESSION["that"]."";
		echo '<b id="logout"><a href="logout.php">Log Out</a></b>';
		if ($_SESSION["that"] == "admin") {
			 echo '<li><a href="../admin/admin.php">admin</a></li>';
		}
	 }
		
		exit();
	}
	else 
	{
		session_destroy();
		echo "invalid credentials";
		exit();
	}
	
}

?>
</div>

</body>
</html>