<?php

	//make sure the customer is logged in
	if(isset($_SESSION['customerid']) && !empty($_SESSION['customerid'])) {
		$customerid = $_SESSION['customerid'];

	} else {
		header("location: owleats_home.php");
	}
?>
