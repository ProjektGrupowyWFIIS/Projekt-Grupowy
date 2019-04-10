<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj współczynnik (cechę numeryczną) dla zasobu energetycznego (nośnika energii)</title>
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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">LOGO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
             
            </li>
            
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dodaj
                </button>
                <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                    
          
                    <li class="dropdown-submenu">
                        <a  class="dropdown-item" tabindex="-1" href="#">atrybut</a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_addAttribute.php">Atrybut</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_addAttributeEnum.php">Atrybut Enum</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_attributes_addMandatoryAttribute.php">Mandatory Atrybut</a></li>
                          
                          
                        </ul>
                      </li>
  
                      <li class="dropdown-submenu">
                        <a  class="dropdown-item" tabindex="-1" href="#">Kategorie</a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a tabindex="-1" href="db_categories_addCategory.php">Kategorie</a></li>
                          <li class="dropdown-item"><a tabindex="-1" href="db_categories_addHierarchy.php">Hierarchie</a></li>
                          
                          
                          
                        </ul>
                      </li>
  
                      <li class="dropdown-submenu">
                          <a  class="dropdown-item" tabindex="-1" href="#">Energy Resources</a>
                          <ul class="dropdown-menu">
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyFactor.php">EnergyFactor</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyResource.php">EnergyResource</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyResourceAttribute.php">EnergyResourceAttribute</a></li>
                            <li class="dropdown-item"><a tabindex="-1" href="db_energy_resources_addEnergyResourceCategory.php">EnergyResourceCategory</a></li>
                            
                            
                            
                          </ul>
                        </li>
  
                        <li class="dropdown-submenu">
                            <a  class="dropdown-item" tabindex="-1" href="#">Factors</a>
                            <ul class="dropdown-menu">
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_addFactorName.php">Factor Name</a></li>
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_addMandatoryFactor.php">Mandatory Factor</a></li>
                              <li class="dropdown-item"><a tabindex="-1" href="db_factors_addSource.php">Source</a></li>
                              
                              
                            </ul>
                          </li>
  
  
                          <li class="dropdown-submenu">
                              <a  class="dropdown-item" tabindex="-1" href="#">Files</a>
                              <ul class="dropdown-menu">
                                <li class="dropdown-item"><a tabindex="-1" href="db_files_addFile.php">File</a></li>
                                <li class="dropdown-item"><a tabindex="-1" href="db_files_addFolder.php">Folder</a></li>
                               
                                
                                
                              </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a  class="dropdown-item" tabindex="-1" href="#">Functions</a>
                                <ul class="dropdown-menu">
                                  <li class="dropdown-item"><a tabindex="-1" href="db_functions.php">Function</a></li>
                                
                                 
                                  
                                  
                                </ul>
                              </li>
  
  
                              <li class="dropdown-submenu">
                                  <a  class="dropdown-item" tabindex="-1" href="#">Resources</a>
                                  <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addFactor.php">Factor</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addResource.php">Resource</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addResourceAttribute.php">ResourceAttribute</a></li>
                                    <li class="dropdown-item"><a tabindex="-1" href="db_resources_addResourceCategory.php">ResourceCategory</a></li>
                                    
                                    
                                    
                                  </ul>
                                </li>
  
  
                                <li class="dropdown-submenu">
                                    <a  class="dropdown-item" tabindex="-1" >Units</a>
                                    <ul class="dropdown-menu">
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_addOtherUnit.php">OtherUnit</a></li>
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_addQuantityAndBaseUnit.php">QuantityAndBaseUnit</a></li>
                                      <li class="dropdown-item"><a tabindex="-1" href="db_units_addSourceUnit.php">SourceUnit</a></li>
                                     
                                      
                                      
                                      
                                    </ul>
                                  </li>

                  </ul>
            </div>




            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkTwo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Wyświetl
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
          </ul>
        </div>
      </nav>


<h3 class="text-white text-center mt-3">Zdefiniuj wartości współczynników dla podanego zasobu energetycznego (nośnika energii)</h3>

<div class="text-center">

<form method="post" action="" class="form-group">

<?php
require "db_functions.php";
open_database();
$resource = read_table("energy_resources.energy_resources");;
$factor = read_table("factors.factor_names");
$source = read_table("factors.sources");
$unit = read_table("units.units");
close_database();
?>

<div class="container">
  <div class="row mt-5">
    <div class="col-md-4">
<label class="text-white">
Zasób energetyczney (nośnik energii): 
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

<p class="text-white-50 lead mt-5 font-italic font-weight-normal">
Należy uwzględnić wszystkie obowiązkowe współczynniki dla wszystkich kategorii, do których należy powyższy zasób. 
<br>Oto lista tych współczynników: 
</p>


<div class="container">
  <div class="row">
    <div class="col-md-4">
<label class="text-white mt-5">
Nazwa współczynnika: 
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="FactorID" class="form-control mt-5">
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
  <div class="row mt-5">
    <div class="col-md-4">
<label class="text-white">
Źródło: 
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="SourceID" class="form-control">
<?php
foreach($source as $row_number => $row){
?>
<option value="<?=$row['source_id'];?>"><?=$row['source_description'];?></option>
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
Jednostka zasobu: 
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
<select name="UnitID" class="form-control">
<?php
foreach($unit as $row_number => $row){
?>
<option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
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
  Jednostka współczynnika: 
  </label>
  </div>
  <div class="col-md-4"></div>
  <div class="col-md-4">
  <select name="FactorUnitID" class="form-control">
  <?php
  foreach($unit as $row_number => $row){
  ?>
  <option value="<?=$row['unit_id'];?>"><?=$row['unit'];?></option>
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
Współczynnik (liczba >=0):
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
 <input type="text"  name="Factor"  class="form-control"/>
</div>
</div>
</div>

<div class="container">
    <div class="row mt-5">
      <div class="col-md-4">
<label>
Niepewność(0..100):
</label>
</div>
<div class="col-md-4"></div>
<div class="col-md-4">
 <input type="text"  name="Uncertainty"  class="form-control"/>
 <small class="text-white">Jak jestes nie pewny to zostaw puste pole</small>
</div>
</div>
</div>

<div class="container">
    <div class="row mt-5">
      <div class="col-md-12">
        <input type="submit" value="Zapisz" class="btn btn-block btn-secondary">
      </div> 
    </div>
    </div>
    
            
</form>


<?php

if($_POST)
{
  $resource_id = $_POST["ResourceID"];
  $factor_id = $_POST["FactorID"];
  $source_id = $_POST["SourceID"];
  $resource_unit_id = $_POST["UnitID"];
  $factor_unit_id = $_POST["FactorUnitID"];
  $factor = $_POST["Factor"];
  $uncertainty = $_POST["Uncertainty"];

  open_database();
  if ($uncertainty == "")
    $result = write_energy_factor($resource_id, $factor_id, $source_id, $resource_unit_id, $factor_unit_id, $factor);
  else
    $result = write_energy_factor($resource_id, $factor_id, $source_id, $resource_unit_id, $factor_unit_id, $factor, $uncertainty);
  close_database();	

  if (!$result)
    echo '<br><hr>Nie mogę zapisać współczynnika energetycznego!';
  else
    echo '<br><hr>Współczynnik energetyczny zapisany!';
}
?>
</div>
</body>
</html>