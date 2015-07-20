<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OwlEats Confirmation Page</title>
	<link href="css/view.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
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
	<div id="home_page" align="center">
	<h1 id="uc_h1">OwlEats</h1>	
		
	<p id="uc_p">Sign Up Confirmed!</p>
	<br>
	<br>
	<button id="backBtn"><a id="backBtn" href="owleats_home.php">Return to Home Page</a></button>
	</div>
	
</body>
</html>

