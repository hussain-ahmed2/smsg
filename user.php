<?php 

	include('connection.php');
	include('utility.php');
	session_start();

	if(isset($_SESSION['welcome'])){
		echo msg($_SESSION['welcome'], 'green');
		unset($_SESSION['welcome']);
	}

	if(isset($_GET['logout'])){
		session_destroy();
		header('location:index.php');
	}

	$id = $_SESSION['userid'];
	$query = "SELECT * FROM users WHERE id = '$id'";
	$user = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($user);

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
	<title><?php echo $row['name']; ?></title>
	<link rel="stylesheet" type="text/css" href="./assets/css/user.css">
</head>
<body>

	<?php include 'header.php'; ?>

	<main>
		<section>
			<h1>User</h1>
			
		</section>
	</main>

	<?php include 'footer.php'; ?>

</body>
</html>