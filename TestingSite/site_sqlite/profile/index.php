<?php
	include("../inc/init.inc.php");

	if(isset($_POST['logout_btn'])){
		$dbc->close();
		unset($dbc);
		session_destroy();
		header("location: ../index.html");
		exit();
	}

	$username = $_SESSION["username"];

	$query = "SELECT email,age,gender,contact_number,address,permission FROM student WHERE username='".$username."'";
	$data = $dbc->query($query);
	$row = $data->fetchArray();
	
	$email = $row['email'];
	$age = $row['age'];
	$gender = $row['gender'];
	$contact_number = $row['contact_number'];
	$address = $row['address'];

	if(isset($_POST['update_btn'])){
		if($_POST['permission'] == 1){
			$permission = 1;
		}else{
			$permission = 0;
		}
		$update_data = $dbc->query("UPDATE student SET permission='".$permission."' WHERE username='".$username."'");
	}else{
		$permission = $row['permission'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>

	</title>
</head>
<body>
	<div>
		<b>Hey!</b> <?php echo $username; ?>.
	</div>
	<div>
		These are your personal details.<br><br>
		<tr>
			<td><b>Username:</b></td> 
			<td><?php echo $username; ?></td>
		</tr>
		<br><br> 
		<tr>
			<td><b>Email:</b></td> 
			<td><?php echo $email; ?></td>
		</tr>
		<br><br> 
		<tr>
			<td><b>Age:</b></td> 
			<td><?php echo $age; ?></td>
		</tr>
		<br><br> 
		<tr>
			<td><b>Gender:</b></td>
			<td><?php if($gender == "M"){echo "Male";}else{echo "Female";} ?></td>
		</tr>
		<br><br>
		<tr>
			<td><b>Contact Number:</b></td>
			<td><?php echo $contact_number; ?></td>
		</tr>
		<br><br>
		<tr>
			<td><b>Address:</b></td>
			<td><?php echo $address; ?></td>
		</tr>
		<br><br>
		Your account is <?php if($permission == "1"){echo "Visible";}else{echo "Hidden";} ?>.<br>
	</div>
	<div>
		<form action="index.php" method="post">
			<tr>
				<td>Do You want these to be visible?</td>
				<td><input type="radio" name="permission" value="1">YES</td>
				<td><input type="radio" name="permission" value="0">NO</td>
			</tr>
			<br><br>
			<tr>
				<td></td>
				<td><input type="submit" name="update_btn" value="Update"></td>
			</tr><br><br>
		</form>
	</div>
	<div>
		<form action="index.php" method="post">
			<tr>
				<td>Type a username to search</td>
				<td><input type="text" name="search_username"></td>
			</tr>
			<br><br>
			<tr>
				<td></td>
				<td><input type="submit" name="search_btn" value="Search"></td>
			</tr>
		</form><br><br>
	</div>
	<div>
		<?php
			if(isset($_POST['search_btn'])){
				$search_username = $_POST['search_username'];
				$search_object = $dbc->query("SELECT count(id) as count FROM student WHERE username='".$search_username."'");
				$srow = $search_object->fetchArray();
				if($srow['count']>0){
					echo $search_username." is present in the network.";
					$search_object2 = $dbc->query("SELECT id,email,age,gender,contact_number,address,permission FROM student WHERE username='".$search_username."'");
					$search_data = $search_object2->fetchArray();
					$searched_id = $search_data['id'];
					$searched_email = $search_data['email'];
					$searched_age = $search_data['age'];
					$searched_gender = $search_data['gender'];
					if($searched_gender == 'M'){
						$searched_gender = 'Male';
					}else{
						$searched_gender = 'Female';
					}
					$searched_contact_number = $search_data['contact_number'];
					$searched_address = $search_data['address'];
					$search_permission = $search_data['permission'];	

					if($search_permission == '1'){
						echo "And his Details are: <br><br>
						Student ID : ".$searched_id."<br><br>
						Email : ".$searched_email."<br><br>
						Age: ".$searched_age."<br><br>
						Gender: ".$searched_gender." <br><br>
						Contact Number: ".$searched_contact_number."<br><br>
						Address: ".$searched_address."
						";
					}else{
						echo " This Student's details are Hidden.";
					}
				}else{
					echo "This Student is not in the network.";
				}
			}
		?>
	</div><br><br>
	<div>
		<form method="post" action="index.php">
			<tr>
				<td></td>
				<td><input type="submit" name="logout_btn" value="Logout"></td>
			</tr>
		</form>
	</div>
</body>
</html>