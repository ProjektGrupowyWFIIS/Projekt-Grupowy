<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj przypisanie podanego zasobu (surowca) do kategorii</title>
</head>
<body>

<h3>Edytuj przypisanie podanego zasobu (surowca) do kategorii</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $resource = read_table("resources.resources");
        $category = read_table("categories.categories");
    close_database();
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

<input type="submit" value="Zapisz">

</form>


<?php
    if($_POST)
    {
        $resource_id = $_POST["ResourceID"];
        $cat_id = $_POST["CategoryID"];

        open_database();
            $result = update_resource_category($resource_id, $cat_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić kategorii zasobu (surowca)!';
        else
            echo '<br><hr>Kategoria zasobu (surowca) zmieniona!';
    }
?>

</body>
</html>