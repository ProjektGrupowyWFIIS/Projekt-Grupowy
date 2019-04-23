<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj obowiązkowy atrybut dla podanej kategorii</title>
</head>
<body>


<h3>Edytuj zestaw obowiązkowych atrybutów dla podanej kategorii zasobów</h3>


<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $attribute = read_table("attributes.attributes");
        $category = read_table("categories.categories");
    close_database();
?>

<p>
Kategoria: 
<select name="CategoryID">
<?php
foreach($category as $row_number => $row){
?>
<option value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
<?php
}
?>
</select>
</p>

<p>
Obowiązkowy atrybut dla powyższej kategorii: 
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

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $cat_id = $_POST["CategoryID"];
        $attribute_id = $_POST["AttributeID"];

        open_database();
            $result = update_mandatory_attribute($cat_id, $attribute_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić obowiązkowego atrybutu!';
        else
            echo '<br><hr>Obowiązkowy atrybut zmieniony!';
    }
?>

</body>
</html>