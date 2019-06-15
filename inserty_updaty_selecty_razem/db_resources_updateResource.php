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
<div>

<?php
include ('navbar.php');
?>
<h3 class="text-white text-center mt-3">Edytuj zasób (surowiec)</h3>

<form method="post" action="">
    <?php
        require "db_update_functions.php";
        require "db_functions.php";
        if($_GET)
        {
            $resource_id = $_GET["ResourceID"];
        }
        list($resource_name_pl, $resource_name_eng,
             $resource_description_pl, $resource_description_eng) = get_resource($resource_id);
    ?>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Nazwa PL</label>
            </div>
            
            <div class="col-md-3">
                <input name="NamePL" type="text" class="form-control" value="<?=$resource_name_pl?>" required/>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white">Nazwa ENG</label>
            </div>
          
            <div class="col-md-3">
                <input type="text" name="NameENG" class="form-control" value="<?=$resource_name_eng?>" required/>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Opis PL</label>
            </div>
     
            <div class="col-md-3">
                <input type="text" name="DescPL" class="form-control" value="<?=$resource_description_pl?>" required/>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Opis ENG</label>
            </div>
 
            <div class="col-md-3">
                <input type="text" name="DescENG" class="form-control" value="<?=$resource_description_eng?>" required/>
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
    <a href="db_resources_showResource.php">
        <div class="row mt-3">
                <div class="col-md-3"></div>
            <div class="col-md-6">
                <input type="button" value="wróć" class="btn btn-block btn-primary mt-3">
            </div>
            <div class="col-md-3"></div>
        </div>
    </a>
</div>
</div>
<div class="text-center">
<?php
    if($_POST)
    {
        $resource_name_pl = $_POST["NamePL"];
        $resource_name_eng = $_POST["NameENG"];
        $resource_description_pl = $_POST["DescPL"];
        $resource_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_resource($resource_id, $resource_name_pl, $resource_name_eng,
                                      $resource_description_pl, $resource_description_eng);
        close_database();

        if ($result)
            echo "<br><h4><center><span style='color: white; background-color: black'>Zasób ".$resource_name_pl." zmieniony.</span></center></h4>";
        else
        {
            if($_POST)
            {
                open_database();
                $result = get_resource_id($resource_name_pl);
                if ($result)
                    echo "<br><h4><center><span style='color: red; background-color: black'>Edycja nieudana: Zasób ".$resource_name_pl." już istnieje!</span></center></h4>";
                else
                    echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zmienić zasobu!</span></center></h4>";
                close_database();
            }
        }
    }
?>
</div>
</body>
</html>