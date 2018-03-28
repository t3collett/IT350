<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
print_r($_POST);
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
  <form id="List All Items" action="listAllItems.php" method="post" style="margin-left: 1%">
		<h3>List All items</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
  <form id="filter" action="catalog.php" method="post" style="margin-left: 1%">
		<h3>Filter by catagory</h3>
		<select name="category">
		<option value="-1"> All</option>
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = $db_handle->prepare("select categoryId, name from Category;");
        	$query->execute();
	 		$query->bind_result($id,$name);
	 		while( $query->fetch()){
	 			echo '<option value="'.$id.'">'.$name.'</option>';
	 		}
	 		$query->close();

		}
	?>	</select>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
<form id="Order Item" action="insertItem.php" method="post" style="margin-left: 1%">
		<h3>Order Item</h3>
		<select name="item">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
		if($db_handle){
			//echo '<option > hello</option > ';
			if($_POST['category'] == NULL || $_POST['category'] < 0){
        		$query = $db_handle->prepare("select itemId, itemName from Item;");
        		$query->execute();
	 			$query->bind_result($id,$name);
	 			while( $query->fetch()){
	 				echo '<option value="'.$id.'">'.$name.'</option>';
	 			}
	 			$query->close();

			}else{
				//echo '<option>im alive</option>';
				$query = $db_handle->prepare("select itemId, itemName from Item where categoryId = ?;");
				$query->bind_param("i",$_POST['category']);
				//echo ' <option>'.$query.'<option>';
        		$query->execute();
	 			$query->bind_result($id,$name);
	 			while( $query->fetch()){
	 				echo '<option value="'.$id.'">'.$name.'</option>';
	 			}
	 			$query->close();
			}
			//echo '<option > goodbye </option>';
		}
	?></select>
		<input id="Submit" type="Submit" value="order" ></input>
		<input id="Submit" type="Submit" formaction="/IT350/reviews.php" value="reviews" ></input>
		</form>
		<form id="Order Item" action="logReview.php" method="post" style="margin-left: 1%">
		<h3>Review Item</h3>
		<select name="item">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
		if($db_handle){
			//echo '<option > hello</option > ';
			if($_POST['category'] == NULL || $_POST['category'] < 0){
        		$query = $db_handle->prepare("select itemId, itemName from Item;");
        		$query->execute();
	 			$query->bind_result($id,$name);
	 			while( $query->fetch()){
	 				echo '<option value="'.$id.'">'.$name.'</option>';
	 			}
	 			$query->close();

			}else{
				//echo '<option>im alive</option>';
				$query = $db_handle->prepare("select itemId, itemName from Item where categoryId = ?;");
				$query->bind_param("i",$_POST['category']);
				//echo ' <option>'.$query.'<option>';
        		$query->execute();
	 			$query->bind_result($id,$name);
	 			while( $query->fetch()){
	 				echo '<option value="'.$id.'">'.$name.'</option>';
	 			}
	 			$query->close();
			}
			//echo '<option > goodbye </option>';
		}
	?></select><br>
		<textarea rows="4" cols="50" name="review"></textarea>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>

</body>
</html>