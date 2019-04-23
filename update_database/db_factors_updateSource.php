<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Edytuj źródło</title>
</head>
<body>

<h3>Edytuj źródło (np. dokument będący artykułem naukowym)</h3>
      
<form method="post" action="">

<?php
    require "db_update_functions.php";
    require "db_functions.php";
    open_database();
        $files = read_table("files.files");
    close_database();

    list($source_date, $source_description, $doi, $bibtex) = get_source();
?>

<p>
Data (yyyy-mm-dd): <input type="text"  name="Date" value="<?=$source_date?>"/>
</p>

<p>
Opis: <input type="text"  name="Desc" value="<?=$source_description?>"/>
</p>

<p>
DOI: <input type="text"  name="Doi" value="<?=$doi?>"/>
</p>

<p>
BIBTEX: <input type="text"  name="Bibtex" value="<?=$bibtex?>"/>
</p>

<p>
Plik: 
<select name="File">
<option value="0">(nie dotyczy)</option>
<?php
    open_database();
        foreach($files as $row_number => $row)
        {
            $folder = read_table("files.folders","where folder_id=".$row['folder_id']);
            echo '<option value="'.$row['file_id'].'">'.$row['file_name'].'
            (w folderze '.$folder[0]["folder_name"].')</option>';
        }
    close_database();
?>
</select>
</p>

<input type="submit" value="Zapisz">
            
</form>


<?php
    if($_POST)
    {
        $source_date = $_POST["Date"];
        $source_description = $_POST["Desc"];
        $doi = $_POST["Doi"];
        $bibtex = $_POST["Bibtex"];
        $file_id = $_POST["File"];

        open_database();
            $result = update_source($source_date, $source_description, $doi, $bibtex, $file_id);
        close_database();

        if (!$result)
            echo '<br><hr>Nie mogę zmienić źródła!';
        else
            echo '<br><hr>Źródło zmienione!';
    }
?>

</body>
</html>