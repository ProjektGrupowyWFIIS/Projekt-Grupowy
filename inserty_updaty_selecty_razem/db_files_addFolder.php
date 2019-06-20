<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dodaj folder</title>
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

<h3 class="text-white text-center mt-3">Dodaj katalog (folder)</h3>


<?php
require "db_functions.php";

$result=0;

if($_POST)
{
  $folder_name            = $_POST["Name"];
  $folder_description_pl  = $_POST["DescPL"];
  $folder_description_eng = $_POST["DescENG"];
  $parent_folder_id       = $_POST["ParentID"];

  open_database();
  $result = write_folder($folder_name, $folder_description_pl, $folder_description_eng, $parent_folder_id);
  close_database();	

  if ($result)
  {
    unset ($_POST['Name']);
    unset ($_POST['DescPL']);
    unset ($_POST['DescENG']);
    unset ($_POST['ParentID']);
  }
}
?>




<div class="text-center">
<form method="post" action="">

<?php
open_database();
$folders = read_table("files.folders");
close_database();
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3"></div>
      <div class="col-md-3">
        <label class="text-white ">Nazwa </label>
      </div>
     
      <div class="col-md-3">
        <input name="Name" type="text" value="<?= isset($_POST['Name']) ? $_POST['Name'] : ''; ?>" class="form-control" required />
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
        <input name="DescPL" type="text" value="<?= isset($_POST['DescPL']) ? $_POST['DescPL'] : ''; ?>" class="form-control"  />
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
        <input name="DescENG" type="text" value="<?= isset($_POST['DescENG']) ? $_POST['DescENG'] : ''; ?>" class="form-control"  />
      </div>
      <div class="col-md-3"></div>
    </div>
</div>


<div class="container">
  <div class="row mt-5">
      <div class="col-md-3"></div>
    <div class="col-md-3">
<label>
Katalog nadrzędnyy (jeśli istnieje):
</label>
</div>

<div class="col-md-3">
<select name="ParentID" class="form-control" required>
<option value="" disabled selected >wybierz</option>
<option value="0" <?php if(isset($_POST['ParentID']) && $_POST['ParentID']==0) echo 'selected="selected"';?> >(nie dotyczy)</option>
<?php
foreach($folders as $row_number => $row){
?>
<option value="<?=$row['folder_id'];?>" <?php if($_POST['ParentID']==$row['folder_id']) echo 'selected="selected"';?> ><?=$row['folder_name'];?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3"></div>
</div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
      <div class="col-md-6">
  <input type="submit" value="Zapisz" class="btn btn-block btn-success mt-5">
  </div>
  </div>
  </div>
</form>
            
</form>


<?php
if ($result)
{
  //echo "<br><h4><center><span style='color: white; background-color: black'>Folder ".$folder_name." zapisany.</span></center></h4>";
  echo "<br><p style='color: green;font-size:25px;'>Folder ".$folder_name." zapisany.</p>";
}
else
{
  if($_POST)
  {
    open_database();
    $result = get_folder_id($folder_name);
    if ($result)
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Zapis nieudany: Folder ".$folder_name." już istnieje!</span></center>";
      echo "<br><p style='color: red;font-size:25px;'>Zapis nieudany: Folder ".$folder_name." już istnieje!</p>";
    }
    else
    {
      //echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zapisać folderu!</span></center></h4>";
      echo "<br><p style='color: red;font-size:25px;'>Z nieznanego powodu nie mogę zapisać folderu!</p>";
    }
    close_database();	
  }
}
?>

</div>
</body>
</html>