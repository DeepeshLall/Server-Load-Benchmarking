<?php

function user_exist($dbc,$username){

	$query = "SELECT count(id) as count FROM student WHERE username='".$username."'";

	$result = $dbc->query($query);
	$count = $result->fetchArray();

	if($count['count']>0){
		return true;
	}else{
		return false;
	}
}

function  valid_credentials($dbc,$username,$password){
	$password = sha1($password);

	$query = "SELECT count(id) as count FROM student WHERE username='".$username."' AND password='".$password."'";
	// echo $query;
	$result = $dbc->query($query);
	$count = $result->fetchArray();
	// echo $count;
	if ($count['count']>0) {
		//correct combination
		return true;
	} else {
		//incorrect combination
		return false;
	}
}

function add_user($dbc,$username,$email,$password,$age,$gender,$contact_number,$address){
	$bool=$dbc->query("INSERT INTO `student` (`username`, `email`, `password`, `age`, `gender`, `contact_number`, `address`, `permission`) VALUES ('".$username."','".$email."','".sha1($password)."','".$age."','".$gender."','".$contact_number."','".$address."','1')");
	return $bool;
}
?>