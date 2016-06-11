<!DOCTYPE html>

<head>
<title></title>
<form name="setup form" action="" method="post">

</head>
<body style="background-color: aliceblue;">
<?php

$servername="localhost";
$username="root";
$password="";

$connection=new mysqli($servername,$username,$password);

$sql="CREATE DATABASE assignment_db";

if($connection->query($sql)===TRUE)
 {
	echo"<p>Database created successfully</p>";								
	$database="assignment_db";
	$connection=new mysqli($servername,$username,$password,$database);
	$sql1="	
	CREATE TABLE IF NOT EXISTS `booking` 
	(
	 `booking_ID` int(255) NOT NULL AUTO_INCREMENT,
	 `user_name` varchar(500) NOT NULL,
	 `date` date NOT NULL,
	 `time` time(6) NOT NULL,
	 `style` varchar(11) NOT NULL,
	 `salon` varchar(11) NOT NULL,
	 PRIMARY KEY (`booking_ID`)
	)";
	
	$sql2="
	CREATE TABLE IF NOT EXISTS `hair` 
	(
	 `style_ID` int(255) NOT NULL AUTO_INCREMENT,
	 `style_name` varchar(255) DEFAULT NULL,
	 `location` varchar(255) DEFAULT NULL,
	 `price` int(255) DEFAULT NULL,
	 `image_resource` varchar(255) DEFAULT NULL,
	 PRIMARY KEY (`style_ID`)
	)";

	$sql3="
	CREATE TABLE IF NOT EXISTS `users` 
	(
	 `ID` int(11) NOT NULL AUTO_INCREMENT,
	 `user_name` varchar(255) DEFAULT NULL,
	 `password` varchar(255) DEFAULT NULL,
	 `email_address` varchar(255) DEFAULT NULL,
	 `phone_number` varchar(255) DEFAULT NULL,
	 PRIMARY KEY (`ID`)
	)";

	$sql_hair="
	INSERT INTO `hair` (`style_ID`, `style_name`, `location`, `price`, `image_resource`) VALUES
	(1, 'dreads', 'london', 12, 'becky.jpg'),
	(2, 'short dreads', 'paris', 33, 'edith.jpg'),
	(3, 'weave', 'london', 22, 'glory.jpg'),
	(4, 'zingongo', 'new york', 23, 'gift.jpg')";

	$sql_users="
	INSERT INTO `users` (`ID`, `user_name`, `password`, `email_address`, `phone_number`) VALUES
	(1, 'admin', '123456', 'sulemartin87@gmail.com', '0884698204'),
	(5, 'mm', '123', 'martinsuleman@rocketmail.com', '123012'),
	(6, 'ssss', '123', 'martinsuleman@rocketmail.com', '1221'),
	(7, 'mmmm', '123', 'martinsuleman@rocketmail.com', '123'),
	(8, 'mmm', '123', 'martinsuleman@rocketmail.com', '123'),
	(9, 'mamao', 'wwweq', 'martinsuleman@rocketmail.com', '123'),
	(10, 'lkkj', '123', 'martinsuleman@rocketmail.com', '12233')";
					
	if(mysqli_query($connection,$sql1)&&mysqli_query($connection,$sql2)&&mysqli_query($connection,$sql3)&&mysqli_query($connection,$sql_hair)&&mysqli_query($connection,$sql_users))
		{
			echo '<form name="setup_form" action="" method="post">';
			echo"<br />";
			
			echo '<table>
			 
				<tr>
				<td>Tables created successfully </td>
				</tr>
			 <tr>
				<td>Username: admin</td>
			 </tr>
			 <tr>
				<td>Password:</td><td>  <input type="password" name="admin_pass" /></td>
			 </tr>
			 
			
			 <tr>
				<td><input type="submit" value="Register" name="pass"/></td><td><input type="reset" value="Clear form"</td>
			 </tr>
				
			</table>';
		
			if (isset($_POST['admin_pass']))
			{
				
					$sql_pass= "UPDATE `assignment_db`.`users` SET `password` = '".$_POST['admin_pass']."' WHERE `users`.`ID` = 1;";
					if(mysqli_query($connection,$sql_pass))
					{
						echo"<br />successfully updated";			
					}
					else {
						echo "error";
					}
				
			}
				
		}
 }
else 
 {
	
	echo '  <table style="margin:auto;
	">
<tr>
				<td>Database already created.</br> Create Admin Account </td>
				</tr>
			 <tr>
				<td>Username: </td><td>admin</td>
			 </tr>
			 <tr>
				<td>Password:</td><td>  <input type="password" name="admin_pass" /></td>
			 </tr>

			 <tr>
				<td><input type="submit" value="Register" name="pass"/></td><td><input type="reset" value="Clear form"</td>
			 </tr>
				
			</table>';
		
		   if (isset($_POST['admin_pass']))
			{
				
					$sql_pass= "UPDATE `assignment_db`.`users` SET `password` = '".$_POST['admin_pass']."' WHERE `users`.`ID` = 1;";
					if(mysqli_query($connection,$sql_pass))
					{
						echo"<br/>successfully updated";	
					}
					else 
					{
						echo "error";
					}
				
			}
 }	

echo'</form>';
?>

</body>

</html>