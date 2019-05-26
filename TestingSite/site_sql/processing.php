<?php
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$username = stripcslashes($_POST['username']);
	$email = stripcslashes($_POST['email']);
	$age = stripcslashes($_POST['age']);
	$gender = stripcslashes($_POST['gender']);
	$contact_number = stripcslashes($_POST['contact_number']);
	$address = $_POST['address'];

		if(!empty($username) && !empty($email) && !empty($age) && !empty($gender) && !empty($contact_number) && !empty($address) && !empty($_POST['password']) && !empty($_POST['password2'])){

			include("core/init.inc.php");

			$username = mysqli_real_escape_string($dbc,$username);
			$email = mysqli_real_escape_string($dbc,$email);
			$age = mysqli_real_escape_string($dbc,$age);
			$gender = mysqli_real_escape_string($dbc,$gender);
			$contact_number = mysqli_real_escape_string($dbc,$contact_number);
			$address = mysqli_real_escape_string($dbc,$address);

			if(!user_exists($dbc,$username)){
				if(add_user($dbc,$username,$email,mysqli_real_escape_string($dbc,$_POST['password']),$age,$gender,$contact_number,$address)){
					$_SESSION['username'] = $username;
					header('location: profile/index.php');
					exit;
				}
			}else{
				echo "This username already exists.";
			}

		}else{
			echo "Please fill all the values in the form.";
		}
	}else{
		echo "No Register Form has been submitted.";
	}

?>