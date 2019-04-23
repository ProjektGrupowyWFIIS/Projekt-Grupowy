<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj kategorię</title>
</head>
<body>

<h3>Edytuj kategorię zasobów (zarówno surowców jak i nośników energii)</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";

    list($cat_name_pl, $cat_name_eng,
         $cat_description_pl, $cat_description_eng) = get_category();
?>

<p>
Nazwa PL: <input type="text"  name="NamePL"  value="<?=$cat_name_pl?>"/>
</p>
<p>
Nazwa ENG: <input type="text"  name="NameENG" value="<?=$cat_name_eng?>"/>
</p>
<p>
Opis PL: <input type="text"  name="DescPL" value="<?=$cat_description_pl?>"/>
</p>
<p>
Opis ENG: <input type="text"  name="DescENG" value="<?=$cat_description_eng?>"/>
</p>

<input type="submit" value="Zapisz">

</form>


<?php
    if($_POST)
    {
        $cat_name_pl = $_POST["NamePL"];
        $cat_name_eng = $_POST["NameENG"];
        $cat_description_pl = $_POST["DescPL"];
        $cat_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_category($cat_name_pl, $cat_name_eng, $cat_description_pl,
                                      $cat_description_eng);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić kategorii!';
        else
            echo '<br><hr>Kategoria zmieniona!';
    }
?>
	
</body>
</html>