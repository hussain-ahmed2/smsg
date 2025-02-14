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

	if(isset($_GET['delmsgid'])){
		$delmsgid = $_GET['delmsgid'];
		$query = mysqli_query($conn, "DELETE from message where id = '$delmsgid'");
		return header('location:user.php');
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

					$query = "select * from message where userid = '$id' order by id desc limit 3";
					$result = mysqli_query($conn, $query);
					
					if(mysqli_num_rows($result) > 0){
						while($messages = mysqli_fetch_assoc($result)){
							?>
							<div>
								<a class='user-link' href="#"><img class="user-icon" src="./assets/images/user-icon.svg" alt="user-icon"><p><?php echo $row['name']; ?></p></a>
								<p><?php echo $messages['msg']; ?></p>
								<div class="timestamp"><?php echo $messages['timestamp']; ?></div>
								<p class="du-links">
									<a class='delete-post' href="user.php?delmsgid=<?php echo $messages['id']; ?>">Delete</a>
									<a class='update-post' href="updatepost.php?msgid=<?php echo $messages['id']; ?>">Update</a>
								</p>
							</div>
							
							<?php 
						}
					}else {
						echo 'No OMSGs posted yet.';
					}
				 ?>
			</div>
			<?php 
			if(mysqli_num_rows(mysqli_query($conn, "select * from message where userid = '$id'"))>3){ ?>
			<a id="user-all-posts" href="userallposts.php">View All Posts</a>
			<?php }
			?>
    </section>
  </main>

	<?php include 'footer.php'; ?>

</body>
</html>