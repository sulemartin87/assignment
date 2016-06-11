<?php
session_start();
?>
<html>
<head>
<title>admin</title>
<link href="../style.css" rel="stylesheet" type="text/css"/>
<style>
   table, th, td 
	{
		border: 1px solid black;
		border-collapse: collapse;
		
	}
	th, td {
		padding: 10;
		text-align: left; 
		
	}
</style>

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
if (isset($_SESSION['that']))  
{
	if ($_SESSION['that'] === "admin") 
	{
				
			$servername="localhost";
			$username="root";
			$password="";
			$database="assignment_db";

			function send_mail($email)
			{
				require '../phpmailer/PHPMailerAutoload.php';
			
			$mail = new phpmailer; 
			$mail->isSMTP();                                      
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;                      
			$mail->Username = 'sulemartin87@gmail.com';                 
			$mail->Password = 'Kisamymum96';                           
			$mail->SMTPSecure = 'tls';                          
			$mail->Port = 587;                                    

			$mail->setFrom('sulemartin87@gmail.com', 'Mailer');
			$mail->addAddress(''.$email.'', 'user');    

			$mail->isHTML(true);                                  
			$mail->Subject = 'The code works';
			$mail->Body    = 'This email is coming from global styling to: '.$email.' </b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent to your E-Mail address';
			}
			}
 mysql_connect($servername, $username, $password);
 mysql_select_db($database);

	$sequel = "SELECT * FROM users";
	$result2 = mysql_query($sequel);
	
	$sequel2 = "SELECT * FROM hair";
	$result3 = mysql_query($sequel2);
	echo "<b>Manage Users</b><br/><br/>";
	echo("<table>");

	echo '<tr>
	<th>id</th>
	<th>user name</th>
	<th>password</th>
	<th>email address</th>		
	
	</tr>
	';
	$i = 1;
	$j = 1;
	while ($row = mysql_fetch_assoc($result2)) 
	{

		echo '<form name="pass" action="" method="post">';

        echo '<tr>';
       
		echo '<a name="row'.$i.'"></a>';
        echo '<td>' . $row["ID"]. '</td><td>' . $row["user_name"]. '</td><td>'. $row["password"]. '</td><td> ' . $row["email_address"]. '</td><td><input type="submit" value="remove"  name="bruh'.$i.'"/></td> <td><input type="submit" value="send email"  name="mailer'.$i.'"/></td>';

        echo '</tr>'   ;
		
	if (isset($_POST['bruh' .$i])) 
	 {
		$remove_sql = mysql_query("DELETE FROM users WHERE ID =" . $row["ID"]);	
		header("Refresh:0");
	 }
	 if (isset($_POST['mailer' .$i])) 
	 {
		$email_sql = mysql_query("SELECT email_address FROM users WHERE ID =" . $row["ID"]);	
		$finmail = $row["email_address"];
		$_SESSION['mail'] = $finmail;
		send_mail($finmail);
		
	 }
		$i++;
		 
    }
	
	echo("</table>");
	echo "</form>";
	
	}
}
	
?>
<?php
if (isset($_SESSION['that'])) 
{
 if ($_SESSION['that'] === "admin") 
 {
	 echo "<b><br/>Add A New Product</b><br/>";
echo '</div>
<form name="add stuff" action="" method="post">
<label> enter style name:     </label><input type="text" name="style_name" /> 
<label> enter location</b>:&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </label><input type="text" name="location" /> </br>
<label> &nbsp;&nbsp;&nbsp;&nbsp;enter price:   &nbsp;&nbsp;&nbsp;&nbsp;       </label><input type="text" name="price" /> 
<label> enter image resource: </label><input type="text" name="image_resource" /> </label><input type="submit" /></br>
</form>';

 }
 else {
	echo 'please sign in with your administrator account to view this page<br/> This page will redirect in automatically redirect you in 5 seconds or <a href="../index.php" >click here</a> to log in';
		 header('Refresh: 5; URL=../index.php');
 }
}
else {
	 echo 'please sign in with your administrator account to view this page<br/> This page will redirect in automatically redirect you in 5 seconds or <a href="../index.php" >click here</a> to log in';
		 header('Refresh: 5; URL=../index.php');
 }
?>
<?php 
error_reporting(E_ALL ^ E_DEPRECATED);

$servername="localhost";
$username="root";
$password="";
$database="assignment_db";
$connection=new mysqli($servername, $username, $password,$database );	
mysql_connect($servername, $username, $password);
mysql_select_db($database);
if (isset($_SESSION['that'])) 
{
 if ($_SESSION['that'] === "admin") 
 {
		
	if (isset($_POST['style_name'])) 
	{
		if (isset($_POST['location'])) 
		{
			if (isset($_POST['price'])) 
			 {
					if (isset($_POST['image_resource'])) 
					 {
								
						$sql1 ="INSERT INTO `assignment_db`.`hair` (`style_ID`, `style_name`, `location`, `price`, `image_resource`) VALUES (NULL, '".$_POST['style_name']."', '".$_POST['location']."', '".$_POST['price']."', '".$_POST['image_resource']."');";
						if ($connection->query($sql1) === TRUE) 
						{
						
						header("Refresh:0");
										
						} 

						else 
						{
						echo "Error: " . $sql . "<br>" . $connection->error;
						}
									
						exit();
					}
					
			}
			
		}
	}
 }
}
?>

<?php
if (isset($_SESSION['that'])) 
{
 if ($_SESSION['that'] === "admin") 
 {
mysql_connect($servername, $username, $password);
 mysql_select_db($database);
$j = 1;
	$sequel = "SELECT * FROM users";
	$result2 = mysql_query($sequel);
	
	$sequel2 = "SELECT * FROM hair";
	$result3 = mysql_query($sequel2);
	
	$sequel4 = "SELECT * FROM booking";
	$result4 = mysql_query($sequel4);
	 echo "<b><br/>Manage Exisiting Products</b><br/>";
while ($row = mysql_fetch_assoc($result3)) 
	{
		
		echo '<form name="pass1" action="" method="post">';
		echo '<label>id '. $row["style_ID"].'</label> <input type="text" name="style_name_update" value="'. $row["style_name"].'" /> <input type="text" name="location_update" value="'. $row["location"].'" /> <input type="text" name="price_update" value="'. $row["price"].'" /> <input type="text" name="image_resource_update" value="'. $row["image_resource"].'" /> <input type="submit" value="update" name ="update'.$row["style_ID"].'"/> <input type="submit" value="delete" name ="delete'.$row["style_ID"].'"/></br>';
		echo '</form>';
	
		
	if (isset($_POST['update' .$row["style_ID"]])) 
	 {
		$update_query = "UPDATE `assignment_db`.`hair` SET `style_name` = '".$_POST['style_name_update']."', `image_resource` = '".$_POST['image_resource_update']."' WHERE `hair`.`style_ID` = ".$row["style_ID"].";";
		  if ($connection->query($update_query) === TRUE) 
								{
									
									header("Refresh:0");
									
									
								} 
		
	 }
	 if (isset($_POST['delete' .$row["style_ID"]])) 
	 {
		 $delete_query = "DELETE FROM `assignment_db`.`hair` WHERE `hair`.`style_ID` = ".$row["style_ID"]."";
		  if ($connection->query($delete_query) === TRUE) 
								{
									
									header("Refresh:0");
									
									
								} 
		 
		echo "bruuuh";
	 }
		$j++;
		 
    }
	
	 echo "<b><br/>View Appointments</b><br/>";
	
	while ($row = mysql_fetch_assoc($result4)) 
	{

		
		echo("<table>");

	echo '<tr>
	<th>ID</th>
	<th>user name</th>
	<th>Date</th>
	<th>time</th>
	<th>style</th>
	<th>salon</th>	
	
	</tr>
	';
	$i = 1;
	$j = 1;
        echo '<tr>';
       
		echo '<a name="row'.$i.'"></a>';
        echo '<td>' . $row["booking_ID"]. '</td><td>' . $row["user_name"]. '</td><td>'. $row["date"]. '</td><td> ' . $row["time"]. '</td><td>' . $row["style"]. '<td>' . $row["salon"]. '</td>';

        echo '</tr><br/>'   ;
		
		$i++;
		 
    }
	
	echo("</table>");

	
	
 }
}
?>
</body>
</html>