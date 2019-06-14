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

<div class="text-center">
<form method="post" action="">

<?php
require "db_functions.php";
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
        <input name="SourceUnitName" type="text" class="form-control"/>
          
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
<select name="CanonicalUnitID" class="form-control">
<?php
foreach($units as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
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

if($_POST)
{
  $source_unit_name   = $_POST["SourceUnitName"];
  $canonical_unit_id  = $_POST["CanonicalUnitID"];

  open_database();
  $result = write_source_unit_name($source_unit_name, $canonical_unit_id);
  close_database();	

  if (!$result)
    echo "<br><p style='color: red;font-size:25px;'>Nie mogę zapisać jednostki alternatywnej!</p>";
  else
    echo "<br><p style='color: green;font-size:25px;'>Jednostka alternatywna zapisana!</p>";
}
?>
		</div>
</body>
</html>