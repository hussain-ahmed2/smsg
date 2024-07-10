<header>
	<nav>
		<a href="index.php"><img id='logo' src="assets/images/logo.svg" alt="logo"><h2>OMSG.</h2></a>
		<ul>
			<li><a href="<?php if(isset($_SESSION['userid'])){ ?>user.php<?php } else { ?>index.php<?php }; ?>">Home</a></li>
			<?php if(isset($_SESSION['userid'])){ ?>
				<li><a href="posts.php">Posts</a></li>
				<li><a id="logout" href="user.php?logout=true">Logout</a></li>
			<?php }else{ ?>
				<li><a id="signup" href="signup.php">SignUp</a></li>
				<li><a id="login" href="login.php">Login</a></li>
			<?php }
			?>
		</ul>
	</nav>
</header>