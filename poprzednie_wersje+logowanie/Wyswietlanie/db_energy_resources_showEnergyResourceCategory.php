<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż zasoby energetyczne (nośnik energii)</title>
</head>
<body>

<h3>Pokaż zasoby energetyczne (nośnik energii)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("energy_resources.resources_categories");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID surowca: </th>";
	echo "<th> ID kategorii: </th>";
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
<form method="post" action="db_energy_resources_updateEnergyResourceCategory.php">
	ID Surowca: <input type="number"  name="ResourceID" class="form-control" />
	<br>
	ID Kategorii: <input type="number"  name="CatID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>