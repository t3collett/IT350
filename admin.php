<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Admin</title>

    <!-- Bootstrap -->
    <?php 
    include('settings.php');
    error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

     ?>
  </head>
  <body>
	<a href="logout.php\"> Logout </a>
	<form id="userInfo" action="userQuery.php" method="post" style="margin-left: 1%">
		<h3>UsertableQuery</h3>
		<select name="username">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = "select username from IT350.".$userTable.";" ;
        	$result = mysqli_query($db_handle,$query);
    	}
		foreach ($result as $username){
			echo '<option value="'.$username['username'].'">'.$username['username'].'</option>';
		}
	?>
	</select>
	<input id="Submit" type="Submit" value="Submit" ></input>
	</form>
	<form id="updatePrivilege" action="updatePrivilege.php" method="post" style="margin-left: 1%">
		<h3>Update privilege</h3>
		<select name="username">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = "select username from IT350.".$userTable.";" ;
        	$result = mysqli_query($db_handle,$query);
    	}
		foreach ($result as $username){
			echo '<option value="'.$username['username'].'">'.$username['username'].'</option>';
		}
	?>

		</select>
		<select name="privilege">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
		</select>
		<input id="Submit" type="Submit" value="Submit" ></input>
	</form>

  </body>
</html>
