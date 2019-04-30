<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Pokaż kategorię</title>
</head>
<body>

<h3>Kategorie Zasobów (zarówno surowców jak i nośników energii)</h3>

<form method="post" action="">


<?php

require "db_functions.php";
open_database();
$atr = read_table("categories.categories");

  echo "<table border = \"1\" cellpading= \"10\" cellspacing=\"0\" >";

  echo "<tr>";
	echo "<th> ID: </th>";
	echo "<th> Nazwa: </th>";
	echo "<th> Name: </th>";
	echo "<th> Opis: </th>";
	echo "<th> Description: </th>";
	echo "</tr>";
	
foreach($atr as $row_number => $row)
{
  
	echo "<tr>";
	echo '<th>'.$row['cat_id'].'</th>';
	echo '<th>'.$row['cat_name_pl'].'</th>';
	echo '<th>'.$row['cat_name_eng'].'</th>';
	echo '<th>'.$row['cat_description_pl'].'</th>';
	echo '<th>'.$row['cat_description_eng'].'</th>';
  echo "</tr>";
 
}

echo "</table>";

close_database();

?>
	
</body>
</html>