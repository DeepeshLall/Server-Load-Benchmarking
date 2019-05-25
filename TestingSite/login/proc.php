<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){

		$email = stripcslashes($_POST['email']);
		
		if(!empty($email) && !empty($_POST['password'])){
			
			include("../core/init.inc.php");
			$email = mysqli_real_escape_string($dbc,$email);

			if(valid_credentials($dbc,$email,$_POST['password'])){
				$query = "SELECT username FROM student WHERE email='".$email."'";
				$username = mysqli_query($dbc,$query) or die (mysqli_error($dbc).$query);
				$row = mysqli_fetch_array($username);
				$_SESSION["username"] = $row["username"];
				header("location: ../profile/index.php");
				exit;
			}else{
				echo "Not a valid username and password.";
			}
		}else{
			echo "Please fill all the values in the form.";
		}

	}else{
		echo "No login form has been submitted.";
	}
?>