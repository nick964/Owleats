<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	Nick Robinson	Delete item
*****************************************************/


	//start the session
	session_start();
	
//get db information
require("resources/constants.inc.php");

$orderid = $_GET['orderid'];




// Get an array with the chosen Menu Items
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "update orders set status = 'Canceled' where id = :orderid";
	$results = $con->prepare($sql);
	$results->bindParam(":orderid", $orderid);
	$myarray = $results->execute();
	if ($myarray) {
		header("Location: index.php");
		}
	
	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

$con = null;

?>