<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <title>Dodaj atrybut</title>
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
    
  <h3 class="text-white text-center mt-3">Zdefiniuj atrybuty (czyli nienumeryczne cechy zasobu)</h3>

  <div class="text-center">
    <div class="container">

      <form method="post" action="" class=" form-group">


        <div class="row mt-5">

             
            <div class="col-md-3"></div>
            <div class="col-md-3"><label class="text-white ">Wybierz typ</label></div>
            <div class="col-md-3">
             <select name="Type" class="form-control">
                <option value="free">swobodny</option>
                <option value="enum">wyliczeniowy</option>
            </div>
            <div class="col-md-3"></div>
            </select>

        </div>
      </div>
      <div class="container">
          <div class="row mt-5">
            <div class="col-md-3"></div>
              <div class="col-md-3"><label class="text-white">Nazwa PL</label></div>
              <div class="col-md-3">
                <input type="text" name="NameENG" class="form-control" />
              </div>
              <div class="col-md-3"></div>
            </div>
      </div>
             


        
<div class="container">
    <div class="row mt-5">
      <div class="col-md-3"></div>
        <div class="col-md-3"><label class="text-white">Nazwa ENG</label></div>
        <div class="col-md-3">
          <input type="text" name="NameENG" class="form-control" />
        </div>
        <div class="col-md-3"></div>
      </div>
</div>
       

<div class="container">
    <div class="row mt-5">
      <div class="col-md-3"></div>
        <div class="col-md-3"><label class="text-white">OpisPL</label></div>
        <div class="col-md-3">
          <input type="text" name="DescPL" class="form-control" />
        </div>
        <div class="col-md-3"></div>
      </div>
</div>
       

<div class="container">
        <div class="row mt-5">
       <div class="col-md-3"></div>
        <div class="col-md-3"> <label class="text-white ">Opis ENG</label></div>
        <div class="col-md-3">
          <input type="text" name="DescENG" class="form-control"/>
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
   
  </div>
</body>

</html>

<?php

require "db_functions.php";

if($_POST)
{
  $type_id = $_POST["Type"];
  $attribute_name_pl = $_POST["NamePL"];
  $attribute_name_eng = $_POST["NameENG"];
  $attribute_description_pl = $_POST["DescPL"];
  $attribute_description_eng = $_POST["DescENG"];

  open_database();
  $result = write_attribute($type_id, $attribute_name_pl, $attribute_name_eng, $attribute_description_pl, $attribute_description_eng)  ;
  close_database();	

  if (!$result)
    echo "<br><p style='color: white'>Nie mogę zapisać atrybutu!</p>";
  else
    echo "<br><p style='color: white'>Atrybut zapisany!</p>";
}
?>