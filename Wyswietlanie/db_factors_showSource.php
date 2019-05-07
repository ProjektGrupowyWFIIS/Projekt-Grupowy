<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż źródło</title>
</head>
<body>

<h3> Źródła (np. dokument będący artykułem naukowym)</h3>
      
<?php

require "db_functions.php";
open_database();
$atr = read_table("factors.sources");

  echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

  echo "<tr>";
	echo "<th> ID surowca: </th>";
	echo "<th> Data surowca:</th>";
	echo "<th> Opis surowca: </th>";
	echo "<th> Doi: </th>";
	echo "<th> Bibtex: </th>";
	echo "<th> ID Pliku: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['source_id'].'</th>';
    echo '<th>'.$row['source_date'].'</th>';
	echo '<th>'.$row['source_description'].'</th>';
	echo '<th>'.$row['doi'].'</th>';
	echo '<th>'.$row['bibtex'].'</th>';
	echo '<th>'.$row['file_id'].'</th>';	
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_factors_updateSource.php">
	ID Surowca: <input type="number"  name="SourceID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>