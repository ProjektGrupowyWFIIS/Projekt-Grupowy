<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj obowiązkowy współczynnik (atrybut numeryczny) dla podanej kategorii zasobów</title>
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
<h3 class="text-white text-center mt-3">Zdefiniuj zestaw obowiązkowych współczynników dla podanej kategorii zasobów</h3>


<?php
require "db_functions.php";

$result=0;

if($_POST)
{
  $cat_id = $_POST["CategoryID"];
  $factor_id = $_POST["FactorID"];

  open_database();
  $result = write_mandatory_factor($cat_id, $factor_id) ;
  close_database();	

  if ($result)
  {
    unset ($_POST['CategoryID']);
    unset ($_POST['FactorID']);
  }
}
?>


<div class="text-center">
<form method="post" action="">

<?php
open_database();
$factor = read_table("factors.factor_names");
$category = read_table("categories.categories");
close_database();
?>

<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Kategoria zasobów:
</label> 
</div>

<div class="col-md-3">
<select name="CategoryID" class="form-control" required>
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
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Obowiązkowy współczynnik (atrybut numeryczny) dla powyższej kategorii: 
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
    <div class="row">
        <div class="col-md-3"></div>
      <div class="col-md-6">
  <input type="submit" value="Zapisz" class="btn btn-block btn-success mt-5">
  </div>
  <div class="col-md-3"></div>
  </div>
  </div>

            
</form>


<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Obowiązkowy współczynnik zapisany.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Obowiązkowy współczynnik zapisany.</p>";
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