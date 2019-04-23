<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj współczynnik (cechę numeryczną) dla zasobu (surowca)</title>
</head>
<body>

<h3>Edytuj wartości współczynników dla podanego zasobu (surowca)</h3>
      
<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $resource = read_table("resources.resources");;
        $factor = read_table("factors.factor_names");
        $source = read_table("factors.sources");
        $unit = read_table("units.units");
    close_database();

    list($factor, $uncertainty) = get_factor();
?>

<p>
Zasób (surowiec): 
<select name="ResourceID">
<?php
foreach($resource as $row_number => $row){
?>
<option value="<?=$row['resource_id'];?>"><?=$row['resource_name_pl'];?></option>
<?php
}
?>
</select>
</p>

<p>
Należy uwzględnić wszystkie obowiązkowe współczynniki dla wszystkich kategorii, do których należy powyższy zasób. 
<br>Oto lista tych współczynników: ... tu wyświetlić listę ....
</p>

<p>
Nazwa współczynnika: 
<select name="FactorID">
<?php
foreach($factor as $row_number => $row){
?>
<option value="<?=$row['factor_id'];?>"><?=$row['factor_name_pl'];?></option>
<?php
}
?>
</select>
</p>

<p>
Źródło: 
<select name="SourceID">
<?php
foreach($source as $row_number => $row){
?>
<option value="<?=$row['source_id'];?>"><?=$row['source_description'];?></option>
<?php
}
?>
</select>
</p>


<p>
Jednostka zasobu 1: 
<select name="Unit1ID">
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
<?php
}
?>
</select>
</p>


<p>
Jednostka zasobu 2:
<select name="Unit2ID">
<option value="0">(nie dotyczy)</option>
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
<?php
}
?>
</select>
</p>

<p>
Jednostka współczynnika:
<select name="FactorUnitID">
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
<?php
}
?>
</select>
</p>

<p>
Współczynnik (liczba >=0): <input type="text"  name="Factor" value="<?=$factor?>"/>
</p>

<p>
Niepewność [0..100]: <input type="text"  name="Uncertainty" value="<?=$uncertainty?>"/> %
<br>
(zostaw puste pole jeśli nie wiesz jaka jest niepewność)
</p>

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $resource_id = $_POST["ResourceID"];
        $factor_id = $_POST["FactorID"];
        $source_id = $_POST["SourceID"];
        $resource_unit_1_id = $_POST["Unit1ID"];
        $resource_unit_2_id = $_POST["Unit2ID"];
        $factor_unit_id = $_POST["FactorUnitID"];
        $factor = $_POST["Factor"];
        $uncertainty = $_POST["Uncertainty"];

        open_database();
            if ($uncertainty == "")
                $result = update_factor($resource_id, $factor_id, $source_id, $resource_unit_1_id,
                                        $resource_unit_2_id, $factor_unit_id, $factor);
            else
                $result = update_factor($resource_id, $factor_id, $source_id, $resource_unit_1_id,
                                        $resource_unit_2_id, $factor_unit_id, $factor, $uncertainty);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić współczynnika!';
        else
            echo '<br><hr>Współczynnik zmieniony!';
    }
?>

</body>
</html>