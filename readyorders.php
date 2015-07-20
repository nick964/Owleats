<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	Nick Robinson	alerts a customer if their order is ready for pickup
*****************************************************/



// Get an array with the chosen Menu Items
try 
	{

		$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//Now we are going to perform some sql to check if the customer currently logged in has an order
	//that is ready for pickup. If they do, we should have an alert on each page
		$sql = "select orders.id as 'OrderId', orders.status, vendors.name 
				from orders, vendors 
				where orders.vendor_id = vendors.id and 
				orders.customer_id = :customerid and 
				orders.status != 'Canceled' 
				order by orders.timestamp desc limit 1";
		$results = $con->prepare($sql);
		$results->bindParam(":customerid", $customerid);
		$results->execute();
		$results->setFetchMode(PDO::FETCH_ASSOC);
		
		$rows_found = $results->rowCount();
		
		
		if ($rows_found > 0) {
			echo "<table id='readyorderstable' align='center'>";
			while ($row = $results->fetch()) {
				echo "<tr><th id='tr_rot' colspan='3'><strong>Current Orders</strong></th></tr>";
				echo "<tr id='tr_rot'>";
				echo "<th id='tr_rot'>OrderID</th>";
				echo "<th id='tr_rot'>Status</th>";
				echo "<th id='tr_rot'>Vendor Name</th>";
				echo "</tr>";
				echo "<tr id='tr_rot'>";
			echo "<td id='tr_rot'>"	. $row['OrderId'] . "</td>";
			echo "<td id='tr_rot'>"	. $row['status'] . "</td>";
			echo "<td id='tr_rot'>"	. $row['name'] . "</td>";
			 echo "</tr>";
			} //loop ends
		}
		
		 
		
	

	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

$con = null;
 
 
 ?>
