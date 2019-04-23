<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj współczynnik (cechę numeryczną) dla zasobu (surowca)</title>
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

<h3 class="text-white text-center mt-3">Zdefiniuj wartości współczynników dla podanego zasobu (surowca)</h3>
      
<div class="text-center">

<form method="post" action="">

<?php
require "db_functions.php";
open_database();
$resource = read_table("resources.resources");;
$factor = read_table("factors.factor_names");
$source = read_table("factors.sources");
$unit = read_table("units.units");
close_database();
?>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label>
Zasób (surowiec): 
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="ResourceID" class="form-control">
<?php
foreach($resource as $row_number => $row){
?>
<option value="<?=$row['resource_id'];?>"><?=$row['resource_name_pl'];?></option>
<?php
}
?>
</select>
</div>
</div>
</div>

<p class="text-white-50 font-italic mt-5">
Należy uwzględnić wszystkie obowiązkowe współczynniki dla wszystkich kategorii, do których należy powyższy zasób. 
<br>Oto lista tych współczynników: ... tu wyświetlić listę ....
</p>


<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label>
Nazwa współczynnika: 
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="FactorID" class="form-control">
<?php
foreach($factor as $row_number => $row){
?>
<option value="<?=$row['factor_id'];?>"><?=$row['factor_name_pl'];?></option>
<?php
}
?>
</select>
</div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label>
Źródło: 
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="SourceID" class="form-control">
<?php
foreach($source as $row_number => $row){
?>
<option value="<?=$row['source_id'];?>"><?=$row['source_description'];?></option>
<?php
}
?>
</select>
</div>
</div>
</div>


<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label>
Jednostka zasobu 1: 
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="Unit1ID" class="form-control">
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
<?php
}
?>
</select>
</div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label>
Jednostka zasobu 2:
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="Unit2ID" class="form-control">
<option value="0">(nie dotyczy)</option>
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
<?php
}
?>
</select>
</div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label>
Jednostka współczynnika:
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="FactorUnitID" class="form-control">
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
<?php
}
?>
</select>
</div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label>
Współczynnik (liczba >=0):
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
 <input type="text"  name="Factor" class="form-control" />
</div>
</div>
</div>
<div class="container">
    <div class="row mt-5">
      <div class="col-md-4">
  <label>
  Niepewnosc [0..100]:
  </label>
  </div>
  <div class="col-md-4"></div>
  <div class="col-md-4">
   <input type="text"  name="Uncertainty" class="form-control" />
  </div>
  </div>
  </div>

  <div class="container">
      <div class="row">
        <div class="col-md-12">
    <input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
    </div>
    </div>
    </div>
  </form>
            
</form>


<?php

if($_POST)
{
  $resource_id = $_POST["ResourceID"];
  $factor_id = $_POST["FactorID"];
  $source_id = $_POST["SourceID"];
  $resource_unit_1_id = $_POST["Unit1ID"];
  $resource_unit_2_id = $_POST["Unit2ID"];
  $factor_unit_id = $_POST["FactorUnitID"];
  $factor = $_POST["Factor"];
  $uncertainty = $_POST["Uncertainty"];

  open_database();
  if ($uncertainty == "")
    $result = write_factor($resource_id, $factor_id, $source_id, $resource_unit_1_id, $resource_unit_2_id, $factor_unit_id, $factor);
  else
    $result = write_factor($resource_id, $factor_id, $source_id, $resource_unit_1_id, $resource_unit_2_id, $factor_unit_id, $factor, $uncertainty);
  close_database();	

  if (!$result)
    echo '<br><hr>Nie mogę zapisać współczynnika!';
  else
    echo '<br><hr>Współczynnik zapisany!';
}
?>
</div>
</body>
</html>