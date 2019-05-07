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
	echo "<th> Kategoria ID: </th>";
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
<br>
<br>
Edycja
<br>
<form method="post" action="db_attributes_updateMandatoryAttribute.php">
	ID Kategorii: <input type="number"  name="CatID" class="form-control" />
	<br>
	ID Atrybutu: <input type="number"  name="AttributeID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>


</body>
</html>