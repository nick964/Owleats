<?php
try {
	require_once 'resources/constants.inc.php';
} catch (Exception $e) {
	$error = $e->getMessage();
}


session_start();
$errmsg='';
		if(isset($_GET['submit'])) {
		if(empty($_GET['username']) || empty($_GET['password'])) {
		$error = "Username or Password is invalid! Please reenter Username or Password.";
		}
		else 
		{
			//define $username and $password
			$username=$_GET['username'];
			$password=$_GET['password'];
			//establishing connection with server by passing server_name, username and password
			
try 
	{
	$con = new PDO("mysql:host=".CONST_HOST.";dbname=".CONST_DBNAME,CONST_USER,CONST_PASSWORD);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "select * from vendors where username = :username and password = :password";
	$results = $con->prepare($sql);
	$results->bindParam(":username", $username);
	$results->bindParam(":password", $password);
	$myarray = $results->execute();
	$rows = $results->fetch(PDO::FETCH_NUM);
	if($rows > 0) {
		
		$_SESSION['vendorid'] = $rows[0][0];
		header("location: vendorhome.php");
		
	}
		else{

		$errmsg = "Invalid username and/or password.";
	}	

	}
catch (Exception $e) 
	{
	$error = $e->getMessage();
	echo $error;
	}

$con = null;


		}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OwlEats Vendor Login</title>
	<link href="css/view.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<?php
try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}

?>

</head>
<div id="temple"><body</div>
<div id="container">
	<div id="home_page" align="center"><p id="vendor_title">OwlEats Vendor Login<p>
		<p id="home_subtitle">Manage your orders, add menu items, make more money.</p>
		<form id="form1" class="form"  method="GET" action="">
					<div class="form_description">

		<p><span><?php echo $errmsg; ?></span></p>
		
		</div>						
			<table align="center">
			<tr id="tr_1" >
			<div>
			<input type="text" name="username" id="username" placeholder="username" value="" size="20" maxlength="20">
		</div> 
		</tr>
		<div>		
			<tr id="tr_2" >
			<input type="password" name="password" id="password" placeholder="password" value="" size="20" maxlength="20">
			</tr>
		</div>
		<p><input type="submit" name="submit" id="vendor_submit" value="Login"></p>
		
		</table>
		
		</form> 
		
	
	
	
	
	</div>	
</div>
	
	
	
</body>
</html>
	
	