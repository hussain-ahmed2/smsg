<?php 

include('connection.php');
include('utility.php');
session_start();

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
								<a href="#"><img class="user-icon" src="./assets/images/user-icon.svg"><p><?php echo $user['name']; ?></p></a>
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