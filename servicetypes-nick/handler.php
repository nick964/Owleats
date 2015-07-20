<?php
/************************************************************
 * handler.php
 * 
 * If the user selects to delete the type, delete it from the database.
 * Otherwise, provide a form to edit the name.
 * 
 * developer	date		remarks
 * Nick		2/9/15		it seems responsible, but more reliant on php headers than AJAX/javascript.
 *************************************************************/
require_once("resources/constants.inc.php");

$username = "";
$password = "";
$errtext = "";
$id = $_GET['sneakid'];
	
	try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	}
	catch (Exception $e) 
		{
		$errtext .= $e->getMessage();
		$errtext .= "<br>";
		}
	//if user selected 'delete', delete them from the form
	if (isset($_GET['deletetype'])) {
		
		$sql = "delete from servicetype where serviceID = :id";
		$results = $con->prepare($sql);
		$results->bindParam(":id", $id);
		$myarray = $results->execute();
		header("Location: editservicetypes2.php");
	}
	//if user selected edit, select the row they chose to edit
	elseif (isset($_GET['edittype'])) {
		
		$sql = "select * from servicetype where serviceID = :id";
		$results = $con->prepare($sql);
		$results->bindParam(":id", $id);
		$myarray = $results->execute();
	}
	else {
		echo $errtext;
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

</script>
</head>
<body id="main_body" >
	
	<img id="top" src="img/top.png" alt="">
	<div id="form_container">
		<h1><a> Login Please</a></h1>
	
					
			<div class="form_description">
			<h2> Edit Service Type</h2>
			<h3>Please enter the new name for the Service Type below</h3>
			</div>						
			<table border="2">
				<th>Service ID</th>
				<th>Service Type</th>
				<?php
						
						while($row = $results->fetch(PDO::FETCH_ASSOC)) 
						{
							echo "<tr>";
							echo "<td>" .$row['serviceID'] . "</td>";
							echo "<td>" . $row['serviceName'] . "</td>";
							echo "</tr>";
						}
				
				?>
			</table>
			
			

		
		<div id="visible">
			
		</div>
		<div id="editform">
		<form action="editpage.php" method="get">
			
			<label for="NewServiceType">New Service Type Name:</label>
			<input type="hidden" name="sneakid" id="sneakid" value="<?php echo $id ?>">
			<input type="text" name="newname" id="newname">
			<input type="submit" value="go" name="addgo" id="idgo">
		</form>
		<br>
		
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