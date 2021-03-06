﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Przypisz podany zasób (surowiec) do kategorii</title>
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

<h3 class="text-white text-center mt-5">Przypisz podany zasób (surowiec) do kategorii</h3>

<?php
require "db_functions.php";

$result=0;

if($_POST)
{
  $resource_id = $_POST["ResourceID"];
  $cat_id = $_POST["CategoryID"];

  open_database();
  $result = write_resource_category($resource_id, $cat_id);
  close_database();	

  if ($result)
  {
    unset ($_POST['ResourceID']);
    unset ($_POST['CategoryID']);
  }
}
?>


<div class="text-center">
<form method="post" action="">

<?php
open_database();
$resource = read_table("resources.resources");;
$category = read_table("categories.categories");
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
<select name="ResourceID" class="form-control" required >
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

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Kategoria: 
</label>
</div>

<div class="col-md-3">
<select name="CategoryID" class="form-control" required >
<option value="" disabled selected >wybierz</option>
<?php
foreach($category as $row_number => $row){
?>
<option value="<?=$row['cat_id'];?>" <?php if($_POST['CategoryID']==$row['cat_id']) echo 'selected="selected"';?> ><?=$row['cat_name_pl'];?></option>
<?php
}
?>
</select>
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
</div>


<div class="text-center">
<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Kategoria zasobu (surowca) zapisana.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Kategoria zasobu (surowca) zapisana.</p>";
}
else
{
  if($_POST)
  {
    //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Taka kombinacja już istnieje!</span></center>";
    echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Taka kombinacja już istnieje!</p>";
  }
}
?>
</div>
</body>
</html>