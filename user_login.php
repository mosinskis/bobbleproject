<?php
session_start();
ob_start();
// connect to the database
include("connect-db.php");
include("function.php");

?>

<form action="" method="post">

<label>Email</label>
<input type="email" name="email" required></input>

<label>Password</label>
<input type="text" name="password" required></input>

<input type="submit" name="submit" value="Submit" />

</form>

<?php

if(isset($_POST["submit"])) {
	$email= $_POST["email"];
	$password = $_POST["password"];
	$result = mysqli_query ($mysqli, "SELECT * FROM employee 
	WHERE emp_email= '$email' 
	AND emp_password= '$password'") or die("Problem reading table: " .mysqli_error());
$numRows=mysqli_num_rows($result);	

if($numRows ==1){
	while ($user = mysqli_fetch_array($result))
	{
		$_SESSION[ 'user' ][ 'id' ] = $user['emp_id'];
		$_SESSION[ 'user' ][ 'firstname' ] = $user['emp_firstName'];
		$_SESSION[ 'user' ][ 'lastname' ] = $user['emp_lastName'];
		$_SESSION[ 'user' ][ 'password' ] = $user['emp_password'];
		$_SESSION[ 'user' ][ 'logged' ] = 1;
		header('Location:search_prod.php');
		exit;

	}
	
}else{
	echo"Email and/or Password does not macth. Please try again";
}



}


?>