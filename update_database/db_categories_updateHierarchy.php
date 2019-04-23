<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj hierarchię kategorii</title>
</head>
<body>


<h3>
Edytuj hierarchię kategorii zasobów.
Hierarchia nie jest drzewem, lecz grafem acyklicznym, a zatem każda kategoria może mieć wiele kategorii nadrzędnych.
</h3>


<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $categories = read_table("categories.categories");
    close_database();
?>

<p>
Wybierz kategorię: 
<select name="CatID">
<?php
foreach($categories as $row_number => $row){
?>
<option value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
<?php
}
?>
</select>
</p>

<p>
Wybierz kategorię nadrzędną: 
<select name="ParentID">
<?php
foreach($categories as $row_number => $row){
?>
<option value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
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
        $cat_id    = $_POST["CatID"];
        $parent_id = $_POST["ParentID"];

        open_database();
            $result = update_hierarchy_of_categories($cat_id, $parent_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić hierarchii kategorii!';
        else
            echo '<br><hr>Hierarchia kategorii zmieniona!';
    }
?>

		
</body>
</html>

