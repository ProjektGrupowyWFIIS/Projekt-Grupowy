<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj możliwą wartość atrybutu wyliczeniowego</title>
</head>
<body>

<h3>Edytuj dopuszczalne wartości atrybutu wyliczeniowego</h3>


<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $attribute = read_table("attributes.attributes","where type_id='enum'");
    close_database();

    list($attribute_value_pl, $attribute_value_eng,
         $attribute_value_description_pl, $attribute_value_description_eng) = get_attribute_enum();
?>

<p>
Atrybut (wyliczeniowy): 
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
Wartość PL: <input type="text"  name="ValuePL" value="<?=$attribute_value_pl?>"/>
</p>

<p>
Wartość ENG: <input type="text"  name="ValueENG" value="<?=$attribute_value_eng?>"/>
</p>

<p>
Opis PL: <input type="text"  name="DescPL" value="<?=$attribute_value_description_pl?>"/>
</p>

<p>
Opis ENG: <input type="text"  name="DescENG" value="<?=$attribute_value_description_eng?>"/>
</p>

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $attribute_id = $_POST["AttributeID"];
        $attribute_value_pl = $_POST["ValuePL"];
        $attribute_value_eng = $_POST["ValueENG"];
        $attribute_value_description_pl = $_POST["DescPL"];
        $attribute_value_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_attribute_enum($attribute_id, $attribute_value_pl, $attribute_value_eng,
                                            $attribute_value_description_pl, $attribute_value_description_eng);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić możliwej wartości atrybutu wyliczeniowego!';
        else
            echo '<br><hr>Możliwa wartość atrybutu wyliczeniowego zmieniona!';
    }
?>

</body>
</html>