<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj możliwą wartość atrybutu wyliczeniowego</title>
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
<div class="container-fluid">
<h3 class="text-white text-center mt-3">Zdefiniuj dopuszczalne wartości atrybutu wyliczeniowego</h3>

<div class="text-center">
<form method="post" action="" class="form-group">

<?php
require "db_functions.php";
open_database();
$attribute = read_table("attributes.attributes","where type_id='enum'");
close_database();
?>
<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label class="text-white">
Atrybut (wyliczeniowy): 
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
</div>
</select>
</div>
</div>



<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label class="text-white" >
Wartość PL:
</label>
</div> 
<div class="col-md-4"></div>
<div class="col-md-4">
<input type="text"  name="ValuePL" class="form-control"/>
</div>
</div>
</div>




<div class="container">
    <div class="row mt-5">
      <div class="col-md-4">
  <label class="text-white" >
  Wartość ENG:
  </label>
  </div> 
  <div class="col-md-4"></div>
  <div class="col-md-4">
  <input type="text"  name="ValueENG" class="form-control"/>
  </div>
  </div>
  </div>

  <div class="container">
      <div class="row mt-5">
        <div class="col-md-4">
    <label class="text-white" >
    Opis PL:
    </label>
    </div> 
    <div class="col-md-4"></div>
    <div class="col-md-4">
    <input type="text"  name="DescPL" class="form-control" />
    </div>
    </div>
    </div>

    <div class="container">
        <div class="row mt-5">
          <div class="col-md-4">
      <label class="text-white" >
      Opis ENG:
      </label>
      </div> 
      <div class="col-md-4"></div>
      <div class="col-md-4">
      <input type="text"  name="DescENG" class="form-control" />
      </div>
      </div>
      </div>

<input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
            
</form>


<?php

if($_POST)
{
  $attribute_id = $_POST["AttributeID"];
  $attribute_value_pl = $_POST["ValuePL"];
  $attribute_value_eng = $_POST["ValueENG"];
  $attribute_value_description_pl = $_POST["DescPL"];
  $attribute_value_description_eng = $_POST["DescENG"];

  open_database();
  $result = write_attribute_enum($attribute_id,$attribute_value_pl,$attribute_value_eng,$attribute_value_description_pl,$attribute_value_description_eng) ;
  close_database();	

  if (!$result)
    echo '<br><hr>Nie mogę zapisać możliwej wartości atrybutu wyliczeniowego!';
  else
    echo '<br><hr>Możliwa wartość atrybutu wyliczeniowego zapisana!';
}
?>
</div>
</div>
</body>
</html>