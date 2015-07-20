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

if  ((isset($_GET['deleteorderid']) && !empty($_GET['deleteorderid']))) {
			$orderid = $_GET['deleteorderid'];
	}
	
if  ((isset($_GET['deletemenuid']) && !empty($_GET['deletemenuid']))) {
			$menuid = $_GET['deletemenuid'];
	}	



// Get an array with the chosen Menu Items
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "delete from items where order_id = :orderid and menu_id = :menuid";
	$results = $con->prepare($sql);
	$results->bindParam(":orderid", $orderid);
	$results->bindParam(":menuid", $menuid);
	$myarray = $results->execute();
	if ($myarray) {
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