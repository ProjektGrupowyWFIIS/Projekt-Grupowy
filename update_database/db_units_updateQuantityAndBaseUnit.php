<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj wielkość fizyczną i jej jednostkę podstawową</title>
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
<h3 class="text-white text-center mt-3">Edytuj wielkość fizyczną i jej jednostkę podstawową</h3>


<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";

    list($quantity_name_pl, $quantity_name_eng, $unit,
         $unit_full_name_pl, $unit_full_name_eng) = get_quantity_and_base_unit();
?>

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-4">
                <label class="text-white ">Nazwa wielkosci fizycznej PL</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input name="QuantityNamePL" type="text" class="form-control" value="<?=$quantity_name_pl?>"/>

            </div>

        </div>
    </div>

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-4">
                <label class="text-white ">Nazwa wielkosci fizycznej ENG</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input name="QuantityNameENG" type="text" class="form-control" value="<?=$quantity_name_eng?>"/>

            </div>

        </div>
    </div>

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-4">
                <label class="text-white ">Jednostka podstawowa</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input name="Unit" type="text" class="form-control" value="<?=$unit?>"/>

            </div>

        </div>
    </div>

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-4">
                <label class="text-white ">Pełna nazwa jednostki PL</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input name="UnitNamePL" type="text" class="form-control" value="<?=$unit_full_name_pl?>"/>

            </div>

        </div>
    </div>
    <div class="container">
        <div class="row mt-5">

            <div class="col-md-4">
                <label class="text-white ">Pełna nazwa jednostki ENG</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input name="UnitNameENG" type="text" class="form-control" value="<?=$unit_full_name_eng?>"/>

            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
            </div>
        </div>
    </div>

</form>


<?php
    if($_POST)
    {
        $quantity_name_pl   = $_POST["QuantityNamePL"];
        $quantity_name_eng  = $_POST["QuantityNameENG"];
        $unit               = $_POST["Unit"];
        $unit_full_name_pl  = $_POST["UnitNamePL"];
        $unit_full_name_eng = $_POST["UnitNameENG"];

        open_database();
            $result = update_quantity_and_base_unit($quantity_name_pl, $quantity_name_eng, $unit,
                                                    $unit_full_name_pl, $unit_full_name_eng);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić wielkości fizycznej i jej jednostki podstawowej!';
        else
            echo '<br><hr>Wielkość fizyczna i jej jednostka podstawowa została zmieniona!';
    }
?>

		
</body>
</html>