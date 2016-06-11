<?php
session_start();
?>
  
<?php
error_reporting(E_ALL ^ E_DEPRECATED);

	
	$servername="localhost";
	$username="root";
	$password="";
	$database="assignment_db";
	 mysql_connect($servername, $username, $password);
 mysql_select_db($database);
	if (isset($_SESSION["that"])&&isset($_POST["date"]) &&isset($_POST["usr_time"]) &&isset($_POST["style"])&&isset($_SESSION["locate"])) 
	{
		if ($_POST["usr_time"] === "" && $_POST["date"] === "")
		{
			echo 'please select time and date<br/> This page will redirect  automatically redirect you in 5 seconds or <a href="../hair/hair.php" >click here</a> to book again if it does not automatically redirect you ';
		 header('Refresh: 5; URL=bookings.php');
		}
		else if ($_POST["date"] === "" && $_POST["usr_time"] !== "")
		{
			echo 'please select date<br/> This page will redirect  automatically redirect you in 5 seconds or <a href="../hair/hair.php" >click here</a> to book again if it does not automatically redirect you ';
		 header('Refresh: 5; URL=bookings.php');
		}
		else if ($_POST["usr_time"] === "" && $_POST["date"] !== "")
		{
			echo 'please select time<br/> This page will redirect automatically redirect you in 5 seconds or <a href="../hair/hair.php" >click here</a> to book again if it does not automatically redirect you ';
		 header('Refresh: 5; URL=bookings.php');
		}
		else
		{
		$sql = "INSERT INTO `assignment_db`.`booking` (`booking_ID`, `user_name`, `date`, `time`, `style`, `salon`) VALUES (NULL, '".$_SESSION["that"]."', '".$_POST["date"]."', '".$_POST["usr_time"]."', '".$_POST["style"]."', '".$_SESSION["locate"]."')";
		$connection=new mysqli($servername, $username, $password,$database );
		
		mysql_connect($servername, $username, $password);
		mysql_select_db($database);

		if($connection->connect_error)
		{
			die("Connection failed: ".$conn->connect_error);
		}
		else
		{
				
			 if ($connection->query($sql) === TRUE) 
				{
					echo "<p>New booking successful, with the following details:</br> 
					date:".$_POST["date"]."<br/> Time:".$_POST["usr_time"]." <br/>Hair Style:".$_POST["style"]."<br/>
					 Location: ".$_SESSION["locate"]."<br/>";
					 $email_sql = mysql_query("SELECT * FROM `users` WHERE `user_name` = '".$_SESSION["that"]."'");	
					 while ($row = mysql_fetch_assoc($email_sql))  {
						 	
								$finmail = $row["email_address"];
							$_SESSION['mail'] = $finmail;
					send_mail($finmail,$_POST["usr_time"], $_POST["date"]);
					 }
					 
	
		
		
		unset($_SESSION["image_selected"]);
		unset($_SESSION["set_price"]);
		unset($_SESSION["locate"]);
		unset($_SESSION["set_style"]);
				} 

			 else 
				{
					echo "Error: " . $sql . "<br>" . $connection->error;
				}
				
			 exit();
			
		}
		
		}
	

	 } 
	 else if (!isset($_SESSION["that"]))
	 {
		 echo 'please sign in to book<br/> This page will redirect in automatically redirect you in 5 seconds or <a href="../index.php" >click here</a> to log in';
		 header('Refresh: 5; URL=../index.php');
	 }
	 
	 function send_mail($email,$date,$time)
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
			$mail->Subject = 'booking';
			$mail->Body    = 'This email is coming from global styling to: '.$email.' </br>
								your booking is set for '.$date.' at '.$time.' 
								thank you for booking with us. Global Styling';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent to your E-Mail address';
			}
			}

?>