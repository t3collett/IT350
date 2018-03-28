<?php
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

	 if($db_handle){
	 	if(!isset($_POST['firstname'])||
	 		!isset($_POST['lastname'])||
	 		!isset($_POST['user_name'])||
	 		!isset($_POST['email'])||
	 		!isset($_POST['password'])||
	 		!isset($_POST['password_two'])||
	 		!isset($_POST['phoneNumber'])||
	 		!isset($_POST['address'])){
	 		mysqli_close($db_handle);
			//print_r($_POST);
			header("location: register.php");
	 		exit();
	 	}
	 	$firstname = filter_var($_POST['firstname'],
	 								FILTER_SANITIZE_STRING);
	 		 	$firstname = htmlentities($firstname);

		$lastname = filter_var($_POST['lastname'],
	 								FILTER_SANITIZE_STRING);//$_POST['lastname'];
	 	$lastname = htmlentities($lastname);
	 	$username=filter_var($_POST['user_name'],
	 								FILTER_SANITIZE_STRING);
	 	$username = htmlentities($username);

	 	$phoneNumber = filter_var($_POST['phoneNumber'],
	 								FILTER_SANITIZE_STRING);
	 	$phoneNumber = htmlentities($phoneNumber);
		$address =filter_var($_POST['address'],
	 								FILTER_SANITIZE_STRING);
		$address = htmlentities($address);
	 	$email = filter_var(filter_var($_POST['email'],
	 								FILTER_SANITIZE_EMAIL),
	 						FILTER_VALIDATE_EMAIL);
	 	$email = htmlentities($email);
		$password= filter_var($_POST['password'],
	 								FILTER_SANITIZE_STRING);
		$password = htmlentities($password);
		$password_two = filter_var($_POST['password_two'],
	 								FILTER_SANITIZE_STRING);
		$password_two = htmlentities($password_two);
		if(strlen($firstname) > 40 ||
			strlen($lastname) > 40 ||
			strlen($username) > 40 ||
			strlen($email) > 40 ||
			strlen($phoneNumber) > 40 ||
			strlen($address) > 255){
			mysqli_close($db_handle);
			//print_r($_POST);
			header("location: register.php");
	 		exit();
		}


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
			$query = "INSERT INTO `User` (`username`, `password`, `firstname`,`lastname`, `email`,`address`,`phoneNumber`) VALUES ('".$username."', SHA1('".$password."'), '".$firstname."','".$lastname."', '".$email."','".$address."','".$phoneNumber."');";
		    mysqli_query($db_handle,$query);
		   	$result = mysqli_query($db_handle,"select username, privilege from IT350.".$userTable." where username = '".$username. "';");
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
