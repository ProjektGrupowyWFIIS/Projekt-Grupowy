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


<?php
require "db_functions.php";

$result=0;

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

  if ($result)
  {
    unset ($_POST['ResourceID']);
    unset ($_POST['FactorID']);
    unset ($_POST['SourceID']);
    unset ($_POST['Unit1ID']);
    unset ($_POST['Unit2ID']);
    unset ($_POST['FactorUnitID']);
    unset ($_POST['Factor']);
    unset ($_POST['Uncertainty']);
  }
}
?>

      
<div class="text-center">

<form method="post" action="">

<?php
open_database();
$resource = read_table("resources.resources");;
$factor = read_table("factors.factor_names");
$source = read_table("factors.sources");
$unit = read_table("units.units");
close_database();
?>

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Zasób (surowiec): 
</label>
</div>

<div class="col-md-3">
<select name="ResourceID" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<?php
foreach($resource as $row_number => $row){
?>
<option value="<?=$row['resource_id'];?>" <?php if($_POST['ResourceID']==$row['resource_id']) echo 'selected="selected"';?> ><?=$row['resource_name_pl'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>

<p class="text-white-50 font-italic mt-5">
Należy uwzględnić wszystkie obowiązkowe współczynniki dla wszystkich kategorii, do których należy powyższy zasób. 
</p>


<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Nazwa współczynnika: 
</label>
</div>

<div class="col-md-3">
<select name="FactorID" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<?php
foreach($factor as $row_number => $row){
?>
<option value="<?=$row['factor_id'];?>" <?php if($_POST['FactorID']==$row['factor_id']) echo 'selected="selected"';?> ><?=$row['factor_name_pl'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Źródło: 
</label>
</div>

<div class="col-md-3">
<select name="SourceID" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<?php
foreach($source as $row_number => $row){
?>
<option value="<?=$row['source_id'];?>" <?php if($_POST['SourceID']==$row['source_id']) echo 'selected="selected"';?> ><?=$row['source_description'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>


<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Jednostka zasobu 1: 
</label>
</div>

<div class="col-md-3">
<select name="Unit1ID" class="form-control" required >
<option value="" disabled selected >wybierz</option>
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>" <?php if($_POST['Unit1ID']==$row['unit_id']) echo 'selected="selected"';?> ><?=$row['unit'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Jednostka zasobu 2:
</label>
</div>

<div class="col-md-3">
<select name="Unit2ID" class="form-control" >
<option value="0">(nie dotyczy)</option>
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>" <?php if($_POST['Unit2ID']==$row['unit_id']) echo 'selected="selected"';?> ><?=$row['unit'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Jednostka współczynnika:
</label>
</div>

<div class="col-md-3">
<select name="FactorUnitID" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>" <?php if($_POST['FactorUnitID']==$row['unit_id']) echo 'selected="selected"';?> ><?=$row['unit'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Współczynnik (liczba >=0):
</label>
</div>

<div class="col-md-3">
 <input name="Factor" type="number" step="0.0000000001" min="0.0000000000" value="<?= isset($_POST['Factor']) ? $_POST['Factor'] : ''; ?>" class="form-control" required />
</div>
<div class="col-md-3"></div>
</div>
</div>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
  <label>
  Niepewność [0..100]:
  </label>
  </div>

  <div class="col-md-3">
   <input name="Uncertainty" type="number" step="0.01" min="0.00" max="100.00" value="<?= isset($_POST['Uncertainty']) ? $_POST['Uncertainty'] : ''; ?>" class="form-control" />
  </div>
  <div class="col-md-3"></div>
  </div>
  </div>

  <div class="container">
      <div class="row">
          <div class="col-md-3"></div>
        <div class="col-md-6">
    <input type="submit" value="Zapisz" class="btn btn-block btn-success mt-5">
    </div>
    <div class="col-md-3"></div>
    </div>
    </div>
  </form>
            
</form>


<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Współczynnik zapisany.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Współczynnik zapisany.</p>";
}
else
{
  if($_POST)
  {
    //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Taka kombinacja  Zasób/Nazwa współczynnika/Jednostka zasobu 1  już istnieje!</span></center>";
    echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Taka kombinacja  Zasób/Nazwa współczynnika/Jednostka zasobu 1  już istnieje!</p>";
  }
}
?>
</div>
</body>
</html>