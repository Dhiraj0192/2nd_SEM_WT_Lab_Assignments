<?php


// establish connection to server

$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
	

	if ($_SERVER['REQUEST_METHOD']=="POST") {
		
		$useremail=$_POST['email'];
		$userpassword=$_POST['password'];
		if(empty($useremail) || empty($userpassword)){
			header('location: signin.php?error=All fields are required');
		}
		else{
			if (filter_var($useremail,FILTER_VALIDATE_EMAIL)) {

				$db = mysqli_select_db($connection,'social_network');
				if ($db) {
					
					$query = "SELECT * FROM users WHERE user_email='$useremail'";
					$run = mysqli_query($connection,$query);
					if (mysqli_num_rows($run)>0) {
						$row= mysqli_fetch_assoc($run);
						if (md5($userpassword)==$row['user_password']) {
								echo "hi";
							session_start();
							$_SESSION['user_id']=$row['user_id'];
							header('location:home.php');
							
						}
						else{
							header('location:signin.php?error=Invalid Password');	
						}
					}
					else{
						header('location:signin.php?error=Email Not Found');
					}
				}
				
			}
			else{
				
				header('location:signin.php?error=Email Not Found');
			}
		}
	}
	else{
		header('location:signin.php');
	}



?>