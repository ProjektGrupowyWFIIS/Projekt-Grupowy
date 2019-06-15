<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Edytuj folder</title>
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

<h3 class="text-white text-center mt-3">Edytuj katalog (folder)</h3>

<div class="text-center">
    <form method="post" action="">
    <?php
        require "db_update_functions.php";
        require "db_functions.php";
        if($_GET)
        {
            $folder_id = $_GET["FolderID"];
        }
        open_database();
            $folders = read_table("files.folders");
        close_database();

        list($folder_name, $folder_description_pl, $folder_description_eng,
             $parent_folder_id) = get_folder($folder_id);
    ?>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="text-white ">Nazwa </label>
                </div>
               
                <div class="col-md-3">
                    <input name="Name" type="text" class="form-control" value="<?=$folder_name?>" required/>
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
                    <input name="DescPL" type="text" class="form-control" value="<?=$folder_description_pl?>" required/>
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
                    <input name="DescENG" type="text" class="form-control" value="<?=$folder_description_eng?>" required/>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label>
                        Katalog nadrzędny (jeśli istnieje):
                    </label>
                </div>
      
                <div class="col-md-3">
                    <select name="ParentID" class="form-control">
                        <option value="0">(nie dotyczy)</option>
                        <?php
                        foreach($folders as $row_number => $row){
                            if($row['folder_id'] == $folder_id){
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
        <a href="db_files_showFolder.php">
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
        $folder_name            = $_POST["Name"];
        $folder_description_pl  = $_POST["DescPL"];
        $folder_description_eng = $_POST["DescENG"];
        $parent_folder_id       = $_POST["ParentID"];

        open_database();
            $result = update_folder($folder_id, $folder_name, $folder_description_pl,
                                    $folder_description_eng, $parent_folder_id);
        close_database();

        if ($result)
            echo "<br><h4><center><span style='color: white; background-color: black'>Folder ".$folder_name." zmieniony.</span></center></h4>";
        else
        {
            if($_POST)
            {
                open_database();
                $result = get_folder_id($folder_name);
                if ($result)
                    echo "<br><h4><center><span style='color: red; background-color: black'>Edycja nieudana: Folder ".$folder_name." już istnieje!</span></center></h4>";
                else
                    echo "<br><h4><center><span style='color: red; background-color: black'>Z nieznanego powodu nie mogę zmienić folderu!</span></center></h4>";
                close_database();
            }
        }
    }
?>

</div>
</body>
</html>