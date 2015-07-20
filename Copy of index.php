<?php
/************************************************************
 * index.php
 * 
 * Present user with 3 options
 * 
 * developer	date		remarks
 * jeremy		2/2/2015	none at this time.
 *************************************************************/
require_once 'resources\constants.inc.php';
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
<script type="text/javascript" src="js/view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="img/top.png" alt="">
	<div id="form_container">
	
		
			<div class="form_description">
			<center>
			<h2>Welcome to Temple Grub</h2>

			
			<div style="margin-left: 20%;">
				<div id="btnNewOrder" onclick="window.location.assign('vendors.php');">
					<span style="vertical-align: middle; display: inline-block;"><br>Create New Order</span>
				</div>
				<div id="btnOldOrder" onclick="window.location.assign('currentorders.php');">
					<span style="vertical-align: middle; display: inline-block;"><br>View Past Orders</span>
				</div>
				<br>
				<div id="logout">
				<form id="logoutform" action="logout.php">
					<input type="submit" value="Log Out"></input>
				</form>
				</div>
			</div>
					<div id="readyorders">
		<?php require("readyorders.php")?>;
		</div>	
			</center>
			<p style="clear: both;"></p>
			</div>						
		</form>

		<div id="footer">
		<?php echo CONST_FOOTER;?>
		</div>
	</div>
	<img id="bottom" src="img/bottom.png" alt="">
	</body>
</html>