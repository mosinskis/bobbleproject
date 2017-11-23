<?php
session_start();
ob_start();
// connect to the database
include("connect-db.php");
//user is logged in
include("function.php");
isProtected();
?>

<?php
echo "Database has been updated successfully.";
?>

<p>If you want to search for more products please click on <buttom><a href="search_prod.php">Search Products</a></buttom>
<p>If you want to add  more products please click on <buttom><a href="add_prod.php">Add Products</a></buttom>
<buttom><a href="user_logout.php">Logout</a></buttom>