<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż wielkość fizyczną i jej jednostkę podstawową</title>
</head>
<body>

<h3>Pokaż wielkość fizyczną i jej jednostkę podstawową</h3>

<h4> Wielkości fizyczne </h4>

<?php

require "db_functions.php";
open_database();
$atr = read_table("units.quantities");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Nazwa:: </th>";
	echo "<th> Name: </th>";
	echo "<th> Bazowa Jednostka ID: </th>";
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
<h4> Wielkości podstawowe </h4>
<br>

<?php
open_database();

$atr2 = read_table("units.units");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Jednostka: </th>";
	echo "<th> Nazwa: </th>";
	echo "<th> Name: </th>";
	echo "<th> Ratio: </th>";
	echo "<th> Quantity ID: </th>";
	echo "</tr>";
	
foreach($atr2 as $row_number => $row2)
{
  
	echo "<tr>";
	echo '<th>'.$row2['unit_id'].'</th>';
	echo '<th>'.$row2['unit'].'</th>';
	echo '<th>'.$row2['unit_full_name_pl'].'</th>';
	echo '<th>'.$row2['unit_full_name_eng'].'</th>';
	echo '<th>'.$row2['ratio'].'</th>';
	echo '<th>'.$row2['quantity_id'].'</th>';
	echo "</tr>";
 
}
echo "</table>";

?>
<br>
</body>
</html>