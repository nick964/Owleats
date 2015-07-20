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
	
	//me making sure everything is right
	//echo "current order id is " . $orderid. "<br>";	
}

	//making sure vendorid is right
	//echo "current vendor id is " . $vendorid . "<br>";
	
	
	



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
$i = 0;
//put all the of given menu items for the vendor into an array, then put that into a session variables so that it can be used in a
//json encode argument..fancy stuff
while ($i < count($idk)) 
	{
	$menuarray[] = $idk[$i]['name'];
	$idarray[] = $idk[$i]['id'];
	$i = $i + 1;
	}
	$_SESSION['menuarray'] = $menuarray;
	$_SESSION['idarray'] = $idarray;
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
    	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    	<link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
    	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    	<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
    	<script type="text/javascript" src="js/css-pop.js"></script>
    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    	<script>
    		function showHint(str) {
   			 if (str.length == 0) { 
        	document.getElementById("txtFood").innerHTML = "";
        	return;
    		} else {
        	var xmlhttp = new XMLHttpRequest();
        		xmlhttp.onreadystatechange = function() {
            	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtFood").innerHTML = xmlhttp.responseText;
            	}
        }
        xmlhttp.open("GET", "getmenu.php?q=" + str, true);
        xmlhttp.send();
    		}
		}
		function scrollTo() {
            $('html, body').animate({ scrollTop: $('#popUpDiv').offset().top }, 'slow');
            return false;
            //window.location.hash = '#tries';
        }
    	</script>
        <title>Pick Yer Food</title>

    </head>
    <body>
    <div id="content">
    	<div id ="header">
			<img src="img/owleatslogo.png" id="owleats" alt="OwlEats Logo" style="margin-right: auto; margin-left: auto;"></img>
				<div id="logout" style="float:right;">
				<form id="logoutform" action="logout.php">
				<input type="submit" id="logoutBtn"value="Log Out"></input>
				</form>
				</div>
			<hr>
			<h2> View the Menu</h2>
			<hr>
		</div>
	<div id="search">
		<form> 
			<label for="EnterMenu">Search for Food: </labEL> <input type="text" onkeyup="showHint(this.value)" id="searchfood">
		</form>
		<p>What we got: <span id="txtFood"></span></p>
		
	</div>
<div id="AllMenus">
	<div class="menutable">
		<p>Beverages</p>
		<table class="itemstable" border="2">

		<?php
		$i = 0;
		while ($i < count($idk)) {
			if ($idk[$i]['foodtype'] == 'Beverages'){
			echo "<tr>";
				echo "<td>";
				echo "<a href='#' ";
				?>
				<!--The next line inserts the apropriate info into the popup, then triggers the popup -->
				<a id="menubuttons" href='#' onclick='setFood(" <?php echo $idk[$i]['name'] ?> ", " <?php echo $idk[$i]['id'] ?> "); popup("popUpDiv"); scrollTo();'
				<?php
				echo ">" . $idk[$i]['name']."</a>";
				echo "</td>";
				echo "<td id='price'>";
				echo "$".$idk[$i]['price'];
				echo "</td>";
			echo "</tr>";
			}
			
			$i++;
		}
		
		
		?>		
		</table>
	</div>

	<div class="menutable">
		<p>Sides</p>
		<table class="itemstable" border="2">
			<tr>

		<?php
		$i = 0;
		while ($i < count($idk)) {
			if ($idk[$i]['foodtype'] == 'Sides'){
			echo "<tr>";
				echo "<td>";
				echo "<a href='#' ";
				?>
				<!--The next line inserts the apropriate info into the popup, then triggers the popup -->
				<a href='#' id="menubuttons" onclick='setFood(" <?php echo $idk[$i]['name'] ?> ", " <?php echo $idk[$i]['id'] ?> "); popup("popUpDiv"); scrollTo(); '
				<?php
				echo ">" . $idk[$i]['name']."</a>";
				echo "</td>";
				echo "<td id='price'>";
				echo "$".$idk[$i]['price'];
				echo "</td>";
			echo "</tr>";
			}
			
			$i++;
		}
		
		
		?>		
		</table>
	</div>

	<div class="menutable">
		<p>Breakfast</p>
		<table class="itemstable" border="2">

		<?php
		$i = 0;
		while ($i < count($idk)) {
			if ($idk[$i]['foodtype'] == 'Breakfast'){
			echo "<tr>";
				echo "<td>";
				echo "<a href='#' ";
				?>
				<!--The next line inserts the apropriate info into the popup, then triggers the popup -->
				<a href='#' id="menubuttons" onclick='setFood(" <?php echo $idk[$i]['name'] ?> ", " <?php echo $idk[$i]['id'] ?> "); popup("popUpDiv"); scrollTo();'
				<?php
				echo ">" . $idk[$i]['name']."</a>";
				echo "</td>";
				echo "<td id='price'>";
				echo "$".$idk[$i]['price'];
				echo "</td>";
			echo "</tr>";
			}
			
			$i++;
		}
		
		
		?>		
		</table>
	</div>

	<div class="menutable">
		<p>Lunch</p>
		<table class="itemstable" border="2">

		<?php
		$i = 0;
		while ($i < count($idk)) {
			if ($idk[$i]['foodtype'] == 'Lunch'){
			echo "<tr>";
				echo "<td>";
				echo "<a href='#' ";
				?>
				<!--The next line inserts the apropriate info into the popup, then triggers the popup -->
				<a href='#' id="menubuttons" onclick='setFood(" <?php echo $idk[$i]['name'] ?> ", " <?php echo $idk[$i]['id'] ?> "); popup("popUpDiv"); scrollTo();'
				<?php
				echo ">" . $idk[$i]['name']."</a>";
				echo "</td>";
				echo "<td id='price'>";
				echo "$".$idk[$i]['price'];
				echo "</td>";
			echo "</tr>";
			}
			
			$i++;
		}
		
		
		?>		
		</table>
	</div>


</div> <!--menu table container ends-->
	<div id="currentorder">
		
	<!--This span element tells the javascript wheter or not to display the orders table -->
	<span style="display:none;" id="ordercheck" ><?php echo $orderid; ?></span>
	<form id="changeOrder" name="changeOrder" action="changeOrder.php" method="GET">
    	<table id="ordertable" border="2">
        	<tr>
            	<strong>Current Order</strong>
             </tr>
             <tr>
             	<th>Food Order</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delete Item</th>
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
         	
         		
         	<form id="deleteform" name="deleteform" action="changeOrder.php" method="GET">
         	<div id="clickdelete">
         	<input type="hidden" name="deleteorderid" id="deleteorderid"  value="" ></input>
			<input type="hidden" name="deletemenuid" id="deletemenuid" value="" > </input>
			<strong>click ok to delete</strong>
			<input type="submit" value="go"></input>
			</div>
         	</form>
         	
			
	
			<b>Submit your Order</b>
			<form id="submitform" name="submitform" action="submit.php" method="GET">
			<input type="submit" value="submit">
			</form>
			
    
	</div> <!--order box ends-->
		<div id="currentorder2">
		
	<!--This span element tells the javascript wheter or not to display the orders table -->
	<span style="display:none;" id="ordercheck" ><?php echo $orderid; ?></span>
	<form id="changeOrder" name="changeOrder" action="changeOrder.php" method="GET">
    	<table id="ordertable" border="2">
        	<tr>
            	<strong>Current Order</strong>
             </tr>
             <tr>
             	<th>Food Order</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delete Item</th>
             </tr>
         
             <?php
		if(isset($orderid) && !empty($orderid)) {
			 $g = 0;
			 while ($g < count($orderresults)) {
				 echo "<tr align='center'>";
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
         	
         	<div id="clickdelete">
         	<form id="deleteform" name="deleteform" action="changeOrder.php" method="GET">
         	<input type="hidden" name="deleteorderid" id="deleteorderid"  value="" ></input>
			<input type="hidden" name="deletemenuid" id="deletemenuid" value="" > </input>
			<strong>clickkk ok to delete</strong>
			<input type="submit" value="go"></input>
         	</form>
         	</div>
			
	
			<b>Submit your Order</b>
			<form id="submitform" name="submitform" action="submit.php" method="GET">
			<input type="submit" value="submit">
			</form>
			
    
	</div> <!--order box ends-->
</div><!--content div ends-->      
<!--POPUP for adding stuff-->    
    
    <div id="blanket" style="display:none;"></div>
	<div id="popUpDiv" style="display:none;">
	<div id="OrderDiv">
    <form id="orderform" name="orderform" action="handler.php" method="GET" >
    	<h4 align="center">Add Items To Your Order</h4>
    	<hr>
    	
    	<center><h3><span id="ClickedFood"></span></h3></center><br>
    	<!--The javascript in the line above inserts the appropriate info
    		into the popup for.-->  
    	<input type="hidden" id="ClickedFoodForm" name="fooditem"></input>
    	<input type="hidden" id="MenuId" name="menuid"></input>
    	<input type="hidden"  name="vendorid" value = "<?php echo $vendorid ?>"></input>
    	<br>
    	<strong>Quantity:</strong>
    	<label for="NameofFood"></label>
    	<input type="number" min="1" max="9" value="1" name="quantity"></input><br>
    	<label for="Notes">Notes</label>
    	<input type="text" name="notes"></input>
    	<input type="submit" value="Add to Order"></input>
    	
    	
    	
    </form>

    	<a href="#" id="returnmenu" onclick="popup('popUpDiv')" >Click to return to the menu</a>
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
    	<script>

    
	</script>
</html>
