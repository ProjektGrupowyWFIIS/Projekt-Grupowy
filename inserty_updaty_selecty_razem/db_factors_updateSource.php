<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj źródło</title>
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
require "db_functions.php";
require "db_update_functions.php";

$result=0;

if($_GET)
{
    $source_id = $_GET["SourceID"];
    $temp_file_id = $_GET["TempFileID"];

    open_database();
        $files = read_table("files.files");
    close_database();

    list($source_date, $source_description, $doi, $bibtex) = get_source($source_id);
}


if($_POST)
{
  $source_date = $_POST["Date"];
  $source_description = $_POST["Desc"];
  $doi = $_POST["Doi"];
  $bibtex = $_POST["Bibtex"];
  $file_id = $_POST["File"];

  open_database();
      $result = update_source($source_id, $source_date, $source_description, $doi, $bibtex, $file_id);
  close_database();

  $temp_file_id = $file_id;

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



<h3 class="text-white text-center mt-3">Edytuj źródło (np. dokument będący artykułem naukowym)</h3>

<div class="text-center">
    <form method="post" action="">
        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">Data (rrrr-mm-dd)</label>
                </div>
             
                <div class="col-md-3">
                    <input name="Date" type="date" class="form-control" value="<?=$source_date?>" required/>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">Opis</label>
                </div>
              
                <div class="col-md-3">
                    <input name="Desc" type="text" class="form-control" value="<?=$source_description?>" required/>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">DOI</label>
                </div>
              
                <div class="col-md-3">
                    <input name="Doi" type="text" class="form-control" value="<?=$doi?>" />
                </div>
                <div class="col-md-3"></div>

            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">BIBTEX</label>
                </div>
        
                <div class="col-md-3">
                    <input name="Bibtex" type="text" class="form-control" value="<?=$bibtex?>" />
                </div>
                <div class="col-md-3"></div>

            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">Plik</label>
                </div>
       
                <div class="col-md-3">
                    <select name="File">
                        <?php
                        open_database();
                        foreach($files as $row_number => $row){
                            if($row['file_id'] == $temp_file_id){
                                $folder = read_table("files.folders","where folder_id=".$row['folder_id']);
                                echo '<option selected="selected" value="'.$row['file_id'].'">'.$row['file_name'].
                                    ' (w folderze '.$folder[0]["folder_name"].')</option>';
                            }
                            else{
                                $folder = read_table("files.folders","where folder_id=".$row['folder_id']);
                                echo '<option value="'.$row['file_id'].'">'.$row['file_name'].
                                    ' (w folderze '.$folder[0]["folder_name"].')</option>';
                            }
                        }
                        close_database();
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
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>

    <div class="container">
        <a href="db_factors_showSource.php">
            <div class="row mt-3">
                    <div class="col-md-3"></div>
                <div class="col-md-6">
                    <input type="button" value="wróć" class="btn btn-block btn-primary mt-3">
                </div>
                <div class="col-md-3"></div>
            </div>
        </a>
    </div>

<?php

if ($result)
  echo "<br><h4><center><span style='color: white; background-color: black'>Źródło zmienione!</span></center></h4>";
else
{
  if($_POST)
  {
    echo "<br><h4><center><span style='color: red; background-color: black'>Nie mogę zmienić źródła!</span></center></h4>";
  }
}
?>
</div>
</body>
</html>