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
$atr = read_table("files.files");

  echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

  echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Nazwa Pliku:</th>";
	echo "<th> Typ Pliku: </th>";
	echo "<th> Ścieżka Pliku: </th>";
	echo "<th> Folder ID: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['file_id'].'</th>';
    echo '<th>'.$row['file_name'].'</th>';
	echo '<th>'.$row['file_type'].'</th>';
	echo '<th>'.$row['hdd_file_path'].'</th>';
	echo '<th>'.$row['folder_id'].'</th>';
  echo "</tr>";
 
}

echo "</table>";

close_database();

?>

</body>
</html>