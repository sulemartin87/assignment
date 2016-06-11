<?php 
			if (isset($_POST['pass']))
			{
					$sql_pass=
									"UPDATE `assignment_db`.`users` SET `password` = '".$_POST['admin_pass']."' WHERE `users`.`user_name` = admin;)";
		if(mysqli_query($connection,$sql_pass))
		{
			echo"<br />successfully updated";
			
				
		}
		else {
			echo "error";
		}
				
			}

?>