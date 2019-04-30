<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaz współczynnik (cechę numeryczną) dla zasobów</title>
</head>
<body>

<h3>Pokaż wartości współczynników dla zasobów</h3>

<?php

require "db_functions.php";

open_database();

$atr = read_table("resources.factors");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Factor ID: </th>";
	echo "<th> Źródło: </th>";
	echo "<th> Jednostka Surowca 1: </th>";
	echo "<th> Jednostka Surowca 2: </th>";
	echo "<th> Jednostka Factor: </th>";
	echo "<th> Factor: </th>";
	echo "<th> Uncertainty: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['resource_id'].'</th>';
	echo '<th>'.$row['factor_id'].'</th>';
	echo '<th>'.$row['source_id'].'</th>';
	echo '<th>'.$row['resource_unit_1_id'].'</th>';
	echo '<th>'.$row['resource_unit_2_id'].'</th>';
	echo '<th>'.$row['factor_unit_id'].'</th>';
	echo '<th>'.$row['factor'].'</th>';
	echo '<th>'.$row['uncertainty'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>

</body>
</html>