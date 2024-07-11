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

	if(isset($_GET['logout'])){
		session_destroy();
		header('location:index.php');
	}

	$id = $_SESSION['userid'];

  if(isset($_POST['submit'])){
    $msg = $_POST['msg'];

    $iq = "INSERT INTO message (userid, msg) VALUES ('$id', '$msg')";
    $insert = mysqli_query($conn, $iq);
    
    if(isset($insert)){
      $_SESSION['msg'] = 'post created successfully';
      header('location:user.php');
    }else{
      $_SESSION['err'] = 'something went wrong!';
      header('location:user.php');
    }
  }

 ?>

 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
	<title>Create Post</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/createpost.css">
</head>
<body>

	<?php include 'header.php'; ?>

	<main>
		<section>
			<h1>Create Post</h1>
			<form method="POST" autocomplete="off">
				<label for="msg">Whats on your mind:</label>
				<textarea name="msg" id="msg"  cols="30" rows="6" placeholder="Type here..." required></textarea>
				<input type="submit" name="submit" value="Submit">
			</form>
		</section>
	</main>

	<?php include 'footer.php'; ?>

</body>
</html>