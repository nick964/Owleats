<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OwlEats Homepage</title>
	<link href="css/view.css" rel="stylesheet" type="text/css">
	<?php
try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}
if(isset($_SESSION['login_user'])){
	header("location:index.php");
}
include('login.php'); //includes login script
?>

<?php /*

if ($db) {
	echo "<p>Connection successful.</p>";
} elseif (isset($error)) {
	echo "<p>$error</p>";
} */
?>
	<style>
		
	</style>
</head>
<div id="temple"><body</div>
<div id="container">
	<div id="home_menu" align="center">
		<img src="img/owleats.png" alt="Owl Eats Logo"></img>
		<p id="subtitle">All your campus food trucks in one place.</p>
		<form id="form1" class="form"  method="GET" action="">
					<div class="form_description">

		<p><span><?php echo $errmsg; ?></span></p>
		
		</div>						
			<table align="center">
			<tr id="tr_1" >
			<div>
			<label for="username">Username: </label>
			<input type="text" name="username" id="username" placeholder="username" value="" size="20" maxlength="20">
		</div> 
		</tr>
		<br>
		<div>		
			<tr id="tr_2" >
			<label for="password">Password: </label>
			<input type="password" name="password" id="password" placeholder="password" value="" size="20" maxlength="20">
			</tr>
		</div>
		<p><input type="submit" name="submit" id="submit" value="Login"></p>
		<button id="logBtn"><a id="vendorBtn" href="vendorlogin.php">Vendor Login</a></button>
		<button id="logBtn"><a id="signupBtn" href="signup.php">Sign up</a></button>	
		
		</table>
		
		</form> 
		
	
	
	
	
	</div>	
</div>
	
	
	
</body>
</html>

