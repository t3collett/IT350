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

	<title>Admin</title>

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
	<form id="userInfo" action="deleteUser.php" method="post" style="margin-left: 1%">
		<h3>Delete User</h3>
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
<form id="List All Items" action="listAllItems.php" method="post" style="margin-left: 1%">
		<h3>List All items</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
<form id="Insert Item" action="insertItem.php" method="post" style="margin-left: 1%">
		<h3>Insert Item</h3>
		Item Name:
		<br><input type="text" name="itemName">
		<br>Item Description:
		<br><input type="text" name="description">
		<br>Item quantity:
		<br><input type="number" name="quantity">
		<br>Item Cost:
		<br><input type="number" step="0.01" name="cost">
		<br>Category
		<br><select name="category">
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
	?></select>
		<br><br><input id="Submit" type="Submit" value="Submit" ></input>
		</form>
		<form id="userInfo" action="deleteItem.php" method="post" style="margin-left: 1%">
		<h3>Delete Item</h3>
		<select name="item">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = $db_handle->prepare("select itemId, itemName from Item;");
        	$query->execute();
	 		$query->bind_result($id,$name);
	 		while( $query->fetch()){
	 			echo '<option value="'.$id.'">'.$id." ".$name.'</option>';
	 		}
	 		$query->close();
    	}
	?>
	</select>
	<input id="Submit" type="Submit" value="Submit" ></input>
	</form>


	<form  action="updateItemQuantity.php" method="post" style="margin-left: 1%">
		<h3>Add to Inventory</h3>
		<select name="itemId">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = $db_handle->prepare("select itemId, itemName from Item;");
        	$query->execute();
	 		$query->bind_result($id,$name);
	 		while( $query->fetch()){
	 			echo '<option value="'.$id.'">'.$id." ".$name.'</option>';
	 		}
	 		$query->close();
    	}
	?>
	</select>
	<input type="number" name="quantity">
	<input id="Submit" type="Submit" value="Submit" ></input>
	</form>

	
	<form id="List All Items" action="addCategory.php" method="post" style="margin-left: 1%">
		<h3>Add Category</h3>
		Category Name:
		<br><input type="text" name="categoryName">
		<input id="Submit" type="Submit" value="Submit" ></input>
	</form>
		<form id="List All Items" action="listAllFeedback.php" method="post" style="margin-left: 1%">
		<h3>List All Feedback</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
		<form id="List All Items" action="listAllReviews.php" method="post" style="margin-left: 1%">
		<h3>List All Reviews</h3>
		<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	<form id="List All Items" action="addProcessingCompany.php" method="post" style="margin-left: 1%">
		<h3>Add Processing Company</h3>
		Company Name:
		<br><input type="text" name="companyName">
		<input id="Submit" type="Submit" value="Submit" ></input>
	</form>
	<form id="userInfo" action="deleteUser.php" method="post" style="margin-left: 1%">
		<h3>Remove Processing Company</h3>
		<select name="company">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = $db_handle->prepare("select paymentTypeId, processingCompany from ProcessingCompany;");
        	$query->execute();
	 		$query->bind_result($id,$name);
	 		while( $query->fetch()){
	 			echo '<option value="'.$id.'">'.$id." ".$name.'</option>';
	 		}
	 		$query->close();
		}
	?>
	</select>
	<input id="Submit" type="Submit" value="Submit" ></input>
	</form>
	<form id="userInfo" action="viewOrder.php" method="post" style="margin-left: 1%">
		<h3>View Customer Order</h3>
		<select name="orderNumber">
	<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = $db_handle->prepare("select orderNumber, username from CustomerOrder;");
        	$query->execute();
	 		$query->bind_result($id,$name);
	 		while( $query->fetch()){
	 			echo '<option value="'.$id.'">'.$id." ".$name.'</option>';
	 		}
	 		$query->close();
		}
	?>
	</select>
	<input id="Submit" type="Submit" value="Submit" ></input>
	</form>

	<br>
	<table border="1">
		<tr>
			<th>ItemId</th>
			<th>Inventory Value</th>
		</tr>
		<?php
		$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);
   		if($db_handle){
        	$query = $db_handle->prepare("SELECT itemId, inventoryValue FROM `totalItemValue`;");
        	$query->execute();
	 		$query->bind_result($id,$name);
	 		while( $query->fetch()){
	 			echo "<tr><td>$id </td><td>$name</td></tr>";
	 		}

	 		$query->close();
		}
	?>

	</table>
  </body>
</html>
