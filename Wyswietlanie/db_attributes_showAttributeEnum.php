<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż możliwe wartości atrybutu wyliczeniowego</title>
</head>
<body>

<h3>Pokaż możliwe wartości atrybutu wyliczeniowego</h3>



<?php

require "db_functions.php";
open_database();
$atr = read_table("attributes.attributes");

  echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

  echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Wartość: </th>";
	echo "<th> Value: </th>";
	echo "<th> Opis: </th>";
	echo "<th> Description: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['attribute_id'].'</th>';
	echo '<th>'.$row['attribute_value_pl'].'</th>';
	echo '<th>'.$row['attribute_value_eng'].'</th>';
	echo '<th>'.$row['attribute_value_description_pl'].'</th>';
	echo '<th>'.$row['attribute_value_description_eng'].'</th>';
  echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_attributes_updateAttributeEnum.php">
	ID Atrybutu: <input type="number"  name="AttributeID" class="form-control" />
	<br>
	Wartość Atrybutu: <input type="text"  name="AttributeValuePl" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>


</body>
</html>