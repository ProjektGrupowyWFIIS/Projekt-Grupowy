<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj plik</title>
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

<h3 class="text-white text-center mt-3">Edytuj plik</h3>

<div class="text-center">
    <form method="post" action="">


    <?php
    require "db_update_functions.php";
    require "db_functions.php";

    if($_GET)
    {
        $file_id = $_GET["FileID"];
        $temp_folder_id = $_GET["TempFolderID"];
    }

    open_database();
        $folders = read_table("files.folders");
    close_database();

    list($file_name, $hdd_file_path, $file_type) = get_file($file_id);
?>
        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">Nazwa</label>
                </div>
          
                <div class="col-md-3">
                    <input name="Name" type="text" class="form-control" value="<?=$file_name?>"/>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Typ:
                    </label>
                </div>
          
                <div class="col-md-3">
                    <select name="Type" class="form-control">
                            <option selected="selected"><?=$file_type?></option>
                            <?php
                                if($file_type != "pdf")
                                    echo '<option value="pdf">pdf</option>';
                                if($file_type != "xls")
                                    echo '<option value="xls">xls</option>';
                                if($file_type != "csv")
                                    echo '<option value="csv">csv</option>';
                                if($file_type != "doc")
                                    echo '<option value="doc">doc</option>';
                                if($file_type != "txt")
                                    echo '<option value="txt">txt</option>';
                                if($file_type != "png")
                                    echo '<option value="png">png</option>';
                                if($file_type != "pdf")
                                    echo '<option value="pdf">pdf</option>';
                                if($file_type != "jpg")
                                    echo '<option value="jpg">jpg</option>';
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
                    <label class="text-white ">Sciezka na dysku</label>
                </div>
                
                <div class="col-md-3">
                    <input name="Path" type="text" class="form-control" value="<?=$hdd_file_path?>"/>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Katalog (folder):
                    </label>
                </div>
              
                <div class="col-md-3">
                    <select name="FolderID" class="form-control">
                        <?php
                        foreach($folders as $row_number => $row){
                            if($row['folder_id'] == $temp_folder_id){
                                ?>
                                <option selected="selected" value="<?=$row['folder_id'];?>"><?=$row['folder_name'];?></option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="<?=$row['folder_id'];?>"><?=$row['folder_name'];?></option>
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
        <a href="db_files_showFile.php">
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
    if($_POST)
    {
        $file_name = $_POST["Name"];
        $file_type = $_POST["Type"];
        $hdd_file_path = $_POST["Path"];
        $folder_id = $_POST["FolderID"];

        open_database();
            $result = update_file($file_id, $file_name, $file_type, $hdd_file_path, $folder_id);
        close_database();

        if (!$result)
            echo "<br><p style='color: red;font-size:25px;'>Nie mogę zmienić pliku!</p>";
        else
            echo "<br><p style='color: green;font-size:25px;'>Plik zmieniony!</p>";
    }
?>    
</div>
</body>
</html>