﻿<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj zasób energetyczny (nośnik energii)</title>
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
  
<h3 class="text-white text-center mt-3">Dodaj zasób energetyczny (nośnik energii)</h3>


<?php

require "db_functions.php";

$result=0;

if($_POST)
{
  $resource_name_pl = $_POST["NamePL"];
  $resource_name_eng = $_POST["NameENG"];
  $gus_id = $_POST["GUS"];
  $resource_description_pl = $_POST["DescPL"];
  $resource_description_eng = $_POST["DescENG"];

  open_database();
  $result = write_energy_resource($resource_name_pl,$resource_name_eng,$gus_id,$resource_description_pl,$resource_description_eng);
  close_database();	

  if ($result)
  {
    unset ($_POST['NamePL']);
    unset ($_POST['NameENG']);
    unset ($_POST['GUS']);
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
      <label class="text-white" >
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
        <label class="text-white" >
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
          <label class="text-white" >
         GUS:
          </label>
          </div> 
     
          <div class="col-md-3">
            <input name="GUS" type="text" value="<?= isset($_POST['GUS']) ? $_POST['GUS'] : ''; ?>" class="form-control" required />
          </div>
          <div class="col-md-3"></div>
          </div>
          </div>
          

          <div class="container">
              <div class="row mt-5">
                  <div class="col-md-3"></div>
                <div class="col-md-3">
            <label class="text-white" >
            Opis PL:
            </label>
            </div> 
            <div class="col-md-3">
              <input name="DescPL" type="text" value="<?= isset($_POST['DescPL']) ? $_POST['DescPL'] : ''; ?>" class="form-control"  />
            </div>
            </div>
            </div>
            

            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-3"></div>
                  <div class="col-md-3">
              <label class="text-white" >
              Opis ENG:
              </label>
              </div> 
            
              <div class="col-md-3">
              <input name="DescENG" type="text" value="<?= isset($_POST['DescENG']) ? $_POST['DescENG'] : ''; ?>" class="form-control"  />
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
  //echo "<br><h4><center><span style='color: white; background-color: black'>Zasób eneretyczny (nośnik energii) ".$resource_name_pl." zapisany.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Zasób eneretyczny (nośnik energii) ".$resource_name_pl." zapisany.</p>";
}
else
{
  if($_POST)
  {
    open_database();
    $result = get_energy_resource_id($resource_name_pl);
    if ($result)
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Polska nazwa ".$resource_name_pl." już istnieje!</span></center>";
      echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Polska nazwa ".$resource_name_pl." już istnieje!</p>";
    }
    else
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Angielska nazwa ".$resource_name_eng." już istnieje!</span></center>";
      echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Angielska nazwa ".$resource_name_eng." już istnieje!</p>";
    }
    close_database();	
  }
}
?>
</div>
</body>
</html>