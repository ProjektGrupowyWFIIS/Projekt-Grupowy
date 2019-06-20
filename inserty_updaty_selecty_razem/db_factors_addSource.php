<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj źródło</title>
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
<h3 class="text-white text-center mt-3">Dodaj źródło (np. dokument będący artykułem naukowym)</h3>


<?php
require "db_functions.php";

$result=0;

if($_POST)
{
  $source_date = $_POST["Date"]; 
  $source_description = $_POST["Desc"]; 
  $doi = $_POST["Doi"]; 
  $bibtex = $_POST["Bibtex"]; 
  $file_id = $_POST["File"];

  open_database();
  $result = write_source($source_date, $source_description, $doi, $bibtex, $file_id);
  close_database();	

  if ($result)
  {
    unset ($_POST['Date']);
    unset ($_POST['Desc']);
    unset ($_POST['Doi']);
    unset ($_POST['Bibtex']);
    unset ($_POST['File']);
  }
}
?>

     
<div class="text-center">
<form method="post" action="">

<?php
open_database();
$files = read_table("files.files");
close_database();
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Data</label>
      </div>
    
      <div class="col-md-3">
        <input name="Date" type="date" class="form-control"  value="<?= isset($_POST['Date']) ? $_POST['Date'] : ''; ?>" required  />
          
      </div>
      <div class="col-md-3"></div>
      
    </div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Opis</label>
      </div>
     
      <div class="col-md-3">
        <input name="Desc" type="text" value="<?= isset($_POST['Desc']) ? $_POST['Desc'] : ''; ?>" class="form-control" />
          
      </div>
      <div class="col-md-3"></div>>
      
    </div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">DOI</label>
      </div>
   
      <div class="col-md-3">
        <input name="Doi" type="text" value="<?= isset($_POST['Doi']) ? $_POST['Doi'] : ''; ?>" class="form-control" />
          
      </div>
      <div class="col-md-3"></div>
      
    </div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Bibtex</label>
      </div>

      <div class="col-md-3">
        <input name="Bibtex" type="text" value="<?= isset($_POST['Bibtex']) ? $_POST['Bibtex'] : ''; ?>" class="form-control" />
          
      </div>
      <div class="col-md-3"></div>
      
    </div>
</div>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Plik (jeśli istnieje)</label>
      </div>

      <div class="col-md-3">

<select name="File" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<option value="0" <?php if(isset($_POST['File']) && $_POST['File']==0) echo 'selected="selected"';?> >(nie dotyczy)</option>
<?php
open_database();
foreach($files as $row_number => $row)
{
  $folder = read_table("files.folders","where folder_id=".$row['folder_id']);
  if($_POST['File']==$row['file_id'])
    echo '<option value="'.$row['file_id'].'" selected>'.$row['file_name'].' (w folderze '.$folder[0]["folder_name"].')</option>';
  else 
    echo '<option value="'.$row['file_id'].'">'.$row['file_name'].' (w folderze '.$folder[0]["folder_name"].')</option>';
}
close_database();
?>
</select>

       
      </div>
      <div class="col-md-3"></div>
      
    </div>
</div>
</select>

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

<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Źródło zapisane.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Źródło zapisane.</p>";
}
else
{
  if($_POST)
  {
    //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: DOI ".$doi." już istnieje!</span></center>";
    echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: DOI ".$doi." już istnieje!</p>";
  }
}
?>
</div>
</body>
</html>