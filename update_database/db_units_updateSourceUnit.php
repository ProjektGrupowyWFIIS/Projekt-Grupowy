<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj alternatywną nazwę jednostki</title>
</head>
<body>

<h3>Edytuj alternatywną nazwę jednostki (tj. nazwę, która może pojawić się w źródłach)</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $units = read_table("units.units");
    close_database();

    $unit_variant = get_source_unit_name();
?>

<p>
Alternatywna nazwa jednostki: <input type="text"  name="UnitVariant" value="<?=$unit_variant?>"/>
</p>

<p>
Jednostka 'kanoniczna': 
<select name="CanonicalUnitID">
<?php
foreach($units as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
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
        $unit_variant   = $_POST["UnitVariant"];
        $canonical_unit_id  = $_POST["CanonicalUnitID"];

        open_database();
            $result = update_source_unit_name($unit_variant, $canonical_unit_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić jednostki alternatywnej!';
        else
            echo '<br><hr>Jednostka alternatywna zmieniona!';
    }
?>
		
</body>
</html>