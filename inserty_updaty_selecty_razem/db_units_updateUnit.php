<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj jednostkę dodatkową</title>
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
<h3 class="text-white text-center mt-3">Edytuj jednostkę dodatkową</h3>

<form method="post" action="">
<?php
    require "db_update_functions.php";
    require "db_functions.php";
    if($_GET)
    {
        $unit_id = $_GET["UnitID"];
        $temp_quantity_id = $_GET["TempQuantityID"];
    }
    open_database();
        $quantities = read_table("units.quantities");
    close_database();

    list($unit, $unit_full_name_pl, $unit_full_name_eng, $ratio) = get_other_unit($unit_id);
?>
    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Jednostka</label>
            </div>
      
            <div class="col-md-3">
                <input name="Unit" type="text" class="form-control" value="<?=$unit?>" required/>
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
                <input name="UnitNamePL" type="text" class="form-control" value="<?=$unit_full_name_pl?>" required/>
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
                <input name="UnitNameENG" type="text" class="form-control" value="<?=$unit_full_name_eng?>" required/>
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
                <input name="Ratio" type="number" step="0.0000000001" min="0.0000000001"  class="form-control" value="<?=$ratio?>" required/>
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
                <select name="QuantityID" class="form-control">
                    <?php
                    foreach($quantities as $row_number => $row){
                        if($row['quantity_id'] == $temp_quantity_id){
                            ?>
                            <option selected="selected" value="<?=$row['quantity_id'];?>"><?=$row['quantity_name_pl'];?></option>
                            <?php
                        }
                        else{
                            ?>
                            <option value="<?=$row['quantity_id'];?>"><?=$row['quantity_name_pl'];?></option>
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
    <a href="db_units_showUnit.php">
        <div class="row mt-3">
                <div class="col-md-3"></div>
            <div class="col-md-6">
                <input type="button" value="wróć" class="btn btn-block btn-primary mt-3">
            </div>
            <div class="col-md-3"></div>
        </div>
    </a>
</div>
</body>

<?php
    if($_POST)
    {
        $unit               = $_POST["Unit"];
        $unit_full_name_pl  = $_POST["UnitNamePL"];
        $unit_full_name_eng = $_POST["UnitNameENG"];
        $ratio              = $_POST["Ratio"];
        $quantity_id        = $_POST["QuantityID"];

        open_database();
            $result = update_other_unit($unit_id, $unit, $unit_full_name_pl,
                                        $unit_full_name_eng, $ratio, $quantity_id);
        close_database();


        if ($result)
            echo "<br><h4><center><span style='color: white; background-color: black'>Jednostka ".$unit." zmieniona.</span></center></h4>";
        else
        {
            if($_POST)
            {
                open_database();
                $result = get_unit_id($unit);
                if ($result)
                    echo "<br><h4><center><span style='color: red; background-color: black'>Edycja nieudana: Jednostka ".$unit." już istnieje!</span></center></h4>";
                else
                    echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zmienić jednostki!</span></center></h4>";
                close_database();
            }
        }
    }
?>

		
</body>
</html>