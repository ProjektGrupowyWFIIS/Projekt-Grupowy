<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż nazwy współczynników</title>
</head>
<body>

<h3>Pokaż współczynniki (czyli numeryczne cechy zasobu)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("factors.factor_names");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Nazwa: </th>";
	echo "<th> Name: </th>";
	echo "<th> Opis: </th>";
	echo "<th> Description: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['factor_id'].'</th>';
	echo '<th>'.$row['factor_name_pl'].'</th>';
	echo '<th>'.$row['factor_name_pl'].'</th>';
	echo '<th>'.$row['factor_description_pl'].'</th>';
	echo '<th>'.$row['factor_description_pl'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>

</body>
</html>