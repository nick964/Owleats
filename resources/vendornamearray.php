<?php
require("constants.inc.php");
// Get an array with MyTech service types
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select name, location from vendors order by name";
	$results = $con->prepare($sql);
	$myarray = $results->execute();
	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}
$myarray = $results->fetch();
while ($myarray !== FALSE) 
	{
	$vendornames[] = $myarray[0];
	$myarray = $results->fetch();
	}
$con = null;
print_r($vendornames);
// To prevent caching - specify a date in the past
/*
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
*/

//to allow caching, do nothing, or specify a date in the future
header("Expires: " . date('r',time() + 86400));

echo json_encode($vendornames);

?>