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




require("vendorcheck.php");


// Get an array with the previous order items for that customer
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sqltotal = "select id, status, RIGHT(orders.timestamp, 14) as 'check'
	from orders where vendor_id = :vendorid
	order by timestamp desc";
	$totalresults = $con->prepare($sqltotal);
	$totalresults->bindParam(":vendorid", $vendorid);
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
        <title>View your items </title>
	<script>

	</script>
    </head>
    <body>
    <div id="content">
    			<div id="logout" style="float:right;">
				<form id="logoutform" action="v_logout.php">
					<input type="submit" value="Log Out"></input>
				</form>
				</div>
	<h2> Your Active Orders</h2>
	<form id="chooseOrder" action="v_orderUpdate.php" method="GET">
	<table>
		<tr>
			<th>Order ID</th>
			<th>Status</th>
			<th>Time Submitted</th>
		</tr>
		<?php
		$url = "'v_orderUpdate.php?id=";
		$i = 0;
		$total = 0;
		while ($i < count($currorder)) {
			echo "<tr>";	
					echo "<td><a href='v_orderUpdate.php?id=" .$currorder[$i]['id']. "'>" .$currorder[$i]['id']. "</a></td>";
		
					echo "<td>". $currorder[$i]['status']."</td>" ;
					echo "<td>". $currorder[$i]['check']."</td>" ;
			echo "</tr>";		
			$i = $i + 1;
		}
		
		
	
		?>
	</form>

	</div>
	</body>
</html>
	
	