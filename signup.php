<?php 

	include('connection.php');
	include('utility.php');
	session_start();

	if(isset($_SESSION['msg'])){
		echo msg($_SESSION['msg'], 'red');
	}

	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];

		$query = mysqli_query($conn, "select * from users where email = '$email' or phone = '$phone'");
		$row = mysqli_num_rows($query);
		$reault = mysqli_fetch_assoc($query);

		if($row > 0){
			$_SESSION['msg'] = 'user already exists';
			header("location:signup.php");
		}else{
			if($password == $cpassword){
				$query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
				$_SESSION['msg'] = 'something went wrong!';
				if(!$query) return header('location:signup.php');
				$success = mysqli_query($conn, $query);
				if(!$success) return header('location:signup.php');
				$_SESSION['msg'] = 'account successfully created';
				header("location:login.php");
			}
			else{
				$_SESSION['msg'] = 'password did not match';
				return header("location:signup.php");
			}
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/signup.css">
</head>
<body>

	<?php include 'header.php'; ?>

	<main>
		<section>
			<h1>SignUp</h1>
			<form method="POST" autocomplete="off">
				<label for="name">Name:</label>
				<input type="text" name="name" id="name" placeholder="Your name" required>
				<label for="email">Email:</label>
				<input type="email" name="email" id="email" placeholder="Your email" required>
				<label for="phone">Phone:</label>
				<input type="text" name="phone" id="phone" placeholder="Your phone" required>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" placeholder="Make a new password" required>
				<label for="cpassword">Confirm Password:</label>
				<input type="password" name="cpassword" id="cpassword" placeholder="Retype your password" required>
				<input type="submit" name="submit" value="Submit">
			</form>
		</section>
	</main>

	<?php include 'footer.php'; ?>

</body>
</html>