<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	Nick Robinson	Created page to handle menu items for vendors
*****************************************************/
	//this sets that if browser is closed, session is destroyed
	session_set_cookie_params(0);
	//start the session
	session_start();

	
	if(isset($_GET['itemid']) && !empty($_GET['itemid'])) {
		$itemid = $_GET['itemid'];
		echo $itemid;
	} else {
		header("Location: pastorders.php");
	}		
		
	
	
	
//get menu information
require("resources/constants.inc.php");

//I'm going to get the customerid from the session variable, will add this in when I get
//login functionality from courtney
//for right now, I'm going to put place holder in here for the sql
  
	 
if(isset($_GET['quantity']) && !empty($_GET['quantity'])) {
	$quantity = $_GET['quantity'];

}

if(isset($_GET['notes']) && !empty($_GET['notes'])) {
	$notes = $_GET['notes'];
}
if(isset($_GET['orderid']) && !empty($_GET['orderid'])) {
	$orderid= $_GET['orderid'];
}




// update the status for the given orderid
try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "update items set quantity = :quantity, notes = :notes where id = :itemid";
		$results = $con->prepare($sql);
		$results->bindParam(":quantity", $quantity);
		$results->bindParam(":notes", $notes);
		$results->bindParam(":itemid", $itemid);
		$ret = $results->execute();
		if ($ret) {
			
			$loc = "Location: c_orderUpdate.php?id=" . $orderid;
			header($loc);
			} else {
				echo "error";
			}
	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

$con = null;
 

 
 ?>
