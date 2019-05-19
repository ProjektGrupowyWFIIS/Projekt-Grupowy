﻿<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj atrybut (cechę nienumeryczną) dla zasobu (surowca)</title>
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

<h3 class="text-white text-center mt-3">Edytuj wartości atrybutów dla podanego zasobu (surowca)</h3>

<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $attribute = read_table("attributes.attributes");
        $resource = read_table("resources.resources");
    close_database();

    $attribute_value = get_resource_attribute();
?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <label>
                    Zasób (surowiec):
                </label>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-md-4">
                <select name="ResourceID" class="form-control">
                    <?php
                    foreach($resource as $row_number => $row){
                        ?>
                        <option value="<?=$row['resource_id'];?>"><?=$row['resource_name_pl'];?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>



    <p class="text-white-50 font-italic text-center mt-5">
        Należy uwzględnić wszystkie obowiązkowe atrybuty dla wszystkich kategorii, do których należy powyższy zasób.
        <br>Oto lista tych atrybutów:
    </p>


    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <label>
                    Atrybut:
                </label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <select name="AttributeID" class="form-control">
                    <?php
                    foreach($attribute as $row_number => $row){
                        ?>
                        <option value="<?=$row['attribute_id'];?>"><?=$row['attribute_name_pl'];?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>


    <p class="text-white-50 font-italic text-center mt-5">
        Jeśli atrybut jest typu wyliczeniowego, to poniżej należy wpisać wartość dozwoloną dla tego typu.
        <br>
        Jeśli atrybut jest typu swobodnego, to poniżej można wpisać dowolną wartość.
    </p>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <label>
                    Wartość:
                </label>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <input type="text"  name="Value" class="form-control" value="<?=$attribute_value?>"/>
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
        $resource_id = $_POST["ResourceID"];
        $attribute_id = $_POST["AttributeID"];
        $attribute_value = $_POST["Value"];

        open_database();
            $result = update_resource_attribute($resource_id, $attribute_id, $attribute_value);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić atrybutu zasobu!';
        else
            echo '<br><hr>Atrybut zasobu zmieniony!';
    }
?>

</body>
</html>