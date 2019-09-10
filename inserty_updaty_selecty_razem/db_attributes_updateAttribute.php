<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Edytuj atrybut</title>
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


<?php
/* PK VIII 2019 */

require "db_functions.php";
require "db_update_functions.php";

$result=0;

if($_GET)
{
  $attribute_id = $_GET["AttributeID"];

  list($attribute_name_pl, $attribute_name_eng,
    $attribute_description_pl, $attribute_description_eng, $type_id)
    = get_attribute($attribute_id);

  //if($type_id =="free")
  //  $type_id = "swobodny";
  //else if($type_id =="enum")
  //  $type_id = "wyliczeniowy";
}


if($_POST)
{
  $type_id = $_POST["Type"];
  //               if ($type_id == "wyliczeniowy") $type_id = "enum";
  //               if ($type_id == "swobodny") $type_id = "free";
  $attribute_name_pl = $_POST["NamePL"];
  $attribute_name_eng = $_POST["NameENG"];
  $attribute_description_pl = $_POST["DescPL"];
  $attribute_description_eng = $_POST["DescENG"];

  open_database();
      $result = update_attribute($type_id, $attribute_name_pl, $attribute_name_eng,
                                 $attribute_description_pl, $attribute_description_eng, $attribute_id);
  close_database();

  if ($result)
  {
    unset ($_POST['Type']);
    unset ($_POST['NamePL']);
    unset ($_POST['NameENG']);
    unset ($_POST['DescPL']);
    unset ($_POST['DescENG']);
  }  
}      

/* koniec PK VIII 2019 */
?>



<h3 class="text-white text-center mt-3">Edytuj atrybut (czyli nienumeryczną cechę zasobu)</h3>

<div class="text-center">
    <div class="container">
        <form method="post" action="" class=" form-group">
            <?php
            /* PK VIII 2019 */
/*
                require "db_update_functions.php";
                require "db_functions.php";
                if($_GET)
                {
                    $attribute_id = $_GET["AttributeID"];
                }
                list($attribute_name_pl, $attribute_name_eng,
                    $attribute_description_pl, $attribute_description_eng, $type_id)
                    = get_attribute($attribute_id);

                if($type_id =="free")
                    $type_id = "swobodny";
                else if($type_id =="enum")
                    $type_id = "wyliczeniowy";
*/
            ?>
            <div class="row mt-5">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">Wybierz typ</label>
                </div>
               
                <div class="col-md-3">

<!-- PK VIII 2019 -->
<?php  /*
                    <select name="Type" class="form-control">
                        <option selected="selected"><?=$type_id?></option>
                        <?php if($type_id =="wyliczeniowy")
                            echo '<option value="free">swobodny</option>';
                         else if($type_id =="swobodny")
                            echo '<option value="enum">wyliczeniowy</option>';
                        ?>
*/
?>
                    <select name="Type" class="form-control">
                        <?php 
                        if($type_id =="enum")
                        {
                            echo '<option value="enum" selected="selected">wyliczeniowy</option>';
                            echo '<option value="free">swobodny</option>';
                        }
                        else if($type_id =="free")
                        {
                          echo '<option value="enum">wyliczeniowy</option>';
                          echo '<option value="free" selected="selected">swobodny</option>';
                        }
                        ?>
<!-- koniec PK VIII 2019 -->

                    </select>
                </div>
            </div>
    </div>

    <div class="container">
        <div class="row mt-5">
        <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Nazwa PL</label>
            </div>
         
            <div class="col-md-3">
                <input name="NamePL" type="text" class="form-control" value="<?=$attribute_name_pl?>" required/>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white">Nazwa ENG</label>
            </div>
          
            <div class="col-md-3">
                <input type="text" name="NameENG" class="form-control" value="<?=$attribute_name_eng?>" required/>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Opis PL</label>
            </div>
        
            <div class="col-md-3">
                <input type="text" name="DescPL" class="form-control" value="<?=$attribute_description_pl?>" />
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white ">Opis ENG</label>
            </div>
        
            <div class="col-md-3">
                <input type="text" name="DescENG" class="form-control" value="<?=$attribute_description_eng?>" />
            </div>
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
        <a href="db_attributes_showAttribute.php">
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
/* PK VIII 2019 */
/*
    if($_POST)
    {
        $type_id = $_POST["Type"];

        $attribute_name_pl = $_POST["NamePL"];
        $attribute_name_eng = $_POST["NameENG"];
        $attribute_description_pl = $_POST["DescPL"];
        $attribute_description_eng = $_POST["DescENG"];

        open_database();
            $result = update_attribute($type_id, $attribute_name_pl, $attribute_name_eng,
                                       $attribute_description_pl, $attribute_description_eng, $attribute_id);
        close_database();

        if ($result)
            echo "<br><h4><center><span style='color: white; background-color: black'>Atrybut ".$attribute_name_pl." zmieniony.</span></center></h4>";
        else
        {
            if($_POST)
            {
                open_database();
                $result = get_attribute_id($attribute_name_pl);
                if ($result)
                    echo "<br><h4><center><span style='color: red; background-color: black'>Edycja nieudana: Atrybut ".$attribute_name_pl." już istnieje!</span></center></h4>";
                else
                    echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zmienić atrybutu!</span></center></h4>";
                close_database();
            }
        }
    }
*/




if ($result)
  echo "<br><h4><center><span style='color: white; background-color: black'>Atrybut ".$attribute_name_pl." zmieniony.</span></center></h4>";
else
{
  if($_POST)
  {
    open_database();
    $result = get_attribute_id($attribute_name_pl);
    if ($result)
      echo "<br><h4><center><span style='color: red; background-color: black'>Edycja nieudana: Atrybut ".$attribute_name_pl." już istnieje!</span></center></h4>";
    else
    {
      $result = get_attribute_id_eng($attribute_name_eng);
      if ($result)
        echo "<br><h4><center><span style='color: red; background-color: black'>Edycja nieudana: Atrybut ".$attribute_name_eng." już istnieje!</span></center></h4>";
      else
        echo "<br><h4><center><span style='color: red; background-color: black'>Nie mogę zmienić atrybutu!</span></center></h4>";
    }    
    close_database();
  }
}
/* koniec PK VIII 2019 */
?>
</div>

</body>
</html>