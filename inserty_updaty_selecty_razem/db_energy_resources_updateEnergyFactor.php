<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj współczynnik dla zasobu energetycznego</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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



<?php
require "db_functions.php";
require "db_update_functions.php";

$result=0;

if($_GET)
{
  $resource_id = $_GET["ResourceID"];
  $factor_id = $_GET["FactorID"];
  $resource_unit_id = $_GET["ResourceUnitID"];
  $temp_source_id = $_GET["TempSourceID"];
  $temp_factor_unit_id = $_GET["TempFactorUnitID"];

  open_database();
      $resource = read_table("energy_resources.energy_resources");;
      $factor_names = read_table("factors.factor_names");
      $source = read_table("factors.sources");
      $unit = read_table("units.units");
  close_database();

  list($factor, $uncertainty) = get_energy_factor($resource_id, $factor_id, $resource_unit_id);
}


if($_POST)
{
  $resource_id2 = $_POST["ResourceID2"];
  $factor_id2 = $_POST["FactorID2"];
  $source_id = $_POST["SourceID"];
  $resource_unit_id2 = $_POST["UnitID2"];
  $factor_unit_id = $_POST["FactorUnitID"];
  $factor = $_POST["Factor"];
  $uncertainty = $_POST["Uncertainty"];

  open_database();
  if ($uncertainty == "")
      $result = update_energy_factor($resource_id2, $factor_id2, $source_id, $resource_unit_id2,
                                     $factor_unit_id, $factor, $resource_id, $factor_id, $resource_unit_id);
  else
      $result = update_energy_factor($resource_id2, $factor_id2, $source_id, $resource_unit_id2,
                                     $factor_unit_id, $factor, $resource_id,
                                      $factor_id, $resource_unit_id, $uncertainty);
  close_database();

  $temp_source_id = $source_id;
  $temp_factor_unit_id = $factor_unit_id;
  $resource_id = $resource_id2;
  $factor_id = $factor_id2;
  $resource_unit_id = $resource_unit_2_id;

  if ($result)
  {
    unset ($_POST['ResourceID2']);
    unset ($_POST['FactorID2']);
    unset ($_POST['SourceID']);
    unset ($_POST['UnitID2']);
    unset ($_POST['FactorUnitID']);
    unset ($_POST['Factor']);
    unset ($_POST['Uncertainty']);
  }  
}      
?>



<h3 class="text-white text-center mt-3">Edytuj współczynnik (cechę numeryczną) dla zasobu energetycznego (nośnika energii)</h3>

<div class="text-center">
    <form method="post" action="" class="form-group">
        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white">
                        Zasób energetyczny(nośnik energii):
                    </label>
                </div>
            
                <div class="col-md-3">
                    <select name="ResourceID2" class="form-control">
                        <?php
                        foreach($resource as $row_number => $row){
                            if($row['resource_id'] == $resource_id){
                                ?>
                                <option selected="selected" value="<?=$row['resource_id'];?>"><?=$row['resource_name_pl'];?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?=$row['resource_id'];?>"><?=$row['resource_name_pl'];?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <p class="text-white-50 lead mt-5 font-italic font-weight-normal">
            Należy uwzględnić wszystkie obowiązkowe współczynniki dla wszystkich kategorii, do których należy powyższy zasób.
        </p>

        <div class="container">
            <div class="row">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white mt-5">
                        Nazwa współczynnika:
                    </label>
                </div>

                <div class="col-md-3">
                    <select name="FactorID2" class="form-control mt-5">
                        <?php
                        foreach($factor_names as $row_number => $row){
                            if($row['factor_id'] == $factor_id){
                                ?>
                                <option selected="selected" value="<?=$row['factor_id'];?>"><?=$row['factor_name_pl'];?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?=$row['factor_id'];?>"><?=$row['factor_name_pl'];?></option>
                                <?php
                            }
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
                    <label class="text-white">
                        Źródło:
                    </label>
                </div>
          
                <div class="col-md-3">
                    <select name="SourceID" class="form-control">
                        <?php
                        foreach($source as $row_number => $row){
                            if($row['source_id'] == $temp_source_id){
                                ?>
                                <option selected="selected" value="<?=$row['source_id'];?>"><?=$row['source_description'];?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?=$row['source_id'];?>"><?=$row['source_description'];?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Jednostka zasobu:
                    </label>
                </div>
             
                <div class="col-md-3">
                    <select name="UnitID2" class="form-control">
                        <?php
                        foreach($unit as $row_number => $row){
                            if($row['unit_id'] == $resource_unit_id){
                                ?>
                                <option selected="selected" value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
                                <?php
                            }
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
                    <select name="FactorUnitID" class="form-control">
                        <?php
                        foreach($unit as $row_number => $row){
                            if($row['unit_id'] == $temp_factor_unit_id){
                                ?>
                                <option selected="selected" value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
                                <?php
                            }
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
                    <input type="number" name="Factor" step="0.0000000001" min="0.0000000001" class="form-control" value="<?=$factor?>" required/>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Niepewność(0..100):
                    </label>
                </div>
             
                <div class="col-md-3">
                    <input type="number"  name="Uncertainty" step="0.0000000001" min="0" max="100"  class="form-control" value="<?=$uncertainty?>" />
                    <small class="text-white">Jeśli nie jesteś pewny, zostaw puste pole</small>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="submit" value="Zapisz" class="btn btn-block btn-success">
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>

    <div class="container">
        <a href="db_energy_resources_showEnergyFactor.php">
            <div class="row mt-3">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="button" value="wróć" class="btn btn-block btn-primary mt-3">
                </div>
                <div class="col-md-3"></div>
            </div>
        </a>
    </div>
  
<?php

if ($result)
  echo "<br><h4><center><span style='color: white; background-color: black'>Współczynnik zmieniony.</span></center></h4>";
else
{
  if($_POST)
  {
    echo "<br><h4><center><span style='color: red; background-color: black'>Nie mogę zmienić współczynnika!</span></center></h4>";
  }
}
?>

</div>
</body>
</html>