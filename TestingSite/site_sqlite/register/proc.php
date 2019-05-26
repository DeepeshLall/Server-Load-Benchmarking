<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$username = stripcslashes($_POST['username']);
	$email = stripcslashes($_POST['email']);
	$age = stripcslashes($_POST['age']);
	$gender = stripcslashes($_POST['gender']);
	$contact_number = stripcslashes($_POST['contact_number']);
	$address = $_POST['address'];

		if(!empty($username) && !empty($email) && !empty($age) && !empty($gender) && !empty($contact_number) && !empty($address) && !empty($_POST['password']) && !empty($_POST['password2']) && ($_POST['password'] == $_POST['password2']) ){

			include("../inc/init.inc.php");

			if(!user_exist($dbc,$username)){
				if(add_user($dbc,$username,$email,$_POST['password'],$age,$gender,$contact_number,$address)){
					$_SESSION['username']=$username;
					header('location:../profile/index.php');
					exit();
				}else{
					echo "User couldn't be added.";
				}
			}else{
				echo "This username already exists.";
			}

		}else{
			echo "Please fill all the values in the form Correctly.";
		}
	}else{
		echo "No Register Form has been submitted.";
	}

?>