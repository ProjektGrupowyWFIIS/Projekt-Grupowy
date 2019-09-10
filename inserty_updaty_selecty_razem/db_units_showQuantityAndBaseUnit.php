<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Wielkości fizyczne i ich jednostki podstawowe</title>
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
<h3 class="text-white text-center mt-3">Wielkości fizyczne i ich jednostki podstawowe</h3>


<div class="container">
<div class="row mt-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<?php

require "db_functions.php";
require "db_update_functions.php";



open_database();
$q = read_table("units.quantities","","order by quantity_name_pl");
close_database();
echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" class=\"table table-bordered\" >";

echo "<tr>";
//echo "<th style='color: white'> ID Wielkości: </th>";
echo "<th style='color: white'> Nazwa Wielkości Fizycznej: </th>";
echo "<th style='color: white'> Nazwa Wielkości Fizycznej (język angielski): </th>";
//echo "<th style='color: white'> ID Jednostki: </th>";
echo "<th style='color: white'> Jednostka: </th>";
echo "<th style='color: white'> Nazwa Jednostki: </th>";
echo "<th style='color: white'> Nazwa Jednostki (język angielski): </th>";
echo "<th style='color: white'> Edycja: </th>";
echo "</tr>";

foreach($q as $row_number => $row)
{
  $row2=get_quantity_and_base_unit( $row['quantity_id'], $row['base_unit_id']);

  echo "<tr>";
  //echo '<th style=\'color: white\'>'.$row['quantity_id'].'</th>';
  echo '<th style=\'color: white\'>'.$row['quantity_name_pl'].'</th>';
  echo '<th style=\'color: white\'>'.$row['quantity_name_eng'].'</th>';
  //echo '<th style=\'color: white\'>'.$row['base_unit_id'].'</th>';
  echo '<th style=\'color: white\'>'.$row2[2].'</th>';
  echo '<th style=\'color: white\'>'.$row2[3].'</th>';
  echo '<th style=\'color: white\'>'.$row2[4].'</th>';
  echo '<th>'.'<a href=db_units_updateQuantityAndBaseUnit.php?QuantityID='.$row["quantity_id"].'&UnitID='.$row["base_unit_id"].'>Edycja</a>'.'</th>';
  echo "</tr>";
}
echo "</table>";





?>
<!--
</div>
<div class="col-md-2"></div>
</div>
</div> -->
<br>

</body>
</html>