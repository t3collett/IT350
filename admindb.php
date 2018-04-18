<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
$sessionInfo = $_SESSION['logged_in'];
if($sessionInfo['privilege'] < 1){
	header("Location: catalog.php");
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

	<title>AdminDB</title>

    <!-- Bootstrap -->
    <?php 
    include('settings.php');
    error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

     ?>
  </head>
  <body>
  	<?php
  		//print_r($_SESSION['logged_in']);
  	?>
	<a href="logout.php\"> Logout </a>
	
	
	<form id="backupSQL" action="backupSQL.php" method="post" style="margin-left: 1%">
		<h3>backup SQL</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="backupMDB" action="backupMDB.php" method="post" style="margin-left: 1%">
		<h3>backup MDB</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="backupElastic" action="backupElastic.php" method="post" style="margin-left: 1%">
		<h3>backup Elastic Search</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>	
	 <!-- <form id="restoreSQL" action="restoreSQL.php" method="post" style="margin-left: 1%"> 
		<h3>restore SQL</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="restoreMDB" action="restoreMDB.php" method="post" style="margin-left: 1%">
		<h3>restore MDB</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form> -->
	<form id="statusSQL" action="statusSQL.php" method="post" style="margin-left: 1%">
		<h3>status SQL</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="statusMDB" action="statusMDB.php" method="post" style="margin-left: 1%">
		<h3>status MDB</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="statusMDB" action="statusElastic.php" method="post" style="margin-left: 1%">
		<h3>status ElasticSearch</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="usageSQL" action="usageSQL.php" method="post" style="margin-left: 1%">
		<h3>usage SQL</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="usageMDB" action="usageMDB.php" method="post" style="margin-left: 1%">
		<h3>usage MDB</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="usageEl" action="usageElastic.php" method="post" style="margin-left: 1%">
		<h3>usage ElasticSearch</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
		<br>
		<br>
  </body>
</html>