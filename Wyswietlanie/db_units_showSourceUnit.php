<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaz alternatywne nazwy jednostek</title>
</head>
<body>

<h3>Pokaz alternatywne nazwy jednostek (tj. nazwę, która może pojawić się w źródłach)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("units.units");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Jednostka: </th>";
	echo "<th> Nazwa: </th>";
	echo "<th> Name: </th>";
	echo "<th> Ration: </th>";
	echo "<th> Ilość: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['unit_id'].'</th>';
	echo '<th>'.$row['unit'].'</th>';
	echo '<th>'.$row['unit_full_name_pl'].'</th>';
	echo '<th>'.$row['unit_full_name_eng'].'</th>';
	echo '<th>'.$row['ratio'].'</th>';
	echo '<th>'.$row['quantity_id'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_units_updateSourceUnit.php">
	ID Jednostki: <input type="number"  name="UnitID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>