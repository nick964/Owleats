<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	Nick Robinson	Created page to update order table and submit orders
*****************************************************/


	//start the session
	session_start();
	
//get menu information
require("resources/constants.inc.php");	

if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid']))	{
	$orderid = $_SESSION['orderid'];
	} else {
	header("Location: menu.php");
	}

	
if(isset($_SESSION['vendorid']) && !empty($_SESSION['vendorid'])) {
	$vendorid = $_SESSION['vendorid'];
	}  else {
	header("Location: menu.php");
	}
	
// Get an array with the chosen Menu Items
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "update orders set status = 'New Order' where id = :orderid";
	$results = $con->prepare($sql);
	$results->bindParam(":orderid", $orderid);
	$myarray = $results->execute();
	$sqltotal = "select items.menu_id, menus.name, items.quantity, menus.price * items.quantity as 'total' from items, menus, orders where menus.id = items.menu_id and items.order_id = orders.id and orders.id = :orderid group by items.menu_id";
	$totalresults = $con->prepare($sqltotal);
	$totalresults->bindParam(":orderid", $orderid);
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
	<center>
	<style type="text/css"> 
	.imgA1 { position:absolute; top: 200px; left: 380px; z-index: 1; } 
	.imgB1 { position:absolute; width:230px; height: 180px; top: 250px; left: 520px; z-index: 3; 

	</style>
	
	<img class=imgA1 src="img/sumbittedorder.png">
	<img class=imgB1 src="img/taco.gif">
	</center>
	<?php
	$g = 0;
	$total = 0;
	while ($g < count($currorder)) {
		$total = $total + $currorder[$g]['total'] . "<br>";
		$g = $g + 1;
	}
	
	?>
	<center>
		<h1>Total : $ <?php echo $total ?></h1>
	<h2> Your order has been submitted.</h2>
	<form method="post" action="index.php">
	Click here to go back to the home page.
	<input type="submit" value="go"></input>
	</form>
	</div>
	</body>
</html>
	
	