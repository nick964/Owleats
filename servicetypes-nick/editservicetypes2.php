<?php
/************************************************************
 * editservicetypes2.php
 * 
 * Display the service types and a method to edit them.
 * 
 * developer	date		remarks
 * Nick		 2/10/2015		none at this time.
 *************************************************************/
require_once("resources/constants.inc.php");

$username = "";
$password = "";
$errtext = "";


	try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select * from servicetype";
	$results = $con->prepare($sql);
	$results->execute();
	
	}
	catch (Exception $e) 
		{
		$errtext .= $e->getMessage();
		$errtext .= "<br>";
		}

		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> <?php echo CONST_TITLE;?> :: Help Request Form</title>
<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
<script type="text/javascript" src="js/view.js"></script>
<script type="text/javascript" src="js/getSelect.js"></script>
<script>
//custom form validation goes here
	
function makeVisible(){
	var possible = "noneblock";
	var element = document.getElementById('addform');
	element.style.display = possible.replace(element.style.display, '');
}	

function makeEdit() {
	var i = 0;
	var id = arguments[i];
	document.getElementById("span1").innerHTML = id;
	document.getElementById("sneakid").value = id;
	document.getElementById("editform").style.display = "block"; 
	
}

</script>
</head>
<body id="main_body" >
	
	<img id="top" src="img/top.png" alt="">
	<div id="form_container">
		<h1><a> Login Please</a></h1>
	
					
			<div class="form_description">
			<h2> Current Services</h2>
			<h3>Below is a list of current services offered.</h3>
			<hr>
			<h3>Click on the button under ServiceID if you wish to edit/delete them.</h3>
			</div>						
			<table border="2">
				<th>Service ID</th>
				<th>Service Type</th>
				<?php
						
						while($row = $results->fetch(PDO::FETCH_ASSOC)) 
						{
							echo "<tr>";
							echo "<td><button onclick='makeEdit(" .$row['serviceID']. ")'>" .$row['serviceID'] . "</button></td>";
							echo "<td>" . $row['serviceName'] . "</td>";
							echo "</tr>";
						}
				
				?>
			</table>
			
			

		
		<div id="visible">
			
		</div>
		<div id="addform">
		<form action="type.php" method="post">
			
			<label for="NewServiceType">New Service Type:</label>
			<input type="text" name="newtype" id="newtype">
			<input type="submit" value="go" name="addgo" id="idgo">
		</form>
		<br>
		
		</div>
		
	<div id="editform" style="display:none">
		<hr>
		<form action="handler.php" method="GET" name="hideform">
			
			<label for="NewServiceType">Would you like to edit or delete the ServiceName with <h3>ID</label> <span id="span1"></span></h3>
			<input type="hidden" name="sneakid" id="sneakid" value="">
			<input type="submit" value="Edit" name="edittype" id="edittype">
			<input type="submit" value="Delete" name="deletetype" id="deletetype">
		</form>
		</div>
		
		
		<div id='errtext' class='error_message'>
		<?php echo $errtext;?>
		</div>
					<br><br>
		<div id="footer">
				<?php echo CONST_FOOTER;?>
		</div>
	</div>
	<img id="bottom" src="img/bottom.png" alt="">
	</body>
</html>