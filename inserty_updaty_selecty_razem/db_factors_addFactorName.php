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

<?php

require "db_functions.php";
$result=0;

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

  if ($result)
  {
    unset ($_POST['ID']);
    unset ($_POST['NamePL']);
    unset ($_POST['NameENG']);
    unset ($_POST['DescPL']);
    unset ($_POST['DescENG']);
  }
}
?>



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
      <input name="ID" type="text" class="form-control" value="<?= isset($_POST['ID']) ? $_POST['ID'] : ''; ?>" required  />
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
<input name="NamePL" type="text" value="<?= isset($_POST['NamePL']) ? $_POST['NamePL'] : ''; ?>" class="form-control" required />
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
<input name="NameENG" type="text" value="<?= isset($_POST['NameENG']) ? $_POST['NameENG'] : ''; ?>" class="form-control" required />
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
<input name="DescPL" type="text" value="<?= isset($_POST['DescPL']) ? $_POST['DescPL'] : ''; ?>" class="form-control" />
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
<input name="DescENG" type="text" value="<?= isset($_POST['DescENG']) ? $_POST['DescENG'] : ''; ?>" class="form-control" />
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
  //echo "<br><h4><center><span style='color: white; background-color: black'>Współczynnik ".$factor_id." zapisany.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Współczynnik ".$factor_id." zapisany.</p>";
}
else
{
  if($_POST)
  {
    open_database();
    
    $array = read_table("factors.factor_names","where factor_id='".$factor_id."'");

    if ($array[0]['factor_id']==$factor_id)
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Identyfikator ".$factor_id." już istnieje!</span></center>";
      echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Identyfikator ".$factor_id." już istnieje!</p>";
    }
    else
    {
      $fid = get_factor_id($factor_name_pl);
      if ($fid<>"")
      {
        //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Nazwa (polska) ".$factor_name_pl." już istnieje!</span></center>";
        echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Nazwa (polska) ".$factor_name_pl." już istnieje!</p>";
      }
      else
      {
        //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Nazwa (angielska) ".$factor_name_eng." już istnieje!</span></center>";
        echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Nazwa (angielska) ".$factor_name_eng." już istnieje!</p>";
      }
    }
    close_database();	
  }
}
?>
</div>
</body>
</html>