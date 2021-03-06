﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Zestaw obowiązkowych atrybutów dla danych kategorii zasobów</title>
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
<h3 class="text-white text-center mt-3">Zestaw obowiązkowych atrybutów dla danych kategorii zasobów</h3>


<div class="container">
<div class="row mt-5">
<div class="col-md-3"></div>
<div class="col-md-6">
<?php

require "db_functions.php";
open_database();
$atr = read_table("attributes.mandatory_attributes","","order by cat_id, attribute_id");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" class=\"table table-bordered\" >";

	echo "<tr>";
	echo "<th style='color: white'> Kategoria: </th>";
	echo "<th style='color: white'> Atrybut: </th>";
	echo "<th style='color: white'> Edycja:</th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
	echo "<tr>";
	echo '<th style=\'color: white\'>'.get_cat_name_pl($row['cat_id']).'</th>';
	echo '<th style=\'color: white\'>'.get_attr_name_pl($row['attribute_id']).'</th>';
	echo '<th>'.'<a href=db_attributes_updateMandatoryAttribute.php?CatID='.$row['cat_id'].'&AttributeID='.$row['attribute_id'].'>Edycja</a>'.'</th>';
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