<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Register</title>

    <!-- Bootstrap -->

  </head>
  <body>
  <div class= "registerform">
   <h1 style="margin-left: 2%;">Register</h1>
  <form id="register" action="reg.php" method="post">

  	Name:<br><input type="text" name="name" required><br>
	User Name:<br> <input type="text" name="user_name" required><br>
	Email: <br><input type="email" name="email" required><br>

	Password: <br><input id="password" name="password" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" required><br>
	 verify password:<br> 
<input id="password_two" name="password_two" type="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" required>
  	<input type="submit" /><br>
  </form>
  </div>

    <script>
		$(document).ready(function () {
		$('.dropdown-toggle').dropdown();
    $('#login').addClass('active');
		});
	</script>
  </body>
</html>




