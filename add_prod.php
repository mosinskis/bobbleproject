<?php
session_start();
ob_start();
// connect to the database
include("connect-db.php");
//user is logged in
include("function.php");
isProtected();
?>
<h1> Add prod</h1>
<form onsubmit="return validForm(this)" id="add_prod" action="" method="post">
<div>




<label>Product Name: *</label> <input type="text" name="prod_name"
value=""/><br/>

<label>Description: *</label> <input type="text" name="prod_desc"
value=""/>

<label>Price: *</label> <input type="text" name="prod_price"
value=""/>

<label>Image: *</label> <input type="text" name="prod_img"
value=""/>
<label>Movie ID: *</label> <input type="text" name="movie_id"
value=""/>
<label>Stock: *</label> <input type="text" name="stock"
value=""/>

<p>* required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>

<?php
if (isset($_POST['submit']))

{
// get the form data create variable
$prod_name = htmlentities($_POST['prod_name'], ENT_QUOTES);
$prod_desc = htmlentities($_POST['prod_desc'], ENT_QUOTES);
$prod_price = htmlentities($_POST['prod_price'], ENT_QUOTES);
$prod_img = htmlentities($_POST['prod_img'], ENT_QUOTES);
$movie_id = htmlentities($_POST['movie_id'], ENT_QUOTES);
$stock = htmlentities($_POST['stock'], ENT_QUOTES);

if ($prod_name == '' || $prod_desc == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';

}	

else
{
// if everything is fine, update the record in the database
if ($stmt = $mysqli->prepare("INSERT INTO product 
SET prod_name = '$prod_name', 
prod_desc = '$prod_desc', 
prod_price = '$prod_price',
prod_img = '$prod_img',
 movie_id = '$movie_id',
stock = '$stock'"))
{
$stmt->execute();
$stmt->close();
}
header("Location: success.php");
}	
}	
	
	
?>
</body>

</html>