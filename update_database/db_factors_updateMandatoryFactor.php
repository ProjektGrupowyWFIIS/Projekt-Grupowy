﻿<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj obowiązkowy współczynnik (atrybut numeryczny) dla podanej kategorii zasobów</title>
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
<h3 class="text-white text-center mt-3">Edytuj zestaw obowiązkowych współczynników dla podanej kategorii zasobów</h3>

<div class="text-center">
    <form method="post" action="">


    <?php
        require "db_update_functions.php";
        require "db_functions.php";
        open_database();
            $factor = read_table("factors.factor_names");
            $category = read_table("categories.categories");
        close_database();
    ?>

        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <label>
                        Kategoria zasobów:
                    </label>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <select name="CategoryID" class="form-control">
                        <?php
                        foreach($category as $row_number => $row){
                            ?>
                            <option value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <label>
                        Obowiązkowy współczynnik (atrybut numeryczny) dla powyższej kategorii:
                    </label>
                </div>
                <div class='col-md-4'></div>
                <div class="col-md-4">
                    <select name="FactorID" class="form-control">
                        <?php
                        foreach($factor as $row_number => $row){
                            ?>
                            <option value="<?=$row['factor_id'];?>"><?=$row['factor_name_pl'];?></option>
                            <?php
                        }
                        ?>
                    </select>
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