<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj jednostkę dodatkową</title>
</head>
<body>

<h3>Edytuj jednostkę dodatkową</h3>


<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $quantities = read_table("units.quantities");
    close_database();

    list($unit, $unit_full_name_pl, $unit_full_name_eng, $ratio) = get_other_unit();
?>


<p>
Jednostka: <input type="text"  name="Unit" value="<?=$unit?>"/>
</p>

<p>
Pełna nazwa jednostki PL: <input type="text"  name="UnitNamePL" value="<?=$unit_full_name_pl?>"/>
</p>

<p>
Pełna nazwa jednostki ENG: <input type="text"  name="UnitNameENG" value="<?=$unit_full_name_eng?>"/>
</p>

<p>
Stosunek do jednostki podstawowej: <input type="text"  name="Ratio" value="<?=$ratio?>"/>
</p>

<p>
Wielkość fizyczna: 
<select name="QuantityID">
<?php
foreach($quantities as $row_number => $row){
?>
<option value="<?=$row['quantity_id'];?>"><?=$row['quantity_name_pl'];?></option>
<?php
}
?>
</select>
</p>

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $unit               = $_POST["Unit"];
        $unit_full_name_pl  = $_POST["UnitNamePL"];
        $unit_full_name_eng = $_POST["UnitNameENG"];
        $ratio              = $_POST["Ratio"];
        $quantity_id        = $_POST["QuantityID"];

        open_database();
            $result = update_other_unit($unit, $unit_full_name_pl, $unit_full_name_eng, $ratio, $quantity_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić jednostki!';
        else
            echo '<br><hr>Jednostka zmieniona!';
    }
?>

		
</body>
</html>