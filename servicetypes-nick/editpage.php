<?php
/************************************************************
 * editservicetype.php
 * 
 * PHP script to update the name of the service
 * 
 * developer	date		remarks
 * nick			2/9/2015	none at this time.
 *************************************************************/
require_once("resources/constants.inc.php");

$username = "";
$password = "";
$errtext = "";
$id = $_GET['sneakid'];
$name = $_GET['newname'];

	try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "update servicetype set serviceName = :name where serviceID = :id";
	$results = $con->prepare($sql);
	$results->bindParam(":id", $id);
	$results->bindParam(":name", $name);
	$myarray = $results->execute();
	header("Location: editservicetypes2.php");
	
	
	}
	catch (Exception $e) 
		{
		$errtext .= $e->getMessage();
		$errtext .= "<br>";
		}

		
	
?>
