<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj nazwę współczynnika</title>
</head>
<body>

<h3>Edytuj współczynniki (czyli numeryczne cechy zasobu)</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";

    list($factor_id, $factor_name_pl, $factor_name_eng, $factor_description_pl,
         $factor_description_eng) = get_factor_name();
?>
<p>
Identyfikator (skrót): <input type="text"  name="ID" value="<?=$factor_id?>"/>
</p>

<p>
Nazwa PL: <input type="text"  name="NamePL" value="<?=$factor_name_pl?>"/>
</p>

<p>
Nazwa ENG: <input type="text"  name="NameENG" value="<?=$factor_name_eng?>"/>
</p>

<p>
Opis PL: <input type="text"  name="DescPL" value="<?=$factor_description_pl?>"/>
</p>

<p>
Opis ENG: <input type="text"  name="DescENG" value="<?=$factor_description_eng?>"/>
</p>

<input type="submit" value="Zapisz">

</form>


<?php
    if($_POST)
    {
        $factor_id = $_POST["ID"];
        $factor_name_pl = $_POST["NamePL"];
        $factor_name_eng = $_POST["NameENG"];
        $factor_description_pl = $_POST["DescPL"];
        $factor_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_factor_name($factor_id, $factor_name_pl, $factor_name_eng,
                                         $factor_description_pl, $factor_description_eng);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić nazwy współczynnika!';
        else
            echo '<br><hr>Nazwa współczynnika zmieniona!';
    }
?>

</body>
</html>