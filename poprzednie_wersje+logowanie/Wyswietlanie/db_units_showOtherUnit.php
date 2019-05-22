<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż jednostkę dodatkowe</title>
</head>
<body>

<h3>Pokaż jednostki dodatkowe</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("units.quantities");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Nazwa: </th>";
	echo "<th> Name: </th>";
	echo "<th> Bazowa Jednostka: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['quantity_id'].'</th>';
	echo '<th>'.$row['quantity_name_pl'].'</th>';
	echo '<th>'.$row['quantity_name_eng'].'</th>';
	echo '<th>'.$row['base_unit_id'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_units_updateOtherUnit.php">
	ID Jednostki: <input type="number"  name="QuantityId" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>