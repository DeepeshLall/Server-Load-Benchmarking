<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){

		$email = stripcslashes($_POST['email']);
		
		if(!empty($email) && !empty($_POST['password'])){
			
			include("../inc/init.inc.php");

			if(valid_credentials($dbc,$email,$_POST['password'])){
				$query = "SELECT username FROM student WHERE email='".$email."'";
				$res = $dbc->query($query);
				$row = $res->fetchArray();
				$username = $row['username'];
				$_SESSION['username']=$username;
				header('location:../profile/index.php');
				exit();
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