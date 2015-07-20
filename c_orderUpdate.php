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

if(isset($_SESSION['customerid']) && !empty($_SESSION['customerid'])) {
}else {
	header("Location: owleats_home.php");
}


/** saving this for when vendorid sessions are set
if  ((isset($_SESSION['vendorid']) && !empty($_SESSION['vendorid']))) {
			$vendorid = $_GET['vendorid'];
	}
*/
 
if  ((isset($_GET['id']) && !empty($_GET['id']))) {
			$orderid = $_GET['id'];
			$_SESSION['orderid'] = $orderid;
	} else {
		header("Location: vendorhome.php");
	}




// Get an array with the menu items, price, and quantity with the given orderid
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT items.id, menus.name, items.quantity, items.notes 
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
	function setitemid(x) {
	var idform = document.getElementById("itemid");
	var updatediv = document.getElementById("updateorder");
	var span = document.getElementById("item");
	span.innerHTML = x;
	idform.value = x;
	updatediv.style.display = "block";
	
	}
	</script>
    </head>
    <body>

    <div id="content">
    	<div id="logout" style="float:right;">
				<form id="logoutform" action="v_logout.php">
					<input id="logoutBtn" type="submit" value="Log Out"></input>
				</form>
				</div>
				<br>
    <center>
	<h2>Items in OrderID <?php echo $orderid;?></h2>
	<h3>Choose a ItemID to interact</h3>
	<div id="UpdateOrder">

		
	</div>
	
	<table id="order">
		<tr>
			<th>ItemID</th>
			<th>Item</th>
			<th>Quantity</th>
			<th>Notes</th>		
		</tr>
	
		<?php
		$i = 0;
		$total = 0;
			while ($i < count($array)) {
				echo "<tr>";
					$id = $array[$i]['id'];
					echo "<td><a href='#' onclick='setitemid(". $id. ")'> ". $id."</a></td>";
					echo "<td>". $array[$i]['name']."</td>";
					echo "<td>". $array[$i]['quantity']."</td>";
					echo "<td>". $array[$i]['notes'] . "</td>";	
				echo "</tr>";
			$i = $i + 1;
		}
		
		
	
		?>
	
	</table>
	<br>
	
	<div id="updateorder" style="display:none;">
	<form method="get" action="updateorder.php">
	<h3>Update Item #<span id="item"></span></h3><br>
	Quantity:<input type="number" name="quantity" min="1" max="9"></input><br>
	Notes:<input type="textarea" name="notes"></input>
	<input type="hidden" id="itemid" name="itemid"></input><br>
	<input type="hidden" name="orderid" value="<?php echo $orderid?>"></input>
	<input type="submit" name="button" value="Update"></input>
	
	</form>
	<br>
	<form method="get" action="cancelorder.php">
	<h3>Cancel Order?</h3><br>
	<input type="hidden" name="orderid" value="<?php echo $orderid?>"></input>
	<input type="submit" name="button" value="Cancel"></input>
	</form>
	</div>
		<form id="goback" action="pastorders.php">
					Back to Past Orders:<input id="logoutBtn" type="submit" value="Go back"></input>
				</form>
	</div>
	</center>
	</body>
</html>
	