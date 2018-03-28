<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
include('settings.php');
//echo $_POST;
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST) && isset($_POST['item'])){
	$itemId = $_POST['item'];
	passthru("python reviews.py $itemId",$output);
	echo $output;
    $myfile = fopen("reviews.txt", "r") or die("Unable to open file!");
	echo fread($myfile,filesize("reviews.txt"));
	fclose($myfile);
}