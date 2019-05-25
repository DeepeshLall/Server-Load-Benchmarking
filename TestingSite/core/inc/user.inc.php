<?php
include("cred.inc.php");

//check if the username exists in the database.
function user_exists($dbc,$username){
	$user =mysqli_real_escape_string($dbc,$username);

	$query = "SELECT id FROM student WHERE username='".$username."'";

	$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc).$query);
	$count = mysqli_num_rows($result);

	if ($count>0) {
		//echo 'Sorry! This Username already exists!';
		return true;
	} else {
		//echo "username dosent exist";
		return false;
	}

}

//check if the given username and password combination is valid.
function  valid_credentials($dbc,$email,$password){
	$email = mysqli_real_escape_string($dbc,stripcslashes($email));
	$password = mysqli_real_escape_string($dbc,stripcslashes($password));
	$password = sha1($password);

	$query = "SELECT id FROM student WHERE email='".$email."' AND password ='".$password."'";
	$result = mysqli_query($dbc,$query) or die (mysqli_error($dbc).$query);
	$count = mysqli_num_rows($result);

	if ($count>0) {
		//correct combination
		return true;
	} else {
		//incorrect combination
		return false;
	}
}

//Add user to the database.
function add_user($dbc,$username,$email,$password,$age,$gender,$contact_number,$address){
	$bool=mysqli_query($dbc, "INSERT INTO `student` (`username`, `email`, `password`, `age`, `gender`, `contact_number`, `address`, `permission`) VALUES ('".$username."','".$email."','".sha1($password)."','".$age."','".$gender."','".$contact_number."','".$address."','1')") OR die("##COULDN'T INSERT ENTRIES INTO THE TABLE.:".mysqli_error($dbc));
	$registered = mysqli_affected_rows($dbc);
	return $bool;
}
?>