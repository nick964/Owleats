<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	Nick Robinson	Created page to view current orders
*****************************************************/


	//start the session
	session_start();
	
	
	
//get menu information
require("resources/constants.inc.php");	




require("customercheck.php");


// Get an array with the previous order items for that customer
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sqltotal = "select orders.id, orders.status, vendors.name, RIGHT(orders.timestamp, 14) as 'check'
	from orders, vendors
	 where customer_id = :customerid and
	 orders.vendor_id = vendors.id
	order by timestamp desc";
	$totalresults = $con->prepare($sqltotal);
	$totalresults->bindParam(":customerid", $customerid);
	$array = $totalresults->execute();
	$currorder = $totalresults->fetchAll();

	

	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}


?>


<!DOCTYPE html>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
    	<script type="text/javascript" src="js/css-pop.js"></script>
    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <title>View your Past Orders</title>
	<script>

	</script>
    </head>
    <body>
    <div id="content">
    <div id="home_page"><div id="logout" style="float:right;">
				<form id="logoutform" action="v_logout.php">
					<input id="logoutBtn" type="submit" value="Log Out"></input>
				</form>
				</div>
				<br>
				<br>
	<h1>Your Active Orders</h1>
	<hr>

	<table id="vendor" align="center">
		<tr>
			<th id="vh_th">Order ID</th>
			<th id="vh_th">Status</th>
			<th id="vh_th">Vendor Name</th>
			<th id="vh_th">Time Submitted</th>
		</tr>
		<?php
		$url = "'c_orderUpdate.php?id=";
		$i = 0;
		$total = 0;
		while ($i < count($currorder)) {
			echo "<tr>";	
					echo "<td id='vh_td'><a href='c_orderUpdate.php?id=" .$currorder[$i]['id']. "'>" .$currorder[$i]['id']. "</a></td>";
		
					echo "<td id='vh_td'>". $currorder[$i]['status']."</td>" ;
					echo "<td id='vh_td'>". $currorder[$i]['name']."</td>" ;
					echo "<td id='vh_td'>". $currorder[$i]['check']."</td>" ;
			echo "</tr>";		
			$i = $i + 1;
		}
		
	
		?>
		</table>
	</form>

	</div>
		<form id="goback" action="index.php">
					Back to Home:<input id="logoutBtn" type="submit" value="Go back"></input>
				</form>
	</div>
	</body>
</html>
	
	