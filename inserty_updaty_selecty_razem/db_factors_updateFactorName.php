<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj nazwę współczynnika</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include ('navbar.php');
?>

<h3 class="text-white text-center mt-3">Edytuj współczynniki (czyli numeryczne cechy zasobu)</h3>

<div class="text-center">
    <form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";

    if($_GET)
    {
        $factor_id = $_GET["FactorID"];
    }

    list($factor_id, $factor_name_pl, $factor_name_eng, $factor_description_pl,
         $factor_description_eng) = get_factor_name($factor_id);
?>
        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white">
                        Identyfikator(skrot)
                    </label>
                </div>
            
                <div class="col-md-3">
                    <input type="text"  name="ID2" class="form-control" value="<?=$factor_id?>" readonly/>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white">
                        Nazwa PL:
                    </label>
                </div>
               
                <div class="col-md-3">
                    <input type="text"  name="NamePL" class="form-control" value="<?=$factor_name_pl?>"/>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white">
                        Nazwa ENG:
                    </label>
                </div>
            
                <div class="col-md-3">
                    <input type="text"  name="NameENG" class="form-control" value="<?=$factor_name_eng?>"/>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white">
                        Opis PL:
                    </label>
                </div>
            
                <div class="col-md-3">
                    <input type="text"  name="DescPL" class="form-control" value="<?=$factor_description_pl?>"/>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white">
                        Opis ENG:
                    </label>
                </div>
            
                <div class="col-md-3">
                    <input type="text"  name="DescENG" class="form-control" value="<?=$factor_description_eng?>"/>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="submit" value="Zapisz" class="btn btn-block btn-success mt-5">
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>

    <div class="container">
        <a href="db_factors_showFactorName.php">
            <div class="row mt-3">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="button" value="wróć" class="btn btn-block btn-primary mt-3">
                </div>
                <div class="col-md-3"></div>
            </div>
        </a>
    </div>

<?php
    if($_POST)
    {
        $factor_id2 = $_POST["ID2"];
        $factor_name_pl = $_POST["NamePL"];
        $factor_name_eng = $_POST["NameENG"];
        $factor_description_pl = $_POST["DescPL"];
        $factor_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_factor_name($factor_id, $factor_id2, $factor_name_pl, $factor_name_eng,
                                         $factor_description_pl, $factor_description_eng);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić nazwy współczynnika!';
        else
            echo '<br><hr>Nazwa współczynnika zmieniona!';
    }
?>
</div>
</body>
</html>