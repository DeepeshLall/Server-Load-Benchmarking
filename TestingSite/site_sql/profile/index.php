<?php
	include("../core/init.inc.php");

	if(isset($_POST['logout_btn'])){
		session_destroy();
		header("location: ../index.html");
		exit();
	}

	$username = $_SESSION["username"];

	$query = "SELECT username,age,gender,contact_number,address,permission FROM student WHERE username='".$username."'";
	$data = mysqli_query($dbc,$query) or die (mysqli_error($dbc).$query);
	$row = mysqli_fetch_array($data);
	
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
		$update_data = mysqli_query($dbc,"UPDATE student SET permission='".$permission."' WHERE username='".$username."'");
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
				$search_object = mysqli_query($dbc,"SELECT id,age,gender,contact_number,address,permission FROM student WHERE username='".$search_username."'") OR die(mysqli_error($dbc).$query);
				$no_of_row = mysqli_num_rows($search_object);
				if($no_of_row){
					echo $search_username." is present in the network.";
					$search_data = mysqli_fetch_array($search_object);
					$searched_id = $search_data['id'];
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
						Age: ".$searched_age."<br><br>
						Gender: ".$searched_gender." <br><br>
						Contact Number: ".$searched_contact_number."<br><br>
						Address: ".$searched_address."
						";
					}else{
						echo "This Student's details are Hidden.";
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