﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż źródło</title>
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
<h3 class="text-white text-center mt-3"> Źródła (np. dokument będący artykułem naukowym)</h3>
      
<?php

require "db_functions.php";
open_database();
$atr = read_table("factors.sources");

  echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

  echo "<tr>";
	echo "<th style='color: white'> ID surowca: </th>";
	echo "<th style='color: white'> Data surowca:</th>";
	echo "<th style='color: white'> Opis surowca: </th>";
	echo "<th style='color: white'> Doi: </th>";
	echo "<th style='color: white'> Bibtex: </th>";
	echo "<th style='color: white'> ID Pliku: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th style=\'color: white\'>'.$row['source_id'].'</th>';
    echo '<th style=\'color: white\'>'.$row['source_date'].'</th>';
	echo '<th style=\'color: white\'>'.$row['source_description'].'</th>';
	echo '<th style=\'color: white\'>'.$row['doi'].'</th>';
	echo '<th style=\'color: white\'>'.$row['bibtex'].'</th>';
	echo '<th style=\'color: white\'>'.$row['file_id'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
<p class="text-white text-center h6">Edycja</p>
<br>
<form method="get" action="db_factors_updateSource.php">
	<label class="text-white">ID Surowca: </label><input type="number"  name="SourceID" class="form-control" />
	<br>
    <label class="text-white">ID Pliku: </label><input type="number"  name="TempFileID" class="form-control" />
    <br>
	<input type="submit" value="Edytuj" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>