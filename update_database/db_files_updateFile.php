<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj plik</title>
</head>
<body>

<h3>Edytuj plik</h3>
      
<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $folders = read_table("files.folders");
    close_database();

    list($file_name, $hdd_file_path) = get_file();
?>

<p>
Nazwa: <input type="text"  name="Name" value="<?=$file_name?>"/>
</p>

<p>
Typ: 
<select name="Type">
<option value="pdf">pdf</option>
<option value="xls">xls</option>
<option value="csv">csv</option>
<option value="doc">doc</option>
<option value="txt">txt</option>
<option value="png">png</option>
<option value="jpg">jpg</option>
</select>
</p>

<p>
Ścieżka na dysku: <input type="text"  name="Path" value="<?=$hdd_file_path?>"/>
</p>

<p>
Katalog (folder): 
<select name="FolderID">
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
    
</body>
</html>