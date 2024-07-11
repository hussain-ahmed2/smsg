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
		<h2 id="user-header"><img id="user-icon" src="assets/images/user-icon.svg" alt="user-icon"><?php echo $row['name']; ?></h2>
	
    <section id="messages-container">
			<h3>Your latest posts <a id="create-post" href="createpost.php">Create New Post</a></h3>
      <div id="messages">
				<?php 

					$query = "select * from message where userid = '$id' order by id desc";
					$result = mysqli_query($conn, $query);
					
					if(mysqli_num_rows($result) > 0){
						while($messages = mysqli_fetch_assoc($result)){
							?>
							<div>
								<a href="#"><img class="user-icon" src="./assets/images/user-icon.svg" alt="user-icon"><p><?php echo $row['name']; ?></p></a>
								<p><?php echo $messages['msg']; ?></p>
								<p id="timestamp"><?php echo $messages['timestamp']; ?></p>
							</div>
							<?php 
						}
					}else {
						echo 'No OMSGs posted yet.';
					}
				 ?>
			</div>
    </section>
  </main>

	<?php include 'footer.php'; ?>

</body>
</html>