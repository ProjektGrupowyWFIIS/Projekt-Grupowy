﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż zasób energetyczny (nośnik energii)</title>
</head>
<body>

<h3>Pokaż zasób energetyczny (nośnik energii)</h3>


<?php

require "db_functions.php";
open_database();
$atr = read_table("energy_resources.energy_resources");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Nazwa:: </th>";
	echo "<th> Name: </th>";
	echo "<th> GUS ID: </th>";
	echo "<th> Opis: </th>";
	echo "<th> Description: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['resource_id'].'</th>';
	echo '<th>'.$row['resource_name_pl'].'</th>';
	echo '<th>'.$row['resource_name_eng'].'</th>';
	echo '<th>'.$row['gus_id'].'</th>';
	echo '<th>'.$row['resource_description_pl'].'</th>';
	echo '<th>'.$row['resource_description_eng'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_energy_resources_updateEnergyResource.php">
	ID Surowca: <input type="number"  name="ResourceID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>