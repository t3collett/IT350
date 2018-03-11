<?php
session_start();
if ($_SESSION['logged_in'] == NULL) {
    header("Location: login.php");
    exit();
}
include('settings.php');
error_reporting(E_ALL); ini_set('display_errors', 1); mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if(isset($_POST)){
	$db_handle = mysqli_connect($ipAddress ,$dbUser,$dbPassword ,$database);

	if($db_handle){
	 	if(!isset($_POST['orderNumber'])
	 		){
	 		mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();
	 	}

	 	$orderNumber = filter_var($_POST['orderNumber'],
	 								FILTER_SANITIZE_NUMBER_INT);
	 	if($orderNumber > PHP_INT_MAX){
			mysqli_close($db_handle);
			header("location: admin.php");
	 		exit();	 	
	 	}

	 	$query = $db_handle->prepare(
	 		'SELECT orderNumber,transactionDate,firstname,lastname,address,email,paymentinfo,cartId, trackingNumber,fulfilled
	 			FROM CustomerOrder
	 			JOIN User
 	 				ON CustomerOrder.username = User.username 
 	 			JOIN PaymentMethod 
 	 				ON CustomerOrder.paymentMethod = PaymentMethod.paymentMethodID
	 			WHERE orderNumber = ?') ;
	 	$query->bind_param('i',$orderNumber);
	 	$query->execute();
	 	$query->bind_result($on,$tr,$fn,$ln,$addr,$email,$pinfo,$cartId,$trackingNumber,$fulfilled);
	 	while( $query->fetch()){
	 		echo "$on<br>$tr<br>$fn $ln<br>$addr<br><br>email: $email<br><br>";
	 		echo "Payment:<br>$pinfo<br><br>";
	 	}
	 	$id = $cartId; 
	 	echo "Items Ordered:<br>";
	 	$query->close();
	 	$qry = $db_handle->prepare(
	 		'SELECT List.itemId,itemName, List.quantity, cost
	 			From List
	 			JOIN Item
	 				ON List.itemId = Item.itemId
	 			WHERE List.cartId = ?') ;
	 	$qry->bind_param('i',$id);
	 	$qry->execute();
	 	$qry->bind_result($id,$on,$tr,$fn);
	 	$total = 0;
	 	while( $qry->fetch()){
	 		$sum = $tr*$fn;
	 		$total = $total + $sum;
	 		echo "$id : $on | $tr | $fn = $sum<br>";
	 		echo "";
	 	}
	 	echo "total = $total";
	 	$qry->close();
	 	mysqli_close($db_handle);
	 	if(isset($trackingNumber)){
	 		echo "<br><br>shipped:<br>tracking number: $trackingNumber";
	 	}else{
	 		echo '<form id="List All Items" action="addtrackingNumber.php" method="post" style="margin-left: 1%">
				<h3>Add Tracking Number</h3>
			TrackingNumber:
			<br><input type="text" name="trackingNumber">
			<input type="hidden" name="orderNumber" value="'.$orderNumber.'">
			<input id="Submit" type="Submit" value="Submit" ></input>
		</form>
	 		';
	 	}
	 	if(isset($fulfilled)){
	 		echo "<br><br>fulfilled on $fulfilled";
	 	}else{
	 		echo '<form id="List All Items" action="orderFulfilled.php" method="post">
			<br>mark as fulfilled:<br>
			<input type="date" name="fulfilled" value= "'. date('Y-m-d') .'">
			<input type="hidden" name="orderNumber" value="'.$orderNumber.'">
			<input id="Submit" type="Submit" value="Submit"></input>
		</form>
		';
	 	}
	 }
} 				

?>