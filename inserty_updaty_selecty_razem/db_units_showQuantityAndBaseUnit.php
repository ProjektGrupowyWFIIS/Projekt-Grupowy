<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Pokaż wielkość fizyczną i jej jednostkę podstawową</title>
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
<h3 class="text-white text-center mt-3">Pokaż wielkość fizyczną i jej jednostkę podstawową</h3>

<h3 class="text-white text-center mt-3"> Wielkości fizyczne </h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("units.quantities");

$atr2 = read_table("units.units");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th style='color: white'> ID Wielkości: </th>";
	echo "<th style='color: white'> Nazwa: </th>";
	echo "<th style='color: white'> Name: </th>";
	echo "<th style='color: white'> ID Jednostki: </th>";
	echo "<th style='color: white'> Jednostka: </th>";
	echo "<th style='color: white'> Nazwa: </th>";
	echo "<th style='color: white'> Name: </th>";
	echo "</tr>";
foreach($atr2 as $row_number => $row2)
{
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th style=\'color: white\'>'.$row['quantity_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row['quantity_name_pl'].'</th>';
	echo '<th style=\'color: white\'>'.$row['quantity_name_eng'].'</th>';
	echo '<th style=\'color: white\'>'.$row2['unit_id'].'</th>';
	echo '<th style=\'color: white\'>'.$row2['unit'].'</th>';
	echo '<th style=\'color: white\'>'.$row2['unit_full_name_pl'].'</th>';
	echo '<th style=\'color: white\'>'.$row2['unit_full_name_eng'].'</th>';
	echo "</tr>";
 
}
}
echo "</table>";

close_database();
?>
<br>
<br>
<p class="text-white text-center h6">Edycja</p>
<br>
<form method="get" action="db_units_updateQuantityAndBaseUnit.php">
    <label class="text-white">ID Jednostki:</label><input type="number"  name="QuantityID" class="form-control" />
	<br>
    <label class="text-white">ID Nazwy Fiz:</label><input type="number"  name="UnitID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>



</body>
</html>