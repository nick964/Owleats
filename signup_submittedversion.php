<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OwlEats Sign Up Page</title>
	<link href="css/view.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<?php
try {
	require_once 'resources/constants.inc.php';

} catch (Exception $e) {
	$error = $e->getMessage();
}

session_start();
$error='';
		if(isset($_POST['submit'])) {
		if(empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid! Please reenter Username or Password.";
		}
		else 
		{
			//define $username and $password
			$username=$_POST['username'];
			$password=$_POST['password'];
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$phonenumber=$_POST['phonenumber'];
			$email=$_POST['email'];
			//establishing connection with server by passing server_name, username and password
			$dsn = 'mysql:host='. $CONST_HOST.';dbname='. $CONST_DBNAME;
			$db = new PDO($dsn, 'owleats', 'owleats');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = "INSERT INTO customers (firstname, lastname, email, phone, username, password) 
			VALUES (:firstname, :lastname, :email, :phone, :username, :password)";
			$results= $db->prepare($query);
			$results->bindParam(":firstname", $firstname);
			$results->bindParam(":lastname", $lastname);
			$results->bindParam(":email", $email);
			$results->bindParam(":phone", $phonenumber);
			$results->bindParam(":username", $username);
			$results->bindParam(":password", $password);
			$insertresult = $results->execute();
			
			if($insertresult) {
				$db = null;
				header("Location: userconfirmation.php");
			}
			else {
				$error = $e->getMessage();
				echo $error;
			}
		}
		}
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
	<div id="signup_menu"><p id="home_title"><a href="owleats_home.php">OwlEats</a><p>
		<p id="home_subtitle">All your campus food trucks in one place.</p>
		<p id="signup_subtitle">Fill out the form to become a member.</p>
		<form id="signupform" class="signupform"  method="post" action="">
					<div class="signupform_description">
		</div>	
		
							
			<table id="table_signup" align="center">		
			<tr>
			<input type="" name="firstname" id="firstname" value="" placeholder="First Name" size="20" maxlength="20">
			</tr>
			<br>	
			<tr>
			<input type="" name="lastname" id="lastname" value="" placeholder="Last Name" size="20" maxlength="20">
			</tr>
			<br>
			<tr>
			<input type="text" name="email" id="email" value="" placeholder="Email" size="20" maxlength="20"> 
			</tr>
			<br>
			<tr>
			<input type="text" name="phonenumber" id="phonenumber" value="" placeholder="Phone Number" size="20" maxlength="20"> 
			</tr>
			<br>
			<tr>
			<input type="text" name="username" id="username" value="" placeholder="Username" size="20" maxlength="20"> 
			</tr>
			<br>
			<tr>
			<input type="password" name="password" id="password" value="" placeholder="Password" size="20" maxlength="20">
			</tr>
		
		<p><input type="submit" name="submit" id="submit" value="Submit"></p>
		<button id="backBtn"><a id="backBtn" href="owleats_home.php">Return to Homepage</a></button>	
		
		</table>
		
		</form> 
		</div>	
		
		
</div>
	
	
	
</body>
</html>

