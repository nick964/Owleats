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
	$sqltotal = "select orders.id as 'OrderID', vendors.name, orders.status 
	from orders, vendors, menus, items, customers 
	where items.order_id = orders.id 
	and items.vendor_id = vendors.id 
	and items.menu_id = menus.id 
	and items.customer_id = customers.id
	 and customers.id = :customerid 
	 group by orders.id order by orders.id desc";
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
        <title>Pick Yer Food</title>
	<script>

	</script>
    </head>
    <body>
    <div id="content">
	<h2> Your Previous Orders.</h2>
	<center>
	<div class="table-container">
	<table id="currentorders">
		<tr>
			<th>Order ID</th>
			<th>Name</th>
			<th>Quantity</th>
		</tr>
		<?php
		
		$i = 0;
		$total = 0;
		while ($i < count($currorder)) {
			echo "<tr>";
				
					echo "<td>". $currorder[$i]['OrderID'] ."</td>" ;
					echo "<td>". $currorder[$i]['name']."</td>" ;
					echo "<td>". $currorder[$i]['status']."</td>" ;
			echo "</tr>";		
			$i = $i + 1;
		}
		
		
	
		?>
		</table>
	</div>
		<form method="post" action="index.php">
	Click here to go back to the home page.
	<input type="submit" value="go"></input>
	</form>
	</center>
	

	</div>
	</body>
</html>
	
	