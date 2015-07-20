<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OwlEats Homepage</title>
	<link href="css/view.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
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
<body>
	<div id="home_page"><button id="signupBtn"><a id="signupBtn" href="signup.php">Sign Up</a></button>
		<button id="logBtn"><a id="vendorBtn" href="vendorlogin.php">Vendor Login</a></button>
		<div id="nosignup"><p id="home_title">OwlEats<p>
		
		<p id="home_subtitle">All your campus food trucks in one place.</p>
		<form id="form1" class="form"  method="GET" action="">
					<div class="form_description">
					<p id="user_error"><span><?php echo $errmsg; ?></span></p>
					</div>	
		
							
			<table id="table_home" align="center">
			<tr id="tr_1" >
			<input type="text" name="username" id="username" placeholder="Username" value="" size="20" maxlength="20">
			</tr>
			<br>	
			<tr id="tr_1" >
			<input type="password" name="password" id="password" placeholder="Password" value="" size="20" maxlength="20">
			</tr>
			<br>
			<tr id="tr_1">
			<input type="submit" name="submit" id="home_submit" value="Login">	
			</tr>
			</table>
		
		
		<br>
			
		
		
		
		</form></div>
		
	
	
	
	
	</div>	
</div>
	
	
	
</body>
</html>

