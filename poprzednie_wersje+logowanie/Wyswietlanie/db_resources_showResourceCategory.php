﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż podane zasoby (surowiec)</title>
</head>
<body>

<h3>Pokaż podane zasóby (surowiec)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("resources.resources_categories");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Cat ID: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['resource_id'].'</th>';
	echo '<th>'.$row['cat_id'].'</th>';

	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_resources_updateResourceCategory.php">
	ID Surowca: <input type="number"  name="ResourceID" class="form-control" />
	<br>
	ID Kategorii: <input type="number"  name="CatID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>