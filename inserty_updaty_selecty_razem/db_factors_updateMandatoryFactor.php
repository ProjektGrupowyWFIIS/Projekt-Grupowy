﻿<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj obowiązkowy współczynnik dla danej kategorii zasobów</title>
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
  $cat_id = $_GET["CatID"];
  $factor_id = $_GET["FactorID"];
  open_database();
      $factor = read_table("factors.factor_names");
      $category = read_table("categories.categories");
  close_database();
}


if($_POST)
{
  $cat_id2 = $_POST["CatID2"];
  $factor_id2 = $_POST["FactorID2"];

  open_database();
      $result = update_mandatory_factor($cat_id, $factor_id ,$cat_id2, $factor_id2) ;
  close_database();

  $cat_id = $cat_id2;
  $factor_id = $factor_id2;

  if ($result)
  {
    unset ($_POST['CategoryID2']);
    unset ($_POST['FactorID2']);
  }  
}      
?>



<h3 class="text-white text-center mt-3">Edytuj obowiązkowy współczynnik (atrybut numeryczny) dla danej kategorii zasobów</h3>

<div class="text-center">
    <form method="post" action="">

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Kategoria zasobów:
                    </label>
                </div>
              
                <div class="col-md-3">
                    <select name="CatID2" class="form-control">
                        <?php
                        foreach($category as $row_number => $row){
                            if($row['cat_id'] == $cat_id){
                                ?>
                                <option selected="selected" value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
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
                        Obowiązkowy współczynnik (atrybut numeryczny) dla powyższej kategorii:
                    </label>
                </div>
              
                <div class="col-md-3">
                    <select name="FactorID2" class="form-control">
                        <?php
                        foreach($factor as $row_number => $row){
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
            <div class="row">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="submit" value="Zapisz" class="btn btn-block btn-success mt-5">
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>
    <div class="container">
        <a href="db_factors_showMandatoryFactor.php">
            <div class="row mt-3">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="button" value="wróć" class="btn btn-block btn-primary mt-3">
                </div>
            </div>
        </a>
    </div>

<div class="text-center">
<?php

if ($result)
  echo "<br><h4><center><span style='color: white; background-color: black'>Obowiązkowy współczynnik zmieniony!</span></center></h4>";
else
{
  if($_POST)
  {
    echo "<br><h4><center><span style='color: red; background-color: black'>Nie mogę zmienić obowiązkowego współczynnika!</span></center></h4>";
  }
}
?>
</div>
</body>
</html>