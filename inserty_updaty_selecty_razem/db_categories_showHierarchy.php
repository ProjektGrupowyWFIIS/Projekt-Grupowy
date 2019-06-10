<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż hierarchię kategorii</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("navbar.php");
?>

<h3 class="text-white text-center mt-3">
Pokaż hierarchię kategorii zasobów. 
Hierarchia nie jest drzewem, lecz grafem acyklicznym, a zatem każda kategoria może mieć wiele kategorii nadrzędnych.
</h3>


<div class="container">
<div class="row mt-5">
<div class="col-md-3"></div>
<div class="col-md-6">
<?php

require "db_functions.php";
open_database();

	  $arr = array();

  $query = "select categories.categories.cat_id , categories.hierarchy_of_categories.parent_id ,categories.categories.cat_name_pl FROM categories.hierarchy_of_categories
FULL JOIN categories.categories ON categories.categories.cat_id=categories.hierarchy_of_categories.cat_id";

  if ($result = pg_query($query))
    $arr = pg_fetch_all($result);


$categories = $arr;

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" class=\"table table-bordered\">";

	echo "<tr>";
	echo "<th style='color: white'> ID Kategorii: </th>";
	echo "<th style='color: white'> Nazwa Kategorii: </th>";
	echo "<th style='color: white'> ID Rodzica : </th>";
	echo "<th style='color: white'> Edycja: </th>";
	echo "</tr>";
	
foreach($categories as $row_number => $row1)
{
  
	echo "<tr>";
	echo '<th style=\'color: white\'>'.$row1['cat_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row1['cat_name_pl'].'</th>';
	echo '<th style=\'color: white\'>'.$row1['parent_id'].'</th>';
	echo '<th>'.'<a href=db_categories_updateHierarchy.php?CatID='.$row["cat_id"].'&ParentID='.$row["parent_id"].'>Edycja</a>'.'</td>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
</div>
<div class="col-md-3"></div>
</div>
</div>
<br>

</body>
</html>

