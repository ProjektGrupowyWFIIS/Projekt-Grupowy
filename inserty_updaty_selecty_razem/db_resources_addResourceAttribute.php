﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj atrybut (cechę nienumeryczną) dla zasobu (surowca)</title>
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

<h3 class="text-white text-center mt-3">Zdefiniuj wartości atrybutów dla podanego zasobu (surowca)</h3>


<?php
require "db_functions.php";

$result=0;

if($_POST)
{
  $resource_id = $_POST["ResourceID"];
  $attribute_id = $_POST["AttributeID"];
  $attribute_value = $_POST["Value"];

  open_database();
  $result = write_resource_attribute($resource_id, $attribute_id, $attribute_value);
  close_database();	

  if ($result)
  {
    unset ($_POST['ResourceID']);
    unset ($_POST['AttributeID']);
    unset ($_POST['Value']);
  }
}
?>



<div class="text-center">
<form method="post" action="">

<?php
open_database();
$attribute = read_table("attributes.attributes");
$resource = read_table("resources.resources");
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



<p class="text-white-50 font-italic text-center mt-5">
Należy uwzględnić wszystkie obowiązkowe atrybuty dla wszystkich kategorii, do których należy powyższy zasób. 
</p>


<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Atrybut: 
</label>
</div>

<div class="col-md-3">
<select name="AttributeID" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<?php
foreach($attribute as $row_number => $row){
?>
<option value="<?=$row['attribute_id'];?>" <?php if($_POST['AttributeID']==$row['attribute_id']) echo 'selected="selected"';?> ><?=$row['attribute_name_pl'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>


<p class="text-white-50 font-italic text-center mt-5">
Jeśli atrybut jest typu wyliczeniowego, to poniżej należy wpisać wartość dozwoloną dla tego typu. 
<br>
Jeśli atrybut jest typu swobodnego, to poniżej można wpisać dowolną wartość. 
</p>

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Wartość: 
</label>
</div>

<div class="col-md-3">
  <input name="Value" type="text" value="<?= isset($_POST['Value']) ? $_POST['Value'] : ''; ?>" class="form-control" required />
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
              </div>
              </div>

</form>
</div>

<div class="text-center">
<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Atrybut zasobu zapisany.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Atrybut zasobu zapisany.</p>";
}
else
{
  if($_POST)
  {
    //echo "<br><h4><center><span style='color: red; background-color: black'>Ten atrybut dla podanego zasobu już istnieje!</span></center>";
    echo "<br><p style='color: red;font-size:25px;'>Ten atrybut dla podanego zasobu już istnieje!</p>";
  }
}
?>
</div>
</body>
</html>