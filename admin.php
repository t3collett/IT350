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

	<title>Contact</title>

    <!-- Bootstrap -->
    <?php 
    include('settings.php');
    error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

     ?>


  </head>
  <body>
<li id=\"logout\"><a href=\"logout.php\"> Logout </a></li> 
   
  <form  id="mail" action="mail.php" method="post" style="margin-left: 20%">
        <h2>Mail</h2>
        <h3>Name: </h3>
        <?php
          $db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
          if($db_handle){
            $query = "select name from IT210.".$userTable." where userId = '".$_SESSION['logged_in']. "';" ;
            $result = mysqli_query($db_handle,$query);
            //print_r($result);
            $row = $result->fetch_assoc();
            echo '<input type="text" id="name" name="name" value = '.$row['name'].'>';
          }
        ?>
        <h3>subject: </h3>
        <input type="text" id="subject" name="subject">
        <h3>Message: </h3>
        <textarea rows="4" cols="50" id="message" name="message"></textarea><br>
        <input id="Submit" type="Submit" value="Submit" >
      </form>
    <script>
		$(document).ready(function () {
		$('.dropdown-toggle').dropdown();
    $('#contactpg').addClass('active');
		});
	</script>
  </body>
</html>
