<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj możliwą wartość atrybutu wyliczeniowego</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</head>
<body>

<?php
    include ('navbar.php');
?>


<?php
require "db_functions.php";
require "db_update_functions.php";

$result=0;

if($_GET)
{
  $attribute_id = $_GET["AttributeID"];
  $attribute_value_pl = $_GET["AttributeValuePL"];
  open_database();
  $attribute = read_table("attributes.attributes","where type_id='enum'");
  close_database();
  
  list($attribute_value_pl, $attribute_value_eng,
       $attribute_value_description_pl, $attribute_value_description_eng) =
       get_attribute_enum($attribute_id, $attribute_value_pl);
  
}


if($_POST)
{
  $attribute_value_pl2 = $_POST["ValuePL"];
  $attribute_value_eng = $_POST["ValueENG"];
  $attribute_value_description_pl = $_POST["DescPL"];
  $attribute_value_description_eng = $_POST["DescENG"];

  open_database();
  $result = update_attribute_enum($attribute_id, $attribute_value_pl, $attribute_value_pl2,
            $attribute_value_eng, $attribute_value_description_pl, $attribute_value_description_eng);
  close_database();

  $attribute_value_pl  = $attribute_value_pl2;


  if ($result)
  {
    unset ($_POST['ValuePL']);
    unset ($_POST['ValueENG']);
    unset ($_POST['DescPL']);
    unset ($_POST['DescENG']);
  }  

}
      
?>


<div class="container-fluid">
    <h3 class="text-white text-center mt-3">Edytuj dopuszczalną wartość atrybutu wyliczeniowego</h3>

<div class="text-center">
    <div class="container">
        <form method="post" action="" class="form-group">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white">
                    Atrybut (wyliczeniowy):
                </label>
            </div>

         

            <div class="col-md-3">
                <select name="AttributeID2" class="form-control" disabled>
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
            <div class="col-md-3">
                <label class="text-white" >
                    Wartość PL:
                </label>
            </div>
            <div class="col-md-3">
                <input type="text"  name="ValuePL" class="form-control" value="<?=$attribute_value_pl?>" required/>
            </div>

            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white" >
                    Wartość ENG:
                </label>
            </div>
            <div class="col-md-3">
                <input type="text"  name="ValueENG" class="form-control" value="<?=$attribute_value_eng?>" required/>
            </div>



            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white" >
                    Opis PL:
                </label>
            </div>
         
            <div class="col-md-3">
                <input type="text"  name="DescPL" class="form-control" value="<?=$attribute_value_description_pl?>" required/>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
                <div class="col-md-3"></div>
            <div class="col-md-3">
                <label class="text-white" >
                    Opis ENG:
                </label>
            </div>
            
            <div class="col-md-3">
                <input type="text"  name="DescENG" class="form-control" value="<?=$attribute_value_description_eng?>" required/>
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
        <a href="db_attributes_showAttributeEnum.php">
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

if ($result)
  echo "<br><h4><center><span style='color: white; background-color: black'>Możliwa wartość atrybutu wyliczeniowego zmieniona!</span></center></h4>";
else
{
  if($_POST)
  {
    echo "<br><h4><center><span style='color: red; background-color: black'>Nie mogę zmienić możliwej wartości atrybutu wyliczeniowego!</span></center></h4>";
  }
}

?>
</div>
</body>
</html>