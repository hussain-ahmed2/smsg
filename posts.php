<?php 

include('connection.php');
include('utility.php');
session_start();

$id = $_SESSION['userid'];

if(isset($_GET['delmsgid'])){
	$delmsgid = $_GET['delmsgid'];
	$query = mysqli_query($conn, "DELETE from message where id = '$delmsgid'");
	return header('location:posts.php');
}

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
  <title>Posts</title>
  <link rel="stylesheet" href="./assets/css/posts.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <main>
		<h1>Posts</h1>
		
    <section id="messages-container">
			<h3>Latest posts <a id="create-post" href="createpost.php">Create New Post</a></h3>
      <div id="messages">
				<?php 

					$query = 'select * from message order by id desc';
					$result = mysqli_query($conn, $query);
					
					if(mysqli_num_rows($result) > 0){
						while($messages = mysqli_fetch_assoc($result)){
							$userid = $messages["userid"];
							$userquery = mysqli_query($conn,"select * from users where id = '$userid'");
							$user = mysqli_fetch_assoc($userquery);
							?>
							<div>
								<a href="#"><img class="user-icon" src="./assets/images/user-icon.svg" alt="user-icon"><p><?php echo $user['name']; ?></p></a>
								<p><?php echo $messages['msg']; ?></p>
								<div class="timestamp"><?php echo $messages['timestamp']; ?></div>
								<?php 
									if($id == $userid) { ?>
										<p class="du-links">
									<a class='delete-post' href="posts.php?delmsgid=<?php echo $messages['id']; ?>">Delete</a>
									<a class='update-post' href="updatepost.php?msgid=<?php echo $messages['id']; ?>">Update</a>
								</p>
									<?php }
								?>
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