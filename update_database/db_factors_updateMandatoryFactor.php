<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj obowiązkowy współczynnik (atrybut numeryczny) dla podanej kategorii zasobów</title>
</head>
<body>

<h3>Edytuj zestaw obowiązkowych współczynników dla podanej kategorii zasobów</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $factor = read_table("factors.factor_names");
        $category = read_table("categories.categories");
    close_database();
?>

<p>
Kategoria zasobów: 
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
Obowiązkowy współczynnik (atrybut numeryczny) dla powyższej kategorii: 
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

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $cat_id = $_POST["CategoryID"];
        $factor_id = $_POST["FactorID"];

        open_database();
            $result = update_mandatory_factor($cat_id, $factor_id) ;
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić obowiązkowego współczynnika!';
        else
            echo '<br><hr>Obowiązkowy współczynnik zmieniony!';
    }
?>

</body>
</html>