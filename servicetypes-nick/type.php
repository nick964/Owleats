<?php
require("resources/constants.inc.php");
// Get an array with MyTech service types
$errtext = "";

try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "insert into servicetype (serviceName) VALUES (:service)";
	$results = $con->prepare($sql);
	$results->bindParam(':service', $_POST['newtype']);
	$myarray = $results->execute();

	}
catch (Exception $e) 
	{
	$errtext .= $e->getMessage();
	$errtext .= "<br>";
	}
	
if ($myarray == TRUE) 
{
	json_encode($a);
	header("Location: editservicetypes2.php");
}
else {
	echo $errtext;
}
$con = null;