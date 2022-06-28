<?php

	session_start();

	if (isset($_SESSION['user-id'])) {
		
		header('location:home.php');
	}
	else{

		?>


			<div>
				<form action="process_signin.php" method="POST">
					
					Email : <input type="text" name="email">
					Password: <input type="password" name="password">
							<input type="submit" name="submit">


				</form>
			</div>



		<?php


	}




?>