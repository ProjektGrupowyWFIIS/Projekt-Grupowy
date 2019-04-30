<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Obowiązkowe atrybuty dla podanej kategorii</title>
</head>
<body>

<h3>  Obowiązkowe atrybuty </h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("attributes.mandatory_attributes");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> Cat ID: </th>";
	echo "<th> Atrybut ID:</th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
	echo "<tr>";
	echo '<th>'.$row['cat_id'].'</th>';
	echo '<th>'.$row['attribute_id'].'</th>';
	echo "</tr>";
}

echo "</table>";

close_database();

?>

</body>
</html>