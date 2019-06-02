<!DOCTYPE html>
<html lang="pl-PL"> 
<head>
<meta charset=UTF-8"/>
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
  include ('navbar.php');
  ?>
    

<?php

if($_POST)
{
  $file_name = $_FILES['File']['name'];
  $header    = $_POST["Header"];
  $separator = $_POST["Separator"];

  if($file_name == '')
  {
    echo "<br><p style='color: white'>Nie Wybrano pliku!</p>";
    echo "<a href='/parser_QuantityAndBaseUnit.php' style='color:white'>Powrót</a>";
    die();
  }

  require "db_functions.php";

  open_database() or die("Nie mogę otworzyć bazy danych");

  $handle = fopen($file_name, "r");  // plik musi być UTF-8 bez BOM
  for ($i = 0; $row = fgetcsv($handle,0,$separator,'"'); ++$i) 
  {
    if ($header=="WithHeader" && $i==0) 
      continue;                          // pomiń nagłówek
    
    if (count($row)!=5)
    {
      echo "<p style='color:white'>Niepoprawna liczba pól (powinno być 5) w linii</p> ".($i+1)."<br>\n";
      continue;
    }
  
    echo $row[0].", ";
    echo $row[1].", ";
    echo $row[2].", ";
    echo $row[3].", ";
    echo $row[4]."  ";

    if ($id = write_quantity_and_base_unit($row[0],$row[1],$row[2],$row[3],$row[4]))
      echo "--> Zapisano (id = " . $id . ").<br>\n";
    else
      echo "--> Nie zapisano.<br>\n";
  }
  fclose($handle);
  close_database();
  
  echo "<a href='/parser_QuantityAndBaseUnit.php'>Powrót</a>";
}
else
{
?>
      
<form method="post" action="" enctype="multipart/form-data">
<hr>
<h3 class="text-white text-center mt-3">Wczytaj plik z wielkościami fizycznymi i ich jednostkami</h3>

<div class="text-center">

<div class="container">
<div class="row mt-5">
<div class="col-md-3"></div>
<div class="col-md-3"><label class="text-white ">Wybierz plik</label></div>
<div class="col-md-3">


<p>
<input type="file" name="File" accept=".csv" >
</p>
</div>
<div class="col-md-3"></div>
</div>
</div>


<h3 class="text-white text-center mt-3">
Czy pierwszy wiersz pliku jest nagłówkiem zawierającym nazwy pól? 
</h3>
<br>
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">

<input type="radio" name="Header" value="WithHeader" checked="checked" class="form-check-input"> <label class="form-check label text-white">Tak</label>
<input type="radio" name="Header" value="WithoutHeader" class="form-check-input"> <label class="form-check label text-white">Nie</label>
</div>
<div class="col-md-3"></div>
</div>
</div>

<h3 class="text-white text-center mt-3">
Znak oddzielający poszczególne pola (separator): <input type="text" name="Separator" value=";" />
</h3>

<p>
<input type="submit" value="Wczytaj plik" class="mt-5">
</p>
<hr>
</form>

<?php
}
?>


		</div>
</body>
</html>
