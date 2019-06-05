﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaz współczynnik (cechę numeryczną) dla zasobów</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include("navbar.php");
?>
<h3 class="text-white text-center mt-3">Pokaż wartości współczynników dla zasobów</h3>

<div class="container">
<div class="row mt-5">
<div class="col-md-3"></div>
<div class="col-md-6">
<?php

require "db_functions.php";

open_database();

$atr = read_table("resources.factors");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th style='color: white'> ID: </th>";
	echo "<th style='color: white'> ID Współczynnika: </th>";
	echo "<th style='color: white'> ID Źródła: </th>";
	echo "<th style='color: white'> ID Jednostki Surowca 1: </th>";
	echo "<th style='color: white'> ID Jednostki Surowca 2: </th>";
	echo "<th style='color: white'> ID Jednostki Współczynnika: </th>";
	echo "<th style='color: white'> Współczynnik </th>";
	echo "<th style='color: white'> Niepewność: </th>";
	echo "<th style='color: white'> Edycja: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th style=\'color: white\'>'.$row['resource_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row['factor_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row['source_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row['resource_unit_1_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row['resource_unit_2_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row['factor_unit_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row['factor'].'</th>';
	echo '<th style=\'color: white\'>'.$row['uncertainty'].'</th>';
	echo '<th>'.'<a href=db_resources_updateFactor.php?ResourceID='.$row["resource_id"].'&FactorID='.$row["factor_id"].'&TempSourceID='.$row["source_id"].'&ResourceUnit1ID='.$row["resource_unit_1_id"].'>Edycja</a>'.'</td>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
</div>
<div class="col-md-3"></div>
</div>
</div>
<br>

</body>
</html>