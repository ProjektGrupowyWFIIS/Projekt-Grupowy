<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj folder</title>
</head>
<body>

<h3>Edytuj katalog (folder)</h3>


<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $folders = read_table("files.folders");
    close_database();

    list($folder_name, $folder_description_pl, $folder_description_eng,
         $parent_folder_id) = get_folder();
?>

<p>
Nazwa: <input type="text"  name="Name" value="<?=$folder_name?>"/>
</p>

<p>
Opis PL: <input type="text"  name="DescPL" value="<?=$folder_description_pl?>"/>
</p>

<p>
Opis ENG: <input type="text"  name="DescENG" value="<?=$folder_description_eng?>"/>
</p>

<p>
Katalog nadrzędny (jeśli istnieje): 
<select name="ParentID">
<option value="0">(nie dotyczy)</option>
<?php
foreach($folders as $row_number => $row){
?>
<option value="<?=$row['folder_id'];?>"><?=$row['folder_name'];?></option>
<?php
}
?>
</select>
</p>

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $folder_name            = $_POST["Name"];
        $folder_description_pl  = $_POST["DescPL"];
        $folder_description_eng = $_POST["DescENG"];
        $parent_folder_id       = $_POST["ParentID"];

        open_database();
            $result = update_folder($folder_name, $folder_description_pl,
                                    $folder_description_eng, $parent_folder_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić folderu!';
        else
            echo '<br><hr>Folder zmieniony!';
    }
?>

		
</body>
</html>