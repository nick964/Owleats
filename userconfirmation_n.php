<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OwlEats Confirmation Page</title>
	<link href="css/view.css" rel="stylesheet" type="text/css">
	<?php
try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}

session_start();

?>


	<style>
		
	</style>
</head>
<body>
	Sign up Confirmed!
	<button><a id="confirmBtn" href="owleats_home.php">Home Page</a></button>
	
	
</body>
</html>

