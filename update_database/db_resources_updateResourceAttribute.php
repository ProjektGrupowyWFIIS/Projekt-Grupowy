<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj atrybut (cechę nienumeryczną) dla zasobu (surowca)</title>
</head>
<body>

<h3>Edytuj wartości atrybutów dla podanego zasobu (surowca)</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $attribute = read_table("attributes.attributes");
        $resource = read_table("resources.resources");
    close_database();

    $attribute_value = get_resource_attribute();
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
Należy uwzględnić wszystkie obowiązkowe atrybuty dla wszystkich kategorii, do których należy powyższy zasób. 
<br>Oto lista tych atrybutów: ... tu wyświetlić listę ....
</p>

<p>
Atrybut: 
<select name="AttributeID">
<?php
foreach($attribute as $row_number => $row){
?>
<option value="<?=$row['attribute_id'];?>"><?=$row['attribute_name_pl'];?></option>
<?php
}
?>
</select>
</p>

<p>
Jeśli atrybut jest typu wyliczeniowego, to poniżej należy wpisać wartość dozwoloną dla tego typu. 
<br>
Jeśli atrybut jest typu swobodnego, to poniżej można wpisać dowolną wartość. 
</p>

<p>
Wartość: <input type="text"  name="Value" value="<?=$attribute_value?>"/>
</p>

<input type="submit" value="Zapisz">

</form>



<?php
    if($_POST)
    {
        $resource_id = $_POST["ResourceID"];
        $attribute_id = $_POST["AttributeID"];
        $attribute_value = $_POST["Value"];

        open_database();
            $result = update_resource_attribute($resource_id, $attribute_id, $attribute_value);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić atrybutu zasobu!';
        else
            echo '<br><hr>Atrybut zasobu zmieniony!';
    }
?>

</body>
</html>