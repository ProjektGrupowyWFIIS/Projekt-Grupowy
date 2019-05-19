﻿<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj podany zasób (surowiec) dla kategorii</title>
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

<h3 class="text-white text-center mt-3">Edytuj podany zasób (surowiec) dla kategorii</h3>

<form method="post" action="">


<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $resource = read_table("resources.resources");
        $category = read_table("categories.categories");
    close_database();
?>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label>
                    Zasób (surowiec):
                </label>
            </div>
            <div class="col-md-4"></div>
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

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <label>
                    Kategoria:
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