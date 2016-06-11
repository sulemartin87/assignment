<?php

session_start();
if (isset($_SESSION["that"])) 
	 {
		 
		unset($_SESSION["that"]);
		
	 }
?>

<html>
<head>

<title>Log In</title>
<link href="style.css" rel="stylesheet" type="text/css"/>

</head>


<body >
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Global Styling</a>
      
    </div>
  </nav>

<form name="loginform" action="databases/Login_Database.php" method="post">

<table>
 <tr>
	<td>Username</td><td>  <input type="text" name="userNameLogin" /></td>
 </tr>
 
 <tr>
	<td>Password</td><td>  <input type="password" name="passwordLogin" /></td>
 </tr>
 
 <tr>
    <td><input type="submit" value="Login" /></td><td><input type="reset" value="Clear form"</td>
 </tr>
</table>
<p id="centerPara"><b>Register<b></p>
</form>



<form name="Registrationform" action="" method="post">

<table>

 <tr>
	<td>Email</td><td>  <input type="email" name="emailRegistration" /></td>
 </tr>

 <tr>
	<td>Username</td><td>  <input type="text" name="userNameRegistration" /></td> 
 </tr>
 <tr>
	<td>Password</td><td>  <input type="password" name="passwordRegistration" /></td>
 </tr>
 
 <tr>
	<td>Phone number</td><td>  <input type="tel" name="numberRegistration" /></td>
 </tr>

 <tr>
    <td><input type="submit" value="Register" /></td><td><input type="reset" value="Clear form"</td>
 </tr>
 	
</table>

<?php
error_reporting(E_ALL ^ E_DEPRECATED);
if (isset($_POST['userNameRegistration'])) 
{ 
	$name=$_POST["userNameRegistration"];
	$phoneNumber=$_POST["numberRegistration"];
	$email=$_POST["emailRegistration"];
	$userPassword=$_POST["passwordRegistration"];
	$servername="localhost";
	$username="root";
	$password="";
	$database="assignment_db";
	
	$sql = "INSERT INTO users (user_name,phone_number,email_address,password) VALUES ('$name', $phoneNumber, '$email','$userPassword')";
	
	$connection=new mysqli($servername, $username, $password,$database );
	
	function send_mail()
	{
		require 'phpmailer/PHPMailerAutoload.php';
	
	$email="";
	$mail = new phpmailer; 
	$mail->isSMTP();                                      
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;                      
	$mail->Username = 'sulemartin87@gmail.com';                 
	$mail->Password = 'Kisamymum96';                           
	$mail->SMTPSecure = 'tls';                          
	$mail->Port = 587;                                    

	$mail->setFrom('sulemartin87@gmail.com', 'Mailer');
	$mail->addAddress('martinsuleman@rocketmail.com', 'user');    

	$mail->isHTML(true);                                  
	$mail->Subject = 'The code works';
	$mail->Body    = 'This email is coming from <b> GLOBAL STYLING SALONS !! </b>';
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

	if($connection->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}
	else
	{
			
		$usernamesql = "Select * FROM users WHERE user_name='".$name."' LIMIT 1";
		$result123 = mysql_query($usernamesql);
		
		if (mysql_num_rows($result123) == 1) 
		 {
			echo "user name taken";
			exit();
		 }
		else 
		{
			
		 if ($connection->query($sql) === TRUE) 
			{
				echo "<p>New record created successfully, with the following details:
				<ul> <li>Name : $name</li><li>Phone : $phoneNumber</li><li>Email : $email</li></ul></p>";
				send_mail();
			} 

		 else 
			{
				echo "Error: " . $sql . "<br>" . $connection->error;
			}
			
		 exit();
		}
		
	}
	

}

?>

<?php

?>

</form>

</body>

</html>