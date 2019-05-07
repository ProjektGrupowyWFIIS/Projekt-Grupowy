<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż obowiązkowy współczynnik (atrybut numeryczny) dla podanej kategorii zasobów</title>
</head>
<body>

<h3>Pokaż zestaw obowiązkowych współczynników dla podanej kategorii zasobów</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("factors.mandatory_factors");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Fabryka ID: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['cat_id'].'</th>';
	echo '<th>'.$row['factor_id'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_factors_updateMandatoryFactor.php">
	ID Kategorii: <input type="number"  name="CatID" class="form-control" />
	<br>
	ID Współczynnika: <input type="number"  name="FactorID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>