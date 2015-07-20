<?php
/****************************************************
Name: 
Purpose: 

date		developer		comment
20130912	jeremy			created page
*****************************************************/

	//start the session
	//session_start();
	session_start();
	
	//make sure customer is logged in
	if(isset($_SESSION['customerid']) && !empty($_SESSION['customerid'])) {
		$customerid = $_SESSION['customerid'];
		echo "customer id is " . $customerid;
	} else {
		header("location: owleats_home.php");
	}
	
	
	
	
	//destroy vendor session
	if(isset($_SESSION['vendorid']) && !empty($_SESSION['vendorid'])) {
	unset($_SESSION['vendorid']);
	}
	
//get vendor information
require("resources/constants.inc.php");

// Get an array with MyTech service types
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select id, name, location from vendors order by name";
	$menusql = "select id, name, foodtype, price, vendor_id from menus";
	$results = $con->prepare($sql);
	$menuresults = $con->prepare($menusql);
	$menuresults->execute();
	$myarray = $results->execute();
	
	$idk = $results->fetchAll();
	$menuarray = $menuresults->fetchAll();
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
$con = null;

?>
<!DOCTYPE html>
<html>
    <head>
    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    	<link rel="stylesheet" type="text/css" href="css/view.css">
    	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <title>Pick Yer Food</title>
	<script>
	
	window.addEventListener("DomContentLoaded", function () { 
		var form = document.getElementById("vendorform");
		
		document.getElementById("nameid").addEventListener("click", function () {
			form.submit();
		});
		
	});
		
		
	</script>
    </head>
    <body>
    <div id="home_page"><div id="logout">
				<form id="logoutform" action="logout.php">
					<input id="logoutBtn" type="submit" value="Log Out"></input>
				</form>
				</div>
				<br>
				<br>
    	<div id ="header">
    		
			<h1>Welcome to OwlEats</h1>
		</div>
				
			<hr>
			<h2> Choose a location </h2>
			<hr>
	
	<div id="readyorders">
		<?php require("readyorders.php"); ?>
	</div>



	<div id="vendortable">
	<form id="vendorform" name="vendorform" action="menu.php" method=GET>
		<table id="vendor"  align="center">
			<tr>
				<th id="th_1">Choose</th>
				<th id="th_2">Name</th>
				<th id="th_2">Location</th>
			</tr>
		<?php
		$i = 0;
		while ($i < count($idk)) {
			echo "<tr>";
				echo "<td id='td_1'>";
				echo"<img class='vendorimg' src='img/". $idk[$i]['id']. ".jpg' height='100' width='150'
				alt='" .$idk[$i]['name']. "'</img></td>";
				echo "<td>";
				echo "<button class='vendorbuttons' id='nameid' name='vendorid' value='" .$idk[$i]['id']. "' href='#'>".$idk[$i]['name']."</button>";
				echo "</td>";
				echo "<td id='td_3'>";
				echo $idk[$i]['location'];
				echo "</td>";
			echo "</tr>";
			
			
			$i++;
		}
		
		
		?>		
		</table>
	</form>
		<br>
	<span id="testid"></span> <br>
	<span id="menurowid"></span>

				
		
	</div>
	</div>
    </body>
</html>
