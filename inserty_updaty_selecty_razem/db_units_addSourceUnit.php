<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj alternatywną nazwę jednostki</title>
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

<h3 class="text-white text-center mt-3">Dodaj alternatywną nazwę jednostki (tj. nazwę, która może pojawić się w źródłach)</h3>

<?php
require "db_functions.php";

$result=0;

if($_POST)
{
  $source_unit_name   = $_POST["SourceUnitName"];
  $canonical_unit_id  = $_POST["CanonicalUnitID"];

  open_database();
  $result = write_source_unit_name($source_unit_name, $canonical_unit_id);
  close_database();	

  if ($result)
  {
    unset ($_POST['SourceUnitName']);
    unset ($_POST['CanonicalUnitID']);
  }
}
?>


<div class="text-center">
<form method="post" action="">

<?php
open_database();
$units = read_table("units.units");
close_database();
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Alternatywna nazwa jednostki</label>
      </div>
      
      <div class="col-md-3">
        <input name="SourceUnitName" type="text" class="form-control" value="<?= isset($_POST['SourceUnitName']) ? $_POST['SourceUnitName'] : ''; ?>" required  />
      </div>
      <div class="col-md-3"></div>
    </div>
</div>


<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Jednostka 'kanoniczna': 
</label>
</div>

<div class="col-md-3">
<select name="CanonicalUnitID" class="form-control" required >
<option value="" disabled selected >wybierz</option>
<?php
foreach($units as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>" <?php if($_POST['CanonicalUnitID']==$row['unit_id']) echo 'selected="selected"';?> ><?=$row['unit'];?></option>
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
  </div>
  </div>
            
</form>
</div>


<div class="text-center">
<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Jednostka alternatywna ".$source_unit_name." zapisana.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Jednostka alternatywna ".$source_unit_name." zapisana.</p>";
}
else
{
  if($_POST)
  {
    open_database();
    $result = get_canonical_unit_id($source_unit_name);
    if ($result)
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Jednostka alternatywna ".$source_unit_name." już istnieje!</span></center>";
      echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Jednostka alternatywna ".$source_unit_name." już istnieje!</p>";
    }
    else
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zapisać jednostki alternatywnej!</span></center></h4>";
      echo "<br><p style='color: red;font-size:25px;'>Z nieznanego powodu nie mogę zapisać jednostki alternatywnej!</p>";
    }
    close_database();	
  }
}
?>
		</div>
</body>
</html>