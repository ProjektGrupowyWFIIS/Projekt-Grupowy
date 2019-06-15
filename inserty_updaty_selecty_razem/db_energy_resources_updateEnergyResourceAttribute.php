﻿<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj atrybut (cechę nienumeryczną) dla zasobu energetycznego (nośnika energii)</title>
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

<h3 class="text-white text-center mt-3">Edytuj wartości atrybutów dla podanego zasobu energetycznego (nośnika energii)</h3>

<div class="text-center">
    <form method="post" action="">
    <?php
        require "db_update_functions.php";
        require "db_functions.php";
        if($_GET)
        {
            $resource_id = $_GET["ResourceID"];
            $attribute_id = $_GET["AttributeID"];
        }
        $attribute_value = get_energy_resource_attribute($resource_id, $attribute_id);
        $attribute_name_pl = get_attribute_name_pl($attribute_id);
        $resource_name_pl = get_resource_name_pl($resource_id );
    ?>
        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Zasób energetyczny (nośnik energii):
                    </label>
                </div>
               
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="ResourceID2" value="<?=$resource_name_pl?>" disabled/>
                        <input class="form-control" type="hidden" name="ResourceID2" value="<?=$resource_id?>"/>
                    </div>
                    <div class="col-md-3"></div>
            </div>
        </div>

        <p class="text-white-50 lead mt-5 font-italic font-weight-normal">
            Należy uwzględnić wszystkie obowiązkowe atrybuty dla wszystkich kategorii, do których należy powyższy zasób.
        </p>

        <div class="container">
            <div class="row">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Atrybut:
                    </label>
                </div>
    
                <div class="col-md-3">
                    <input class="form-control" type="text" name="AttributeID2" value="<?=$attribute_name_pl?>" disabled/>
                    <input class="form-control" type="hidden" name="AttributeID2" value="<?=$attribute_id?>"/>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <p class="text-white-50 lead mt-5 font-italic font-weight-normal">
            Jeśli atrybut jest typu wyliczeniowego, to poniżej należy wpisać wartość dozwoloną dla tego typu.
            <br>
            Jeśli atrybut jest typu swobodnego, to poniżej można wpisać dowolną wartość.
        </p>
        <div class="container">
            <div class="row">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Wartość:
                    </label>
                </div>
           
                <div class="col-md-3">
                    <input type="number" step="0.0000000001" min="0.0000000001" name="Value" class="form-control" value="<?=$attribute_value?>" required/>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="submit" value="Zapisz" class="btn btn-block btn-success">
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>

    <div class="container">
        <a href="db_energy_resources_showEnergyResourceAttribute.php">
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
        $attribute_value = $_POST["Value"];

        open_database();
            $result = update_energy_resource_attribute($resource_id, $attribute_id, $attribute_value);
        close_database();

        if (!$result)
            echo "<br><h4><center><span style='color: red; background-color: black'></span>Z nieznanego powodu nie mogę zmienić atrybutu zasobu energetycznego!</center></h4>";
        else
            echo "<br><h4><center><span style='color: white; background-color: black'>Atrybut zasobu energetycznego zmieniony!</span></center></h4>";
    }
?>
</div>
</body>
</html>