<?php 

	include('connection.php');
	include('utility.php');
	session_start();
	
	if(isset($_SESSION['msg'])){
		echo msg($_SESSION['msg'], 'green');
		unset($_SESSION['msg']);
	}

	if(isset($_SESSION['err'])){
		echo msg($_SESSION['err'], 'red');
		unset($_SESSION['err']);
	}

	if(isset($_POST['submit'])){
		$user = $_POST['emailorphone'];
		$password = $_POST['password'];

		if($user == ""){
			$_SESSION['err'] = 'email or phone field is empty';
			return header('location:login.php');
		}

		if($password == ""){
			$_SESSION['err'] = 'password field is empty';
			return header('location:login.php');
		}

		$query = "SELECT * FROM users WHERE password = '$password' and email = '$user' or phone = '$user'";
		$exists = mysqli_query($conn, $query);

		if(mysqli_num_rows($exists) > 0){
			session_start();
			$row = mysqli_fetch_assoc($exists);
			$_SESSION['userid'] = $row['id'];
			$_SESSION['msg'] = 'you have successfully loged in';
			unset($_SESSION['err']);
			header('location:user.php');
		}else {
			$_SESSION['err'] = 'user not found!';
			header('location:login.php');
		}
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/login.css">
</head>
<body>

	<?php include 'header.php'; ?>

	<main>
		<section>
			<h1>Login</h1>
			<form method="POST" autocomplete="off">
				<label for="emailorphone">Email or Phone:</label>
				<input type="text" name="emailorphone" id="emailorphone" placeholder="Your email or phone" required>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" placeholder="Your password" required>
				<input type="submit" name="submit" value="Submit">
			</form>
		</section>
	</main>

	<?php include 'footer.php'; ?>

</body>
</html>