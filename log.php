<?php
include('settings.php');
//echo $_POST;
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	//echo "is set\n";
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);


	 if($db_handle){
	 	$username=$_POST['user_name'];
		$password=$_POST['Password'];
	 	//echo "creating query\n";
	 	//$username = stripslashes($username);
		// $password = stripslashes($password);
		// $username = mysql_real_escape_string($username);
		// $password = mysql_real_escape_string($password);
	 	mysqli_set_charset($db_handle, "utf8");
	 	$query = "select * from IT350.".$userTable." where username = '".$username. "' and password = SHA1('".$password."');" ;
	 	//echo "<br>".$query."<br>";
	 	$result = mysqli_query($db_handle,$query);
	 	//echo $result."<br>";
	 	//$row = mysqli_fetch_row($result);

		if ($result->num_rows > 0) {
    		// output data of each row
    		$row = $result->fetch_assoc();
        	//echo "id: " . $row["userId"]. " - pass: " . $row["password"]. " " . $row["user_name"]. "<br>";
    		//}
    		session_start();
    		$_SESSION['logged_in'] = $row['username'];
			//echo "session should have started";
			//$_SESSION["id"] = $row["userId"];
			//mysqli_query($db_handle,"UPDATE `Users` SET `logged_in` = '1' WHERE `Users`.`userId` = ".$row["userId"].";");
			header("Location: admin.php");
	 		mysqli_close($db_handle);
			exit();

		} else {
		    echo "0 results";
		}
	 	//if(!$row){
	 	// 	echo "failed to login\n";
	 	// }
	 	// else{
	 	// 	echo "starting session";
	 	// 	session_start([
   //   			'cookie_lifetime' => 21600
			// ]);
	 	// }
	 	mysqli_close($db_handle);
	 }else{
	 	echo "Didn''t connect to db";
	 }
}else{
 	echo "post didn''t work";
}
//echo "<script> $.post( \"login.php\", function( ) { alert( \"Login Falied\"); });;</script>";
header("Location: login.php?login=Failed");
?>
