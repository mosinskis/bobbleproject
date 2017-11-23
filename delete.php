<?php
session_start();
ob_start();
// connect to the database
include("connect-db.php");
//user is logged in
include("function.php");
isProtected();



// confirm that the 'id' variable has been set
if (isset($_GET['prod_id']) && is_numeric($_GET['prod_id']))
{ 
// get the 'id' variable from the URL
$prod_id = $_GET['prod_id'];

// delete record from database
if ($stmt = $mysqli->prepare("DELETE FROM product WHERE prod_id = $prod_id LIMIT 1"))
{
	
//$stmt->bind_param("i",$prod_id);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: could not prepare SQL statement.";
}
$mysqli->close();

// redirect user after delete is successful
//header("Location: search_prod.php");
header("Location: success.php");
}
else
// if the 'id' variable isn't set, redirect the user
{
//header("Location: view.php");
echo "deu errado";
}

?>