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
	$sql = "select * from customers where username = :username and password = :password";
	$results = $con->prepare($sql);
	$results->bindParam(":username", $username);
	$results->bindParam(":password", $password);
	$myarray = $results->execute();
	$rows = $results->fetch(PDO::FETCH_NUM);
	if($rows > 0) {
		
		$_SESSION['customerid'] = $rows[0][0];
		header("location: index.php");
		
	}
		else{
		echo "aint work bucko.";
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
	
	