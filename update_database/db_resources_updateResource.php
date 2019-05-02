<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj zasób (surowiec)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<h3 class="text-white text-center mt-3">Edytuj zasób (surowiec)</h3>

<form method="post" action="">


<?php
    require "db_update_functions.php";
    require "db_functions.php";

    list($resource_name_pl, $resource_name_eng,
         $resource_description_pl, $resource_description_eng) = get_resource();
?>

    <div class="container">
        <div class="row mt-5">

            <div class="col-md-4">
                <label class="text-white ">Nazwa PL</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input name="NamePL" type="text" class="form-control" value="<?=$resource_name_pl?>"/>

            </div>

        </div>
    </div>


    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <label class="text-white">Nazwa ENG</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input type="text" name="NameENG" class="form-control" value="<?=$resource_name_eng?>"/>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <label class="text-white ">Opis PL</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input type="text" name="DescPL" class="form-control" value="<?=$resource_description_pl?>"/>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <label class="text-white ">Opis ENG</label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input type="text" name="DescENG" class="form-control" value="<?=$resource_description_eng?>"/>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
            </div>
        </div>
    </div>

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