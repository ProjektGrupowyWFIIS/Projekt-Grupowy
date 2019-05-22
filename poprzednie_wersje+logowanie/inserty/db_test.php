<!DOCTYPE html>
<html lang="pl-PL"> 
<head>
<meta charset=UTF-8"/>
</head>
<body>

<?php
require "db_functions.php";

open_database() or die("Nie mogę otworzyć bazy danych");

echo "<hr><br>----test units----<br><br>\n";

  if ($id = write_quantity_and_base_unit('długość','length','m','metr','meter'))
    echo "Zapisano quantity/base_unit (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać quantity/base_unit.<br><br>\n";

  if ($otherid = write_other_unit('km','kilometr','kilometer', 1000.0, get_quantity_id('length')))
    echo "Zapisano other_unit (id = " . $otherid . ").<br><br>\n";
  else
    echo "Nie mogę zapisać other_unit.<br><br>\n";

  if (write_source_unit_name('mtr', get_unit_id('m')))
    echo "Zapisano source_unit.<br><br>\n";
  else
    echo "Nie mogę zapisać source_unit.<br><br>\n";


  //  już bez sprawdzania czy się udało:
  write_quantity_and_base_unit('masa','mass','kg','kilogram','kilogram');
  write_quantity_and_base_unit('pole powierzchni','surface area','m2','metr kwadratowy','square meter');
  write_quantity_and_base_unit('objętość','volume','m3','metr sześcienny','cubic meter');


echo "<hr><br>----test files----<br><br>\n";

  if ($id = write_folder('folder1','pl1','eng1'))
    echo "Zapisano folder (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać foldera.<br><br>\n";

  if ($id = write_folder('folder2','pl2','eng2', $id))
    echo "Zapisano folder (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać foldera.<br><br>\n";

  if ($id = write_file('file1','pdf','path1',$id))
    echo "Zapisano file (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać file.<br><br>\n";



echo "<hr><br>----test categories----<br><br>\n";

  if ($id1 = write_category('kat1','cat1','opis1','descr1'))
    echo "Zapisano category (id = " . $id1 . ").<br><br>\n";
  else
    echo "Nie mogę zapisać category.<br><br>\n";

  if ($id2 = write_category('kat2','cat2','opis2','descr2'))
    echo "Zapisano category (id = " . $id2 . ").<br><br>\n";
  else
    echo "Nie mogę zapisać category.<br><br>\n";

  if (write_hierarchy_of_categories($id1, $id2))
    echo "Zapisano hierarchy_of_categories.<br><br>\n";
  else
    echo "Nie mogę zapisać hierarchy_of_categories.<br><br>\n";


echo "<hr><br>----test attributes----<br><br>\n";

  if ($id = write_attribute('free','atr1','attr1','opis1','descr1'))
    echo "Zapisano attribute (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać attribute.<br><br>\n";


  if ($ide = write_attribute_enum($id,'atr1','attr1','opis1','descr1'))
    echo "Zapisano attribute enum (ide = " . $ide . ").<br><br>\n";
  else
    echo "Nie mogę zapisać attribute enum.<br><br>\n";


  if (write_mandatory_attribute(1, $id))
    echo "Zapisano mandatory_attribute.<br><br>\n";
  else
    echo "Nie mogę zapisać mandatory_attribute.<br><br>\n";



echo "<hr><br>----test factors----<br><br>\n";

  if ($id = write_factor_name('f','fnpl','fneng','opis1','descr1'))
    echo "Zapisano factor_name (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać factor_name.<br><br>\n";


  if ($id = write_source('2019-03-22','sd1','doi1','bibtex1'))
    echo "Zapisano source (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać source.<br><br>\n";

  if ($id = write_source('2019-03-24','sd2','doi2','bibtex2', 1))
    echo "Zapisano source (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać source.<br><br>\n";

  if (write_mandatory_factor(1, 'f'))
    echo "Zapisano mandatory_factor.<br><br>\n";
  else
    echo "Nie mogę zapisać mandatory_factor.<br><br>\n";



echo "<hr><br>----test resource----<br><br>\n";

  if ($id = write_resource('rpl','reng','opis1','descr1'))
    echo "Zapisano resource (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać resource.<br><br>\n";


  if ($ida = write_resource_attribute($id,1,'attr1'))
    echo "Zapisano resource_attribute (ida = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać resource_attribute.<br><br>\n";
/*
  if (write_factor(1, 'f',1,1,1,1,0.5,50))
    echo "Zapisano factor.<br><br>\n";
  else
    echo "Nie mogę zapisać factor.<br><br>\n";
*/
/*
  if (write_factor(1, 'f',1,1,0,1,0.5,50))
    echo "Zapisano factor.<br><br>\n";
  else
    echo "Nie mogę zapisać factor.<br><br>\n";
*/

/*
  if (write_factor(1, 'f',1,1,1,1,0.5))
    echo "Zapisano factor.<br><br>\n";
  else
    echo "Nie mogę zapisać factor.<br><br>\n";
*/
  if (write_factor(1, 'f',1,1,0,1,0.5))
    echo "Zapisano factor.<br><br>\n";
  else
    echo "Nie mogę zapisać factor.<br><br>\n";


  if (write_resource_category(1, 1))
    echo "Zapisano resource cat.<br><br>\n";
  else
    echo "Nie mogę zapisać resource cat.<br><br>\n";

echo "<hr><br>----test energy resource----<br><br>\n";

  if ($id = write_energy_resource('rpl','reng','gus','opis1','descr1'))
    echo "Zapisano energy resource (id = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać energy resource.<br><br>\n";


  if ($ida = write_energy_resource_attribute($id,1,'attr1'))
    echo "Zapisano energy_resource_attribute (ida = " . $id . ").<br><br>\n";
  else
    echo "Nie mogę zapisać energy_resource_attribute.<br><br>\n";
/*
  if (write_energy_factor(1, 'f',1,1,1,0.5,50))
    echo "Zapisano energy factor.<br><br>\n";
  else
    echo "Nie mogę zapisać energy factor.<br><br>\n";
*/

  if (write_energy_factor(1, 'f',1,1,1,0.5))
    echo "Zapisano energy factor.<br><br>\n";
  else
    echo "Nie mogę zapisać energy factor.<br><br>\n";


  if (write_energy_resource_category(1, 1))
    echo "Zapisano energy_resource cat.<br><br>\n";
  else
    echo "Nie mogę zapisać energy_resource cat.<br><br>\n";




echo "<hr><br>----test read quantities ----<br><br>\n";

$qarray = read_table("units.quantities");

echo "Quantities:<br>";
$all_q = read_table("units.quantities");
foreach($all_q as $row_number => $row)
{
  echo "quantity#".$row_number."  ->  ".$row['quantity_id']."  ".$row['quantity_name_pl']."  ".$row['quantity_name_eng']."  ".$row['base_unit_id']."<br>";
} 




echo "<hr><br>----test read units ----<br><br>\n";

echo "Units<br>";
$all_units = read_table("units.units");
foreach($all_units as $row_number => $row)
{
  echo "unit#".$row_number."  ->  ".$row['unit_id']."  ".$row['unit']."  ".$row['unit_full_name_eng']."  ".$row['ratio']."<br>";
} 


echo "<hr><br>----test read free attributes ----<br><br>\n";

echo "Free attributes<br>";
$attributes = read_table("attributes.attributes","where type_id='free'");
foreach($attributes as $row_number => $row)
{
  echo "attr#".$row_number."  ->  ".$row['attributes_id']."  ".$row['attribute_name_pl']."<br>";
} 


close_database();
?>

</body>
</html>
