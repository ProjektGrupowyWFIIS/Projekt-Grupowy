<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż hierarchię kategorii</title>
</head>
<body>


<h3>
Pokaż hierarchię kategorii zasobów. 
Hierarchia nie jest drzewem, lecz grafem acyklicznym, a zatem każda kategoria może mieć wiele kategorii nadrzędnych.
</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("categories.hierarchy_of_categories");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> Cat ID: </th>";
	echo "<th> Rodzic ID: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['cat_id'].'</th>';
	echo '<th>'.$row['parent_id'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_categories_updateHierarchy.php">
	ID Kategorii: <input type="number"  name="CatID" class="form-control" />
	<br>
	ID Rodzica: <input type="number"  name="ParentID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>

