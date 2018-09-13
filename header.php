<?php
//session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<base href="http://localhost/usingpdo/"> 
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
	<nav>
		<div  class="main-wrapper">
			<ul>
				<li><a href="index.php"></a>Welcome To Our Website</li>
			</ul>
			<div class="nav-login">
				<?php
				/**
				 * If The login is true, so hide the login and signup buttons and shows the sigup button
				 * Else the login is false, stay at the same page 
				*/
					if (isset($_SESSION['user'])) {
						echo '<form action="includes/logout.php" method="POST">
								<button type="submit" name="submit">Logout</button>
								</form>';
					}else{
						echo '<form action="includes/login.php" method="POST">
								<input type="text" name="user" placeholder="Insert Your Username">
								<input type="password" name="pwd" placeholder="Insert Your password">
								<button type="submit" name="submit">Login</button>
								</form>
								<a href="signup.php">Signup</a>';
						}
				?>
			</div>
		</div>
	</nav>
</header>