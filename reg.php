<?php
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

	 if($db_handle){
	 	if($_POST['name']== ''){
	 		mysqli_close($db_handle);
			header("location: register.php");
	 		exit();
	 	}
	 	$firstname = $_POST['name'];
		$lastname = "fakename";//$_POST['lastname'];
	 	$username=$_POST['user_name'];
	 	$email = $_POST['email'];
		$password=$_POST['password'];
		$password_two = $_POST['password_two'];

		if($password != $password_two){
			echo "<h1 style='color: red'> Your Passwords don't match</h1>";
			mysqli_close($db_handle);
			exit();
		}
	 	mysqli_set_charset($db_handle, "utf8");
	 	$query = "select * from IT350.".$userTable." where username = '".$username. "';" ;
	 	$result = mysqli_query($db_handle,$query);

		if ($result->num_rows > 0) {
    		echo "<h1 style='color: red'> Username is taken</h1>";
    		mysqli_close($db_handle);
			exit();

		} else {
			$query = "INSERT INTO `User` (`username`, `password`, `firstname`,`lastname`, `email`,phone) VALUES ('".$username."', SHA1('".$password."'), '".$firstname."','".$lastname."', '".$email."');";
		    mysqli_query($db_handle,$query);
		   	$result = mysqli_query($db_handle,"select username from IT350.".$userTable." where username = '".$username. "';");
		   	while ($row = mysqli_fetch_row($result))
 			{
    			session_start();
    			$_SESSION['logged_in'] = $row[0];
 			}	
		   	mysqli_close($db_handle);
		   	header("location: admin.php");
		    exit();

		}
	 	mysqli_close($db_handle);
	 }else{
	 	echo "Didn''t connect to db";
	 }
}else{
 	echo "post didn''t work";
}
?>
