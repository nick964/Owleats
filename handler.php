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
	
//get menu information
require("resources/constants.inc.php");
if (!isset($_GET['fooditem']))
{
	header("Location: menu.php");
}
//I'm going to get the customerid from the session variable, will add this in when I get
//login functionality from courtney
//for right now, I'm going to put place holder in here for the sql
/**
 * sql sql sql for customers
 * 
 * 
 * 
 */
 
	//make sure the customer is logged in
	if(isset($_SESSION['customerid']) && !empty($_SESSION['customerid'])) {
		$customerid = $_SESSION['customerid'];
		echo "customer id is " . $customerid . "<br>";
	} else {
		header("location: owleats_home.php");
	}









$menuid = $_GET['menuid'];
$fooditem = $_GET['fooditem'];
$quantity = $_GET['quantity'];
$notes = $_GET['notes'];
$vendorid = $_GET['vendorid'];

echo $fooditem . "<br>";
echo $quantity . "<br>";
echo $notes . "<br>";


// Get an array with the chosen Menu Items
try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//if a session is already started, then assign orderid to the session variable
	if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid'])) {
		$orderid = $_SESSION['orderid'];
		$_SESSION['vendorid'] = $vendorid;
	} else {
		

		$sql = "insert into orders (vendor_id, customer_id, status)
		VALUES (:vendorid, :customerid, 'New Order')";
		$results = $con->prepare($sql);
		$results->bindParam(":vendorid", $vendorid);
		$results->bindParam(":customerid", $customerid);
		
		//this inserts in the stuff into the order table
		$myarray = $results->execute();
		$ordersql = "SELECT id FROM orders ORDER BY timestamp DESC LIMIT 1;";
		$orderresults = $con->prepare($ordersql);
		$orderresults->execute();
		$row = $orderresults->fetch();
		$orderid = $row['id'];
		echo "The order of id the row just inserted is" . $orderid;
		//now we have the order id.
		//time to start an order id session variable for this particular order and vendorid
	

		$_SESSION['orderid'] = $orderid;
		$_SESSION['vendorid'] = $vendorid;
	
	}
	//now that we have the order id, we have to insert everything into the items table
	$itemsql = "insert into items (vendor_id, menu_id, order_id, customer_id, quantity, notes)
				VALUES(:vendorid, :menuid, :orderid, :customerid, :quantity, :notes)";
	$itemresults = $con->prepare($itemsql);
	$itemresults->bindParam(":vendorid", $vendorid);
	$itemresults->bindParam(":menuid", $menuid);
	$itemresults->bindParam(":orderid", $orderid);
	$itemresults->bindParam(":customerid", $customerid);
	$itemresults->bindParam(":quantity", $quantity);
	$itemresults->bindParam(":notes", $notes);
	//this inserts in the stuff into the order
	$finish = $itemresults->execute();
	if($finish)
	{
		header("Location: menu.php");

	}
	
	

	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

$con = null;
 
 
 ?>
