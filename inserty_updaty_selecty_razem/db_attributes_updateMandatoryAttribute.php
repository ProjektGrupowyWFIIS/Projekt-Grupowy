<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytut obowiązkowy atrybut dla podanej kategorii</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php
    include ('navbar.php');
?>

<div class="container-fluid">
    <h3 class="text-white text-center mt-5">Edytuj zestaw obowiązkowych atrybutów dla podanej kategorii zasobów</h3>
    <div class="text-center">
        <form method="post" action="" class="form-group">
        <?php
            require "db_update_functions.php";
            require "db_functions.php";

            if($_GET)
            {
                $cat_id = $_GET["CatID"];
                $attribute_id = $_GET["AttributeID"];
            }

            open_database();
                $attribute = read_table("attributes.attributes");
                $category = read_table("categories.categories");
            close_database();
        ?>
            <div class="container">
                <div class="row mt-5">
                        <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <label class="text-white mt-5">
                            Kategoria:
                        </label>
                    </div>
                 
                    <div class="col-md-3">
                        <select name="CategoryID2" class="form-control mt-5">
                            <?php
                            foreach($category as $row_number => $row){
                                if($row['cat_id'] == $cat_id){
                                    ?>
                                    <option selected="selected" value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
                                    <?php
                                }
                                else{
                                    ?>
                                    <option value="<?=$row['cat_id'];?>"><?=$row['cat_name_pl'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <div class="container">
                <div class="row mt-5">
                        <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <label class="text-white mt-5">
                            Obowiązkowy atrybut dla powyższej kategorii:
                        </label>
                    </div>
                    
                    <div class="col-md-3">
                        <select name="AttributeID2" class="form-control mt-5">
                            <?php
                            foreach($attribute as $row_number => $row){
                                if($row['attribute_id'] == $attribute_id){
                                    ?>
                                    <option selected="selected" value="<?=$row['attribute_id'];?>"><?=$row['attribute_name_pl'];?></option>
                                    <?php
                                }
                                else{
                                    ?>
                                    <option value="<?=$row['attribute_id'];?>"><?=$row['attribute_name_pl'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
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
            <a href="db_attributes_showMandatoryAttribute.php">
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
        $cat_id2 = $_POST["CategoryID2"];
        $attribute_id2 = $_POST["AttributeID2"];

        open_database();
            $result = update_mandatory_attribute($cat_id, $attribute_id, $cat_id2, $attribute_id2);
        close_database();

        if (!$result)
            echo "<br><h4><center><span style='color: red; background-color: black'></span>Z nieznanego powodu nie mogę zmienić wartości obowiązkowego atrybutu!</center></h4>";
        else
            echo "<br><h4><center><span style='color: white; background-color: black'>Obowiązkowy atrybut zmieniony!</span></center></h4>";
    }
?>
</div>
</body>
</html>