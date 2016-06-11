<?php 
error_reporting(E_ALL ^ E_DEPRECATED);

$servername="localhost";
$username="root";
$password="";
$database="assignment_db";


	$connection=new mysqli($servername, $username, $password,$database );
	
	mysql_connect($servername, $username, $password);
	mysql_select_db($database);

if (isset($_POST['style_name'])) 
{
	if (isset($_POST['location'])) 
	{
		if (isset($_POST['price'])) 
			{
				if (isset($_POST['image_resource'])) 
						{
							
							$sql ="INSERT INTO `assignment_db`.`hair` (`style_ID`, `style_name`, `location`, `price`, `image_resource`) VALUES (NULL, '".$_POST['style_name']."', '".$_POST['location']."', '".$_POST['price']."', '".$_POST['image_resource']."');";
							if ($connection->query($sql) === TRUE) 
								{
									echo "done bruh";
									
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
?>