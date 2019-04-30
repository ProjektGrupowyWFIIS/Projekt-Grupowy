<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Współczynniki</title>
</head>
<body>

<h3>Pokaż wartości współczynników dla podanego zasobu energetycznego (nośnika energii)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("energy_resources.factors");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Factor ID: </th>";
	echo "<th> Source ID: </th>";
	echo "<th> Resource unit ID: </th>";
	echo "<th> Factor unit ID: </th>";
	echo "<th> Factor: </th>";
	echo "<th> Uncertainty: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['resource_id'].'</th>';
	echo '<th>'.$row['factor_id'].'</th>';
	echo '<th>'.$row['source_id'].'</th>';
	echo '<th>'.$row['resource_unit_id'].'</th>';
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