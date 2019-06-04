<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){

		$username = stripcslashes($_POST['username']);
		
		if(!empty($username) && !empty($_POST['password'])){
			
			include("../inc/init.inc.php");

			if(valid_credentials($dbc,$username,$_POST['password'])){
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