<?php

	//make sure the vendor is logged in
	if(isset($_SESSION['vendorid']) && !empty($_SESSION['vendorid'])) {
		$vendorid = $_SESSION['vendorid'];
	} else {
		header("location: vendorlogin.php");
	}
?>
