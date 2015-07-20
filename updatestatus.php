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
	
	
	if(isset($_GET['orderid']) && !empty($_GET['orderid'])) {
		$orderid = $_GET['orderid'];
	} else {
		header("Location: vendorhome.php");
	}		
		
	if(isset($_GET['update']) && !empty($_GET['update'])) {
			$status = $_GET['update'];
	} else {
		header("Location: vendorhome.php");
	}
		
	
	
	
//get menu information
require("resources/constants.inc.php");

//I'm going to get the customerid from the session variable, will add this in when I get
//login functionality from courtney
//for right now, I'm going to put place holder in here for the sql
  
	 







// update the status for the given orderid
try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "update orders set status = :status where id = :orderid";
		$results = $con->prepare($sql);
		$results->bindParam(":orderid", $orderid);
		$results->bindParam(":status", $status);
		$ret = $results->execute();
		if ($ret) {
			
			if($status == 'Ready for Pickup') {
			$sql2 = "select customers.email from customers 
			where customers.id = (select orders.customer_id from orders where orders.id = :orderid)";
			$emailresults = $con->prepare($sql2);
			$emailresults->bindParam(":orderid", $orderid);
			$emailresults->execute();
			$emailresults->setFetchMode(PDO::FETCH_ASSOC);
			$rows_found = $emailresults->rowCount();
			
			if ($rows_found > 0) {
				while ($row = $emailresults->fetch()) {
			$email = $row['email'];
				echo "email is " . $email;
			}
			$sub = "ORDER READY FOR PICKUP";
			$message = "Your order with ID" . $orderid . "is ready for pickup Go get your food!";
			
			$test = mail($email, $sub, $message);
			
			if ($test) {
				echo"mail sent";
			}
			else {
				 echo "mail failure.";
			}
		
				
			
				
			//time to email the customer letting them know that their order is ready
			
			
			
				
			
			
			}
			header("Location: vendorhome.php");
			}
			//if status is not "ready for pickup", just redirect to page if its sucessful.
			header("Location: vendorhome.php");
	
		}		
	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

$con = null;
 

 
 ?>
