<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	Nick Robinson	Vendor Update Order table
*****************************************************/



	//start the session
	session_start();
	
//get db information
require("resources/constants.inc.php");





/** saving this for when vendorid sessions are set
if  ((isset($_SESSION['vendorid']) && !empty($_SESSION['vendorid']))) {
			$vendorid = $_GET['vendorid'];
	}
*/
 
if  ((isset($_GET['id']) && !empty($_GET['id']))) {
			$orderid = $_GET['id'];
	} else {
		header("Location: vendorhome.php");
	}




// Get an array with the menu items, price, and quantity with the given orderid
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT menus.name, items.quantity, items.notes 
	from menus, items 
	where items.menu_id = menus.id 
	and items.order_id = :orderid";
	$results = $con->prepare($sql);
	$results->bindParam(":orderid", $orderid);
	$myarray = $results->execute();
	$array = $results->fetchAll();
	

	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

$con = null;
?>
<!DOCTYPE html>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
    	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    	<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
    	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    	<script type="text/javascript" src="js/css-pop.js"></script>
    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <title>Items in OrderID</title>
	<script>

	</script>
    </head>
    <body>
    <div id="content">
    <center>
	<h2>Items in OrderID <?php echo $orderid;?></h2>
	<div id="UpdateStatus">
		<h3>The status of this order is</h3>
		<form action="updatestatus.php" method="GET" id="updatestatus">
			<select name="update" form="updatestatus">
			  <option value="In Progress" name="status">In Progress</option>
			  <option value="Canceled" name="status">Canceled</option>
 			 <option value="Ready for Pickup" name="status">Ready for Pickup</option>
		   </select>
		<input type="hidden" value="<?php echo $orderid ?>" name="orderid"> </input>
		<input type="Submit" value="go"></input>
		</form>
		
	</div>
	
	<table id="order">
		<tr>
			<th>Item</th>
			<th>Quantity</th>
			<th>Notes</th>		
		</tr>
	
		<?php
		$i = 0;
		$total = 0;
			while ($i < count($array)) {
				echo "<tr>";
					echo "<td>". $array[$i]['name']."</td>";
					echo "<td>". $array[$i]['quantity']."</td>";
					echo "<td>". $array[$i]['notes'] . "</td>";	
				echo "</tr>";
			$i = $i + 1;
		}
		
		
	
		?>
	</table>
	<form method="post" action="vendorhome.php">
	Click here to go back to the home page.
	<input type="submit" value="go"></input>
	</form>
	</div>
	</center>
	</body>
</html>
	