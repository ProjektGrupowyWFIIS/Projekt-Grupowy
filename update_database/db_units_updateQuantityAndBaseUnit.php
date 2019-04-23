<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj wielkość fizyczną i jej jednostkę podstawową</title>
</head>
<body>

<h3>Edytuj wielkość fizyczną i jej jednostkę podstawową</h3>


<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";

    list($quantity_name_pl, $quantity_name_eng, $unit,
         $unit_full_name_pl, $unit_full_name_eng) = get_quantity_and_base_unit();
?>

<p>
Nazwa wielkości fizycznej PL: <input type="text"  name="QuantityNamePL" value="<?=$quantity_name_pl?>"/>
</p>

<p>
Nazwa wielkości fizycznej ENG: <input type="text"  name="QuantityNameENG" value="<?=$quantity_name_eng?>"/>
</p>

<p>
Jednostka podstawowa: <input type="text"  name="Unit" value="<?=$unit?>"/>
</p>

<p>
Pełna nazwa jednostki PL: <input type="text"  name="UnitNamePL" value="<?=$unit_full_name_pl?>"/>
</p>

<p>
Pełna nazwa jednostki ENG: <input type="text"  name="UnitNameENG" value="<?=$unit_full_name_eng?>"/>
</p>

<input type="submit" value="Zapisz">
            
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