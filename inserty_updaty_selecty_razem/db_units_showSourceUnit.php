﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Alternatywne nazwy jednostek</title>
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
<h3 class="text-white text-center mt-3">Alternatywne nazwy jednostek (tj. nazwy które mogą pojawić się w źródłach)</h3>

<div class="container">
<div class="row mt-5">
<div class="col-md-3"></div>
<div class="col-md-6">
<?php

require "db_functions.php";
open_database();
$atr = read_table("units.source_unit_names","","order by unit_variant");

    echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" class=\"table table-bordered\">";

    echo "<tr>";
    echo "<th style='color: white'> Jednostka alternatywna: </th>";
    echo "<th style='color: white'> Jednostka kanoniczna: </th>";
	echo "<th style='color: white'> Edycja: </th>";
    echo "</tr>";

foreach($atr as $row_number => $row)
{

    echo "<tr>";
    echo '<th style=\'color: white\'>'.$row['unit_variant'].'</th>';
    echo '<th style=\'color: white\'>'.get_unit($row['unit_canonical_id']).'</th>';
	echo '<th>'.'<a href=db_units_updateSourceUnit.php?UnitVariant='.$row["unit_variant"].'&TempCanonicalUnitID='.$row["unit_canonical_id"].'>Edycja</a>'.'</th>';
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