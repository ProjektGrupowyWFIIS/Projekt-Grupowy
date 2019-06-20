<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj jednostkę dodatkową</title>
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
<h3 class="text-white text-center mt-3">Dodaj jednostkę dodatkową</h3>

<?php
require "db_functions.php";

$result=0;

if($_POST)
{
  $unit               = $_POST["Unit"];
  $unit_full_name_pl  = $_POST["UnitNamePL"];
  $unit_full_name_eng = $_POST["UnitNameENG"];
  $ratio              = $_POST["Ratio"];
  $quantity_id        = $_POST["QuantityID"];

  open_database();
  $result = write_other_unit($unit, $unit_full_name_pl, $unit_full_name_eng, $ratio, $quantity_id);
  close_database();	

  if ($result)
  {
    unset ($_POST['Unit']);
    unset ($_POST['UnitNamePL']);
    unset ($_POST['UnitNameENG']);
    unset ($_POST['Ratio']);
    unset ($_POST['QuantityID']);
  }
}
?>


<form method="post" action="">

<?php
open_database();
$quantities = read_table("units.quantities");
close_database();
?>


<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Jednostka</label>
      </div>

      <div class="col-md-3">
        <input name="Unit" type="text" class="form-control" value="<?= isset($_POST['Unit']) ? $_POST['Unit'] : ''; ?>" required  />
      </div>
      <div class="col-md-3"></div>
      
    </div>
</div>


<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Pełna nazwa jednostki PL</label>
      </div>
  
      <div class="col-md-3">
        <input name="UnitNamePL" type="text" value="<?= isset($_POST['UnitNamePL']) ? $_POST['UnitNamePL'] : ''; ?>" class="form-control" required />
      </div>
      <div class="col-md-3"></div>
      
    </div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Pełna nazwa jednostki ENG</label>
      </div>
  
      <div class="col-md-3">
        <input name="UnitNameENG" type="text" value="<?= isset($_POST['UnitNameENG']) ? $_POST['UnitNameENG'] : ''; ?>" class="form-control" required />
      </div>
      <div class="col-md-3"></div>
      
    </div>
</div>


<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Stosunek do jednostki podstawowej</label>
      </div>
     
      <div class="col-md-3">
        <input name="Ratio" type="number" step="0.0000000001" min="0.0000000001" value="<?= isset($_POST['Ratio']) ? $_POST['Ratio'] : ''; ?>" class="form-control" required />
      </div>
      <div class="col-md-3"></div>
    </div>
</div>


<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Wielkość fizyczna: 
</label>
</div>

<div class="col-md-3">
<select name="QuantityID" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<?php
foreach($quantities as $row_number => $row){
?>
<option value="<?=$row['quantity_id'];?>" <?php if($_POST['QuantityID']==$row['quantity_id']) echo 'selected="selected"';?> ><?=$row['quantity_name_pl'];?></option>
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

<div class="text-center">
<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Jednostka ".$unit." zapisana.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Jednostka ".$unit." zapisana.</p>";
}
else
{
  if($_POST)
  {
    open_database();
    $result = get_unit_id($unit);
    if ($result)
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Jednostka ".$unit." już istnieje!</span></center>";
      echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Jednostka ".$unit." już istnieje!</p>";
    }
    else
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zapisać jednostki!</span></center></h4>";
      echo "<br><p style='color: red;font-size:25px;'>Z nieznanego powodu nie mogę zapisać jednostki!</p>";
    }
    close_database();	
  }
}
?>

		</div>
</body>
</html>