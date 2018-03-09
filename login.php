<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <script src="login.js"></script>
    <title>Login</title>

    <!-- Bootstrap -->
    
    <?php 

     ?>
  </head>
  <body>
	   	

  	<center>
		<form  id="login" action="log.php" method="post">
    		<?php
    		session_start();
    			if ($_SESSION['logged_in'] != NULL) {
    				echo "You are logged in";
    			}
    		?>
    		<h2>Login</h2>
    		<h3>User Name: </h3>
    		<input type="text" id="user_name" name="user_name">
    		<h3>Password: </h3>
    		<input type="Password" id="Password" name="Password">
		    <input id="Submit" type="Submit" value="Submit" >
    	</form>
      <br>
      <a href="register.php">or register here</a>

	</center>
	<script>
		$(document).ready(function () {
		$('.dropdown-toggle').dropdown();
    $('#login').addClass('active');
		});
		</script>
  </body>
</html>
