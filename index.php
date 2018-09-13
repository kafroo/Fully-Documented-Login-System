<?php 
	session_start();
	include_once'header.php'
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Home</h2>
		

		<?php
		/**
		 * When The user has logged in correctly Print the welcome message 
		 */
		if (isset($_SESSION['user'])) {
			echo "You Are Logged In";
			}
		?>
		
	</div>

</section>

<?php 
	include_once'footer.php'
?>