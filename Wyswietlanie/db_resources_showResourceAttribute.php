<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż atrybut (cechę nienumeryczną) z zasobem (surowcem)</title>
</head>
<body>

<h3>Pokaż wartości atrybutów z zasobem (surowcem)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("resources.resources_attributes");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> Surowiec ID: </th>";
	echo "<th> Atrybut ID: </th>";
	echo "<th> Atrybut wartość: </th>";
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