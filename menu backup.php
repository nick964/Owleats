<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	Nick Robinson	Created page to handle menu items for vendors
*****************************************************/

$currentorders = "";
	//start the session
	session_start();
	
//get menu information
require("resources/constants.inc.php");

//checks if the vendorid is already set, i.e. the customer has placed an order
//and they are redirected back to the menu to place another order
if(isset($_SESSION['vendorid']) && !empty($_SESSION['vendorid'])) {
	$vendorid = $_SESSION['vendorid'];
	
	//if not, check if the customer just clicked a menu item and plans on making an order
	} else if  ((isset($_GET['vendorid']) && !empty($_GET['vendorid']))) {
		
			$vendorid = $_GET['vendorid'];
	} else {
		
		header("Location: vendors.php");
	}
	
	require("customercheck.php");
	

//assign the orderid to a variable is the orderid is already set
if(isset($_SESSION['orderid']) && !empty($_SESSION['orderid']))	{
	$orderid = $_SESSION['orderid'];
	echo "current order id is " . $orderid. "<br>";	
}


	echo "current vendor id is " . $vendorid . "<br>";
	
	
	



// Get an array with the chosen Menu Items
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select * from menus where vendor_id = :vendorid order by foodtype";
	$results = $con->prepare($sql);
	$results->bindParam(":vendorid", $vendorid);
	$myarray = $results->execute();
	$idk = $results->fetchAll();

	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}
$myarray = $results->fetch();
while ($myarray !== FALSE) 
	{
	$vendornames[] = $myarray[0];
	$myarray = $results->fetch();
	}
	//Get current orders for a customer
	//if item has been added to an order, then a session id will have been given.
	if(isset($orderid) && !empty($orderid)) {
	//$orderid = $_SESSION['orderid'];		
	try 
	{

	$ordersql = "select menus.name, menus.price, menus.id, items.quantity 
				 from menus, items, orders
				where menus.id = items.menu_id AND
				items.order_id = orders.id AND
				orders.id = :orderid;";
	$sth = $con->prepare($ordersql);
	$sth->bindParam(":orderid", $orderid);
	$sth->execute();
	$orderresults = $sth->fetchAll();
	print_r($orderresults);
	}
	catch (Exception $e) 
		{
		$error = $e->getMessage();
		echo $error;
		}
	
	}
$con = null;

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
    	<div id ="header">
			<h1>Welcome to TempleGrub</h1>
				<div id="logout" style="float:right;">
				<form id="logoutform" action="logout.php">
				<input type="submit" value="Log Out"></input>
				</form>
				</div>
			<hr>
			<h2> View the Menu</h2>
			<hr>
		</div>
	<div id="menutable">
		<table id="grubtable" border="2">
			<tr>
			
				<th>Name</th>
				<th>Type</th>
				<th>Price</th>
			</tr>
		<?php
		$i = 0;
		while ($i < count($idk)) {
			echo "<tr>";
				echo "<td>";
				echo "<a href='#' ";
				?>
				<!--The next line inserts the apropriate info into the popup, then triggers the popup -->
				<a href='#' onclick='setFood(" <?php echo $idk[$i]['name'] ?> ", " <?php echo $idk[$i]['id'] ?> "); popup("popUpDiv");'
				<?php
				echo ">" . $idk[$i]['name']."</a>";
				echo "</td>";
				echo "<td>";
				echo $idk[$i]['foodtype'];
				echo "</td>";
				echo "<td>";
				echo $idk[$i]['price'];
				echo "</td>";
			echo "</tr>";
			
			
			$i++;
		}
		
		
		?>		
		</table>
	</div>
		<br>
	<div id="currentorder">
	<form id="changeOrder" name="changeOrder" action="changeOrder.php" method="GET">
    	<table id="ordertable" border="2">
        	<tr>
            	<strong>Current Order</strong>
             </tr>
             <tr>
             	<td>Food Order</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Delete Item</td>
             </tr>
         
             <?php
		if(isset($orderid) && !empty($orderid)) {
			 $g = 0;
			 while ($g < count($orderresults)) {
				 echo "<tr>";
				 	echo "<td>";
					$menuid = $orderresults[$g]['id'];
					echo $orderresults[$g]['name'];
					echo "</td>";
					echo "<td>";
					echo $orderresults[$g]['price'];
					echo "</td>";
					echo "<td>";
					echo $orderresults[$g]['quantity'];
					echo "</td>";
					echo "<td>";
					?>
					
					
					<img onclick='setDelete("<?php echo $orderid ?>", "<?php echo $menuid ?>")' src='img/trash.png'  height='42' width='42'></img>
					 
				<?php
				echo "</td>";
				echo "</tr>";
				$g++;
			}
		}
		
		
			 ?>
         	</table>
         	<div id="submitbutton" style="display:none;>
         		
         	<form id="deleteform" name="deleteform" action="changeOrder.php" method="GET">
         	<input type="hidden" name="deleteorderid" id="deleteorderid"  value="" </input>
			<input type="hidden" name="deletemenuid" id="deletemenuid" value="" > </input>
			<strong>click ok to delete</strong>
			<input type="submit" value="go"></input>
         	</form>
         	</div>
			
			<div id="checkout">
			<b>Submit your Order</b>
			<form id="submitform" name="submitform" action="submit.php" method="GET">
			<input type="submit" value="submit">
			</form>
			</div>
			
    
             
        
		
	</div>
<!--POPUP for adding stuff-->    
    
    <div id="blanket" style="display:none;"></div>
	<div id="popUpDiv" style="display:none;">
	<div id="OrderDiv">
    <form id="orderform" name="orderform" action="handler.php" method="GET" >
    	<span id="ClickedFood"></span><br>
    	<!--The javascript in the line above inserts the appropriate info
    		into the popup for.-->  
    	<input type="hidden" id="ClickedFoodForm" name="fooditem"></input>
    	<input type="hidden" id="MenuId" name="menuid"></input>
    	<input type="hidden"  name="vendorid" value = "<?php echo $vendorid ?>"></input>
    	
    	<strong>Quantity:</strong>
    	<label for="NameofFood"></label>
    	<input type="number" min="1" max="9" value="1" name="quantity"></input><br>
    	<label for="Notes">Notes</label>
    	<input type="text" name="notes"></input>
    	<input type="submit" value="Add to Order"></input>
    	
    	
    	
    </form>
 </div> <!-- order form  div ends -->
    	<a href="#" onclick="popup('popUpDiv')" >Click to return to the menu</a>
	</div>	


<!-- / POPUP--> 

<div id="popUpDeleteDiv" style="display:none;">
	<form id="deleteItem" name="deleteItem" action="deleteItem.php" method="GET" >
		<strong>Are you sure you would like to delete the item </strong>
    	<span id="ClickedFood"></span><br>
    	<!--The javascript in the line above inserts the appropriate info
    		into the popup for.-->  
    	<input type="hidden" id="ClickedFoodForm" name="fooditem"></input>
    	<input type="hidden" id="MenuId" name="menuid"></input>
		
	</form>
</div>

		
</div> 
    </body>
</html>
