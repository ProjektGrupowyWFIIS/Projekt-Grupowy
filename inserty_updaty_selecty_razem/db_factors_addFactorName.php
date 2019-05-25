<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj nazwę współczynnika</title>
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

<h3 class="text-white text-center mt-3">Zdefiniuj współczynniki (czyli numeryczne cechy zasobu)</h3>

<div class="text-center">
<form method="post" action="">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3"></div>
          <div class="col-md-3">
    <label class="text-white">
    Identyfikator(skrot) 
    </label>
    </div>
    
    <div class="col-md-3">
    <input type="text"  name="ID" class="form-control" />
    </div>
    <div class="col-md-3"></div>
    </div>
    </div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
<label class="text-white">
Nazwa PL: 
</label>
</div>

<div class="col-md-3">
<input type="text"  name="NamePL" class="form-control" />
</div>
<div class="col-md-3"></div>
</div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
<label class="text-white">
Nazwa ENG: 
</label>
</div>

<div class="col-md-3">
<input type="text"  name="NameENG" class="form-control" />
</div>
<div class="col-md-3"></div>
</div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
<label class="text-white">
Opis PL: 
</label>
</div>

<div class="col-md-3">
<input type="text"  name="DescPL" class="form-control" />
</div>
<div class="col-md-3"></div>
</div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
<label class="text-white">
Opis ENG: 
</label>
</div>

<div class="col-md-3">
<input type="text"  name="DescENG" class="form-control" />
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

require "db_functions.php";

if($_POST)
{
  $factor_id = $_POST["ID"];
  $factor_name_pl = $_POST["NamePL"];
  $factor_name_eng = $_POST["NameENG"];
  $factor_description_pl = $_POST["DescPL"];
  $factor_description_eng = $_POST["DescENG"];

  open_database();
  $result = write_factor_name($factor_id,$factor_name_pl,$factor_name_eng,$factor_description_pl,$factor_description_eng);
  close_database();	

  if (!$result)
    echo '<br><hr>Nie mogę zapisać nazwy współczynnika!';
  else
    echo '<br><hr>Nazwa współczynnika zapisana!';
}
?>
</div>
</body>
</html>