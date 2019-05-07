<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż atrybut</title>
</head>
<body>

<h3>Atrybuty</h3>


<?php

require "db_functions.php";
open_database();
$atr = read_table("attributes.attributes");

  echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

  echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Typ ID:</th>";
	echo "<th> Nazwa atrybutu: </th>";
	echo "<th> Attribute name: </th>";
	echo "<th> Opis: </th>";
	echo "<th> Description: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['attribute_id'].'</th>';
	echo '<th>'.$row['type_id'].'</th>';
	echo '<th>'.$row['attribute_name_pl'].'</th>';
	echo '<th>'.$row['attribute_name_eng'].'</th>';
	echo '<th>'.$row['attribute_description_pl'].'</th>';
	echo '<th>'.$row['attribute_description_eng'].'</th>';
  echo "</tr>";
 
}

echo "</table>";

close_database();

?>

<br>
<br>
Edycja
<br>
<form method="post" action="db_attributes_updateAttribute.php">
	ID Atrybutu: <input type="number"  name="AttributeID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>


</body>
</html>