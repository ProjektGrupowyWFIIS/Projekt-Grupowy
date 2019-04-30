<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż atrybut (cechę nienumeryczną) dla zasobu energetycznego (nośnika energii)</title>
</head>
<body>

<h3>Pokaż wartości atrybutów dla podanego zasobu energetycznego (nośnika energii)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("energy_resources.resources_attributes");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Atrybut ID: </th>";
	echo "<th> Wartść Atrybutu: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['resource_id'].'</th>';
	echo '<th>'.$row['attribute_id'].'</th>';
	echo '<th>'.$row['attribute_value'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>

</body>
</html>