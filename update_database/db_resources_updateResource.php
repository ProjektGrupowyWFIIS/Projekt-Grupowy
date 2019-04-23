<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj zasób (surowiec)</title>
</head>
<body>

<h3>Edytuj zasób (surowiec)</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";

    list($resource_name_pl, $resource_name_eng,
         $resource_description_pl, $resource_description_eng) = get_resource();
?>

<p>
Nazwa PL: <input type="text"  name="NamePL" value="<?=$resource_name_pl?>"/>
</p>

<p>
Nazwa ENG: <input type="text"  name="NameENG" value="<?=$resource_name_eng?>"/>
</p>

<p>
Opis PL: <input type="text"  name="DescPL" value="<?=$resource_description_pl?>"/>
</p>

<p>
Opis ENG: <input type="text"  name="DescENG" value="<?=$resource_description_eng?>"/>
</p>

<input type="submit" value="Zapisz">

</form>


<?php
    if($_POST)
    {
        $resource_name_pl = $_POST["NamePL"];
        $resource_name_eng = $_POST["NameENG"];
        $resource_description_pl = $_POST["DescPL"];
        $resource_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_resource($resource_name_pl, $resource_name_eng,
                                      $resource_description_pl, $resource_description_eng);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić zasobu (surowca)!';
        else
            echo '<br><hr>Zasób (surowiec) zmieniony!';
    }
?>

</body>
</html>