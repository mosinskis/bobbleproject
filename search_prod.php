<?php
session_start();
ob_start();
// connect to the database
include("connect-db.php");
include("function.php");
isProtected();
?>
<h1> SEARCH prod</h1>
<!--SEARCH BAR TOP MENU-->

<!--http://stackoverflow.com/questions/20450958/how-do-you-display-a-no-results-found-message-php-->

<!-- Search product-->
<?php 

include("connect-db.php");

if(isset($_POST["submit"])) {
$product = $_POST["product"];


$dbbobbleshop = mysqli_query ($mysqli, "SELECT * FROM product WHERE prod_name like '%$product%' OR prod_id like '$product'") 
or die("Problem reading table: " .mysqli_error());
$numRows=mysqli_num_rows($dbbobbleshop);

while ($dbRecord = mysqli_fetch_array($dbbobbleshop))
	{		$prod_id = $dbRecord['prod_id'];
            $prod_name = $dbRecord['prod_name'];
            $prod_desc = $dbRecord['prod_desc'];
            $prod_price = $dbRecord['prod_price'];
            $prod_img = $dbRecord['prod_img'];
            $movie_id = $dbRecord['movie_id'];
			$stock = $dbRecord['stock'];
	
if (!empty($product)){
	
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Product name</th> <th>Description</th> <th>Price</th> <th>Image</th> <th>Movie ID</th> <th>Stock</th>  <th colspam='2'>Action</th></tr>";


// echo out the contents of each row into a table
echo "<tr>";
echo '<td>' . $prod_id . '</td>';
echo '<td>' . $prod_name . '</td>';
echo '<td>' . $prod_desc. '</td>';
echo '<td>' . $prod_price. '</td>';
echo '<td>' . $prod_img. '</td>';
echo '<td>' . $movie_id. '</td>';
echo '<td>' . $stock. '</td>';
echo '<td><a href="edit_prod.php?prod_id='.$prod_id.'">Edit</a></td>';
echo '<td><a href="delete.php?prod_id='.$prod_id.'">Delete</a></td>';
echo "</tr>";
}

// close table>
echo "</table>";

}
	
if (empty($product) ){
         echo "<h2 style=color:red>Sorry, no results were found.</h2>";
     }
	if ($numRows==0){
		 echo "<h2 style=color:red>Sorry, no results were found for $product.</h2>";
	}
	
	
}
	
?>

</br>
<p>
<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" style="color:blue">Back</a>
</p>

<p> <a href="user_logout.php" style="color:green">Logout</a></p>
<?php
// connect to the database
include('connect-db.php');

// number of results to show per page
$per_page = 50;

// figure out the total pages in the database
if ($result = $mysqli->query("SELECT * FROM product ORDER BY prod_name"))
{
if ($result->num_rows != 0)
{
$total_results = $result->num_rows;
// ceil() returns the next highest integer value by rounding up value if necessary
$total_pages = ceil($total_results / $per_page);

// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
if (isset($_GET['page']) && is_numeric($_GET['page']))
{
$show_page = $_GET['page'];

// make sure the $show_page value is valid
if ($show_page > 0 && $show_page <= $total_pages)
{
$start = ($show_page -1) * $per_page;
$end = $start + $per_page;
}
else
{
// error - show first set of results
$start = 0;
$end = $per_page;
}
}
else
{
// if page isn't set, show first set of results
$start = 0;
$end = $per_page;
}

// display pagination
echo "<p><a href='search_prod.php'>View All</a> | <b>View Page:</b> ";
for ($i = 1; $i <= $total_pages; $i++)
{
if (isset($_GET['page']) && $_GET['page'] == $i)
{
echo $i . " ";
}
else
{
echo "<a href='search_prod.php?page=$i'>$i</a> ";
}
}
echo "</p>";

// display data in table
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Product name</th> <th>Description</th> <th>Price</th> <th>Product img</th> <th>Movie ID</th> <th>Stock</th> <th colspam='2'>Action</th></tr>";

// loop through results of database query, displaying them in the table
for ($i = $start; $i < $end; $i++)
{
// make sure that PHP doesn't try to show results that don't exist
if ($i == $total_results) { break; }

// find specific row
$result->data_seek($i);
$row = $result->fetch_row();

// echo out the contents of each row into a table
echo "<tr>";
echo '<td>' . $row[0] . '</td>';
echo '<td>' . $row[1] . '</td>';
echo '<td>' . $row[2] . '</td>';
echo '<td>' . $row[3] . '</td>';
echo '<td>' . $row[4] . '</td>';
echo '<td>' . $row[5] . '</td>';
echo '<td>' . $row[6] . '</td>';
echo '<td><a href="edit_prod.php?prod_id=' . $row[0] . '">Edit</a></td>';
echo '<td><a href="delete.php?prod_id=' . $row[0] . '">Delete</a></td>';
echo "</tr>";
}



// close table>
echo "</table>";
}


}
// error with the query
else
{
echo "Error: " . $mysqli->error;
}


// close database connection
$mysqli->close();

?>

<a href="add_prod.php">Add New Record</a>

<form action="" method="post">
	<div class="form-group">
							<input type="text" name="product" class="form-control search_bar" />
						</div> 
<button type="submit" name="submit" class="btn btn-default">
							Search
						</button>


</form>




</body>
</html>