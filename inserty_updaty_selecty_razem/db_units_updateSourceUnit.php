<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj alternatywną nazwę jednostki</title>
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
<div>

<?php
include ('navbar.php');
?>

<h3 class="text-white text-center mt-3">Edytuj alternatywną nazwę jednostki (tj. nazwę, która może pojawić się w źródłach)</h3>

<form method="post" action="">
<?php
    require "db_update_functions.php";
    require "db_functions.php";
    if($_GET)
    {
        $unit_variant = $_GET["UnitVariant"];
        $temp_canonical_unit_id = $_GET["TempCanonicalUnitID"];
    }
    open_database();
        $units = read_table("units.units");
    close_database();

//    $unit_variant = get_source_unit_name($unit_variant);
?>
    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Alternatywna nazwa jednostki</label>
            </div>
     
            <div class="col-md-3">
                <input name="UnitVariant2" type="text" class="form-control" value="<?=$unit_variant?>" required/>
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
                        if($row['unit_id'] == $temp_canonical_unit_id){
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
        <a href="db_units_showSourceUnit.php">
            <div class="row mt-3">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="button" value="wróć" class="btn btn-block btn-primary mt-3">
                </div>
                <div class="col-md-3"></div>
            </div>
        </a>
    </div>
</div>

<div class="text-center">
<?php
    if($_POST)
    {
        $unit_variant2   = $_POST["UnitVariant2"];
        $unit_canonical_id  = $_POST["CanonicalUnitID"];

        open_database();
            $result = update_source_unit_name($unit_variant, $unit_variant2, $unit_canonical_id);
        close_database();


        if ($result)
            echo "<br><h4><center><span style='color: white; background-color: black'>Jednostka alternatywna ".$unit_variant2." zmieniona.</span></center></h4>";
        else
        {
            if($_POST)
            {
                open_database();
                    $result = get_canonical_unit_id($unit_variant2);
                    if ($result)
                        echo "<br><h4><center><span style='color: red; background-color: black'>Edycja nieudana: Jednostka alternatywna ".$unit_variant2." już istnieje!</span></center></h4>";
                    else
                        echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zmienić jednostki alternatywnej!</span></center></h4>";
                close_database();
            }
        }
    }
?>
		</div>
</body>
</html>