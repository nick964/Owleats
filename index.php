<?php
/************************************************************
 * index.php
 * 
 * Present user with 3 options
 * 
 * developer	date		remarks
 * jeremy		2/2/2015	none at this time.
 *************************************************************/
require_once('resources/constants.inc.php');
session_start();
$_SESSION['orderid'] = "";

require("customercheck.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo CONST_TITLE;?></title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<link rel="stylesheet" type="text/css" href="css/view_court.css" media="all">
<script type="text/javascript" src="js/view.js"></script>

</head>
<body id="main_body" >
			
		<center>
			<h2>Welcome to OwlEats</h2>
		<div id="parent">
			<div id="leftcontent" style="float: left;">
			<img src="img/owleatshome.png" alt="loginhome" width="510" height:"358"></img>
			</div>	
				
			<div id="rightcontent" style="float: right;">
				<div id="btnNewOrder" onclick="window.location.assign('vendors.php');">
					<span style="vertical-align: middle; display: inline-block;"><br>Create New Order</span>
				</div>
				<div id="btnOldOrder" onclick="window.location.assign('pastorders.php');">
					<span style="vertical-align: middle; display: inline-block;"><br>View Past Orders</span>
				</div>
				<br>
				<div id="logout">
				<form id="logoutform" action="logout.php">
					<input type="submit" id="logoutBtn" value="Log Out"></input>
				</form>
				</div>
			
					<div id="readyorders">
						<?php require("readyorders.php")?>;
					</div>	
			
			</div>
			<p style="clear: both;"></p>
			</div>
		</center>						
	</body>
</html>