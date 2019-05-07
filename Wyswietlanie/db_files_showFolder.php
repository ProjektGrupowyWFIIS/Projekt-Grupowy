<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż foldery</title>
</head>
<body>

<h3>Pokaż katalogi (folder)</h3>

<?php

require "db_functions.php";
open_database();
$atr = read_table("files.folders");

	echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

	echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Nazwa: </th>";
	echo "<th> Opis: </th>";
	echo "<th> Description: </th>";
	echo "<th> Rodzic ID: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['folder_id'].'</th>';
	echo '<th>'.$row['folder_name'].'</th>';
	echo '<th>'.$row['folder_description_pl'].'</th>';
	echo '<th>'.$row['folder_description_eng'].'</th>';
	echo '<th>'.$row['parent_folder_id'].'</th>';
	echo "</tr>";
 
}

echo "</table>";

close_database();

?>
<br>
<br>
Edycja
<br>
<form method="post" action="db_files_updateFolder.php">
	ID Folderu: <input type="number"  name="FolderID" class="form-control" />
	<br>
	<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
</form>
</body>
</html>