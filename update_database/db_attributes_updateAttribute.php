<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj atrybuty</title>
</head>
<body>

<?php
    require "db_update_functions.php";
    require "db_functions.php";

    list($attribute_name_pl, $attribute_name_eng,
         $attribute_description_pl, $attribute_description_eng) = get_source_unit_name();
?>

<h3>Edytuj atrybuty (czyli nienumeryczne cechy zasobu)</h3>

<form method="post" action="">

<p>
Typ:
<select name="Type">
<option value="free">swobodny</option>
<option value="enum">wyliczeniowy</option>
</select>
</p>

<p>
Nazwa PL: <input type="text"  name="NamePL"  value="<?=$attribute_name_pl?>"/>
</p>

<p>
Nazwa ENG: <input type="text"  name="NameENG" value="<?=$attribute_name_eng?>"/>
</p>

<p>
Opis PL: <input type="text"  name="DescPL" value="<?=$attribute_description_pl?>"/>
</p>

<p>
Opis ENG: <input type="text"  name="DescENG" value="<?=$attribute_description_eng?>"/>
</p>

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $type_id = $_POST["Type"];
        $attribute_name_pl = $_POST["NamePL"];
        $attribute_name_eng = $_POST["NameENG"];
        $attribute_description_pl = $_POST["DescPL"];
        $attribute_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_attribute($type_id, $attribute_name_pl, $attribute_name_eng,
                                       $attribute_description_pl, $attribute_description_eng);

        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić atrybutu!';
        else
            echo '<br><hr>Atrybut zmieniony!';
    }
?>
		
</body>
</html>