<?php
session_start();
ob_start();
// connect to the database
include("connect-db.php");
//user is logged in
include("function.php");
isProtected();

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($prod_id = '',$prod_name = '', $prod_desc ='',  $prod_price = '',  $prod_img = '', $movie_id = '', $stock = '',$error = '')

{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>
Edit
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Edit Prod</h1>


<form action="" method="post">
<div>

<?php if ($prod_id != '') { ?>
<label>ID: <?php echo $prod_id; ?></label>
<input  name="prod_id" value="<?php echo $prod_id; ?>" />

<?php } ?>




<label>Product Name: *</label> <input type="text" name="prod_name"
value="<?php echo $prod_name; ?>"/><br/>

<label>Description: *</label> <input type="text" name="prod_desc"
value="<?php echo $prod_desc; ?>"/><br/>

<label>Price: *</label> <input type="text" name="prod_price"
value="<?php echo $prod_price; ?>"/><br/>

<label>Image: *</label> <input type="text" name="prod_img"
value="<?php echo $prod_img; ?>"/><br/>

<label>Movie_id: *</label> <input type="text" name="movie_id"
value="<?php echo $movie_id; ?>"/><br/>

<label>Stock: *</label> <input type="text" name="stock"
value="<?php echo $stock; ?>"/><br/>

<p>* required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>
</body>
</html>

<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['prod_id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['prod_id']))
{
// get variables from the URL/form
$prod_id = $_GET['prod_id'];
$prod_name = htmlentities($_POST['prod_name'], ENT_QUOTES);
$prod_desc = htmlentities($_POST['prod_desc'], ENT_QUOTES);
$prod_price = htmlentities($_POST['prod_price']);
$prod_img = htmlentities($_POST['prod_img'], ENT_QUOTES);
$movie_id = htmlentities($_POST['movie_id']);
$stock = htmlentities($_POST['stock']);

// check that firstname and lastname are both not empty
if ($prod_name == '' || $prod_id == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($prod_id, $prod_name, $prod_desc, $prod_price, $prod_img, $movie_id, $stock, $error);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $mysqli->prepare("UPDATE product SET 
prod_name = '$prod_name',
prod_desc = '$prod_desc',
prod_price = $prod_price,
prod_img = '$prod_img',
movie_id = $movie_id,
stock = $stock
WHERE prod_id=$prod_id"))
{
$stmt->bind_param("issisii",$prod_id, $prod_name, $prod_desc, $prod_price, $prod_img, $movie_id, $stock);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

header("Location: success.php");


}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "ID Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['prod_id']) && $_GET['prod_id'] > 0)
{
// get 'id' from URL
$prod_id = (int) $_GET['prod_id'];


// get the recod from the database
if($stmt = $mysqli->prepare("SELECT * FROM product 
WHERE prod_id='$prod_id'"))
{
//$stmt->bind_param("i", $prod_id);
$stmt->execute();

$stmt->bind_result($prod_id, $prod_name, $prod_desc, $prod_price, $prod_img, $movie_id, $stock);
$stmt->fetch();

// show the form
renderForm($prod_id, $prod_name, $prod_desc, $prod_price, $prod_img, $movie_id, $stock, null);

$stmt->close();
}


// if the 'id' value is not valid, redirect the user back to the view.php page

}
}
}







?>


