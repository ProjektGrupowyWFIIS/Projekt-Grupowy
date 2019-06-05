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
    
<div class="text-white">
<?php

if($_POST)
{
  
  $file_name = $_FILES['File']['name'];
  $header    = $_POST["Header"];
  $separator = $_POST["Separator"];
  $source_id = $_POST["SourceID"];

  if($file_name == '')
  {
    echo "Nie wybrano pliku!<br>\n";
    echo "Skrypt przerwany.<br>\n";
    die();
  }

  if($source_id == 0)
  {
    echo "Nie podano źródła!<br>\n";
    echo "Skrypt przerwany.<br>\n";
    die();
  }

  require "db_functions.php";

  if (!open_database())
  {
    echo "Nie mogę otworzyć bazy danych.<br>\n";
    echo "Skrypt przerwany.<br>\n";
    die();
  }

  $handle = fopen($file_name, "r");  // plik musi być UTF-8 bez BOM
  for ($i = 0; $row = fgetcsv($handle,0,$separator,'"'); ++$i) 
  {
    if ($header=="WithHeader" && $i==0) 
      continue;                          // pomiń nagłówek
    
    if (count($row)!=9)
    {
      echo "<br>\n";
      echo "Niepoprawna liczba kolumn (powinno być 9) w wierszu ".($i+1).". ";
      echo "Wiersz został zignorowany<br>\n";
      continue;
    }
  
    echo "<br>\n";
    echo "WIERSZ ".($i+1).":&emsp;";
    echo $row[0].", ";
    echo $row[1].", ";
    echo $row[2].", ";
    echo $row[3].", ";
    echo $row[4].", ";
    echo $row[5].", ";
    echo $row[6].", ";
    echo $row[7].", ";
    echo $row[8]."  <br>\n";

    if ($row[0]=="")
    {
      echo "&emsp;Brak polskiej nazwy nośnika energii w wierszu ".($i+1).". ";
      echo "Wiersz został zignorowany<br>\n";
      continue;
    }
    if ($row[1]=="")
    {
      echo "&emsp;Brak angielskiej nazwy nośnika energii w wierszu ".($i+1).". ";
      echo "Wiersz został zignorowany<br>\n";
      continue;
    }
    if ($row[2]=="")
    {
      echo "&emsp;Brak kodu GUS w wierszu ".($i+1).". ";
      echo "Wiersz został zignorowany<br>\n";
      continue;
    }

    if ($id = write_energy_resource($row[0],$row[1],$row[2],"",""))
    {
      echo "&emsp;Zapisano nośnik energii (id = " . $id . ").<br>\n";
    }
    else
    {
      echo "&emsp;Nie zapisano nośnika energii (prawdopodobnie już istnieje).<br>\n";
      if (!($id = get_energy_resource_id($row[0])))
      {
        echo "Nieudana próba wczytania istniejącego nośnika energii.<br>\n";
        echo "Skrypt przerwany.<br>\n";
        die;
      }
    }  

    // zapisujemy wartość opałową jeśli jest podana:

    if ($row[3]=="" || $row[4]=="" || $row[5]=="")
    {
      echo "&emsp;Nie podano wartości opałowej (lub jej jednostki) w wierszu ".($i+1)."<br>\n";
    }
    else
    {
      echo "&emsp;Podano wartość opałową: ".$row[3]." ".$row[4]."/".$row[5]."<br>\n";

      write_factor_name("NCV","WARTOŚĆ OPAŁOWA","NET CALORIFIC VALUE","","");

      if (!($resource_unit_id = get_unit_id($row[4])))
      {
        echo "Nie znaleziono jednostki: ".$row[4]."<br>\n";
        echo "Skrypt przerwany.<br>\n";
        die;
      }
      
      if (!($factor_unit_id = get_unit_id($row[5]))) 
      {
        echo "Nie znaleziono jednostki: ".$row[5]."<br>\n";
        echo "Skrypt przerwany.<br>\n";
        die;
      }
      
      // w liczbie $row[3] zastępujemy ew. ',' przez '.':
      $row[3] = str_replace(',', '.', $row[3]);

      if (!write_energy_factor($id,"NCV",$source_id, $resource_unit_id, $factor_unit_id, $row[3] ))
        echo "&emsp;Nie zapisano wartości opałowej (prawdopodobnie już istnieje).<br>\n";
      else    
        echo "&emsp;Zapisano wartość opałową.<br>\n";

    }


    // zapisujemy współczynnik emisjii CO2 jeśli jest podany:

    if ($row[6]=="" || $row[7]=="" || $row[8]=="")
    {
      echo "&emsp;Nie podano współczynnika emisji CO2 (lub jego jednostki) w wierszu ".($i+1)."<br>\n";
    }
    else
    {
      echo "&emsp;Podano współczynnik emisji CO2: ".$row[6]." ".$row[7]."/".$row[8]."<br>\n";

      write_factor_name("WECO2","WSP. EMISJI CO2","CO2 EMMISSION FACTOR","","");

      if (!($resource_unit_id = get_unit_id($row[7])))
      {
        echo "Nie znaleziono jednostki: ".$row[7]."<br>\n";
        echo "Skrypt przerwany.<br>\n";
        die;
      }
      
      if (!($factor_unit_id = get_unit_id($row[8]))) 
      {
        echo "Nie znaleziono jednostki: ".$row[8]."<br>\n";
        echo "Skrypt przerwany.<br>\n";
        die;
      }
      
      // w liczbie $row[6] zastępujemy ew. ',' przez '.':
      $row[6] = str_replace(',', '.', $row[6]);
      
      if (!write_energy_factor($id,"WECO2",$source_id, $resource_unit_id, $factor_unit_id, $row[6] ))
        echo "&emsp;Nie zapisano współczynnika emisji CO2 (prawdopodobnie już istnieje).<br>\n";
      else    
        echo "&emsp;Zapisano współczynnik emisji CO2.<br>\n";
    }

  }
  fclose($handle);
  close_database();

}
else
{
?>
      </div>
<form method="post" action="" enctype="multipart/form-data">
<hr>

<?php
require "db_functions.php";
open_database();
$sources = read_table("factors.sources");
close_database();
?>



<h3 class="text-white text-center mt-3">Wczytaj plik z nośnikami energii</h3>
<div class="container">
<div class="text-center">
  <div class="row mt-5">
    <div class="col-md-3"></div>
    <div class="col-md-3"><label class="text-white ">Wybierz plik</label></div>
    <div class="col-md-3">
<p>
<input type="file" name="File" accept=".csv">
</p>
</div>
</div>

<div class="col-md-3"></div>
<h3 class="text-white text-center">
Czy pierwszy wiersz pliku jest nagłówkiem zawierającym nazwy pól? </h3>
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


<h3 class="text-white text-center mt-5">
Znak oddzielający poszczególne pola (separator): <input type="text" name="Separator" value=";" />
</h3>


<div class="container">
  <div class="row mt-5">
    <div class="col-md-3"></div>
    <div class="col-md-3"> <label>
Wybierz źródło: 
</label></div>
<div class="col-md-3">
<select name="SourceID">
<?php
foreach($sources as $row_number => $srow){
?>
<option value="<?=$srow['source_id'];?>"><?=$srow['source_description'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>

</div>
</div>

<div class="container"
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
