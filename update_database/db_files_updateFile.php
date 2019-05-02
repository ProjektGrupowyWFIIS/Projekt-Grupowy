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
    open_database();
        $folders = read_table("files.folders");
    close_database();

    list($file_name, $hdd_file_path) = get_file();
?>

        <div class="container">
            <div class="row mt-5">

                <div class="col-md-4">
                    <label class="text-white ">Nazwa</label>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input name="Name" type="text" class="form-control" value="<?=$file_name?>"/>

                </div>

            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <label>
                        Typ:
                    </label>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <select name="Type" class="form-control">
                        <option value="pdf">pdf</option>
                        <option value="xls">xls</option>
                        <option value="csv">csv</option>
                        <option value="doc">doc</option>
                        <option value="txt">txt</option>
                        <option value="png">png</option>
                        <option value="jpg">jpg</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">

                <div class="col-md-4">
                    <label class="text-white ">Sciezka na dysku</label>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <input name="Path" type="text" class="form-control" value="<?=$hdd_file_path?>"/>

                </div>

            </div>
        </div>


        <div class="container">
            <div class="row mt-5">
                <div class="col-md-4">
                    <label>
                        Katalog (folder):
                    </label>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <select name="FolderID" class="form-control">
                        <?php
                        foreach($folders as $row_number => $row){
                            ?>
                            <option value="<?=$row['folder_id'];?>"><?=$row['folder_name'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Zapisz" class="btn btn-block btn-secondary mt-5">
                </div>
            </div>
        </div>
    </form>
		
    
<?php
    if($_POST)
    {
        $file_name = $_POST["Name"];
        $file_type = $_POST["Type"];
        $hdd_file_path = $_POST["Path"];
        $folder_id = $_POST["FolderID"];

        open_database();
            $result = update_file($file_name, $file_type, $hdd_file_path, $folder_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić pliku!';
        else
            echo '<br><hr>Plik zmieniony!';
    }
?>    
</div>
</body>
</html>