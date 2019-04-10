<?php

//----- open/close database: ----------


function open_database()
{
  if (!pg_pconnect("host='localhost' port='5432' user='postgres' password='password' dbname='ProjektGrupowy'"))
    return 0;
  else 
    return 1;
}


function close_database()
{
  pg_close();
}



//----------- units: ----------------


function write_quantity_and_base_unit($quantity_name_pl, $quantity_name_eng, $unit, $unit_full_name_pl, $unit_full_name_eng)
{
  $query1 = "insert into units.quantities (quantity_name_pl, quantity_name_eng, base_unit_id) ".
            "values('".$quantity_name_pl."','".$quantity_name_eng."', NULL)  returning quantity_id";

  //echo "DEBUG: ".$query1."<br>";

  if ($result = pg_query($query1))
  {
    $row = pg_fetch_row($result);
    $q_id = $row[0];
  }
  else
    return 0;

  $query2 = "insert into units.units (unit, unit_full_name_pl, unit_full_name_eng, ratio, quantity_id) ".
            "values('".$unit."', '".$unit_full_name_pl."','".$unit_full_name_eng."', 1.0, ".$q_id.")  returning unit_id";

  //echo "DEBUG: ".$query2."<br>";

  if ($result = pg_query($query2))
  {
    $row = pg_fetch_row($result);
    $u_id = $row[0];
  }
  else
  {
    pg_query("delete from units.quantities where quantity_id = ".$q_id);
    return 0;
  }

  $query3 = "update units.quantities set base_unit_id=".$u_id." where quantity_id=".$q_id;

  //echo "DEBUG: ".$query3."<br><br>";

  if (pg_query($query3))
    return $q_id;
  else
  {
    pg_query("delete from units.units where unit_id = ".$u_id);
    pg_query("delete from units.quantities where quantity_id = ".$q_id);
    return 0;
  }
}


function get_quantity_id($quantity_name_eng)  
{
  $query = "select quantity_id from units.quantities where quantity_name_eng = '".$quantity_name_eng."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function get_unit_id($unit)  
{
  $query = "select unit_id from units.units where unit = '".$unit."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_other_unit($unit, $unit_full_name_pl, $unit_full_name_eng, $ratio, $quantity_id)
{
  $query = "insert into units.units (unit, unit_full_name_pl, unit_full_name_eng, ratio, quantity_id) ".
           "values('".$unit."', '".$unit_full_name_pl."','".$unit_full_name_eng."', ".$ratio.", ".$quantity_id.")  returning unit_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_source_unit_name($source_unit_name, $canonical_unit_id)  
{
  $query = "insert into units.source_unit_names (unit_variant, unit_canonical_id) ".
           "values('".$source_unit_name."', ".$canonical_unit_id.")";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $canonical_unit_id;
  else
    return 0;
}


//---------- files: -----------------


function write_folder($folder_name, $folder_description_pl, $folder_description_eng, $parent_folder_id=0)
{
  if ($parent_folder_id==0)
    $query = "insert into files.folders (folder_name,folder_description_pl,folder_description_eng,parent_folder_id) ".
             "values('".$folder_name."','".$folder_description_pl."','".$folder_description_eng."', NULL) returning folder_id";
  else
    $query = "insert into files.folders (folder_name,folder_description_pl,folder_description_eng,parent_folder_id) ".
             "values('".$folder_name."','".$folder_description_pl."','".$folder_description_eng."',".$parent_folder_id.") returning folder_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_file($file_name, $file_type, $hdd_file_path, $folder_id) 
{
  $query = "insert into files.files (file_name,file_type,hdd_file_path,folder_id) ".
           "values('".$file_name."','".$file_type."','".$hdd_file_path."',".$folder_id.") returning file_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}



//---------- categories: -------------


function write_category($cat_name_pl, $cat_name_eng, $cat_description_pl, $cat_description_eng) 
{
  $query = "insert into categories.categories (cat_name_pl, cat_name_eng, cat_description_pl, cat_description_eng) ".
           "values('".$cat_name_pl."','".$cat_name_eng."','".$cat_description_pl."','".$cat_description_eng."') returning cat_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_hierarchy_of_categories($cat_id, $parent_id) 
{
  $query = "insert into categories.hierarchy_of_categories (cat_id, parent_id) ".
           "values(".$cat_id.",".$parent_id.")";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $cat_id;
  else
    return 0;
}



//-------- attributes: ---------------


function write_attribute($type_id, $attribute_name_pl, $attribute_name_eng, $attribute_description_pl, $attribute_description_eng) 
{
  $query = "insert into attributes.attributes (type_id, attribute_name_pl, attribute_name_eng, attribute_description_pl, attribute_description_eng) ".
           "values('".$type_id."','".$attribute_name_pl."','".$attribute_name_eng."','".$attribute_description_pl."','".$attribute_description_eng."') returning attribute_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_attribute_enum($attribute_id,$attribute_value_pl,$attribute_value_eng,$attribute_value_description_pl,$attribute_value_description_eng) 
{
  $query = "insert into attributes.attribute_enums (attribute_id,attribute_value_pl,attribute_value_eng,attribute_value_description_pl,attribute_value_description_eng) ".
           "values(".$attribute_id.",'".$attribute_value_pl."','".$attribute_value_eng."','".$attribute_value_description_pl."','".$attribute_value_description_eng."')";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $attribute_id;
  else
    return 0;
}


function write_mandatory_attribute($cat_id, $attribute_id) 
{
  $query = "insert into attributes.mandatory_attributes (cat_id, attribute_id) ".
           "values(".$cat_id.",".$attribute_id.")";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $attribute_id;
  else
    return 0;
}


//-------- factors: --------------


function write_factor_name($factor_id,$factor_name_pl,$factor_name_eng,$factor_description_pl,$factor_description_eng) 
{
  $query = "insert into factors.factor_names (factor_id,factor_name_pl,factor_name_eng,factor_description_pl,factor_description_eng) ".
           "values('".$factor_id."','".$factor_name_pl."','".$factor_name_eng."','".$factor_description_pl."','".$factor_description_eng."')";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $factor_id;
  else
    return 0;
}


function write_source($source_date, $source_description, $doi, $bibtex, $file_id=0) 
{
  if ($file_id==0)
    $query = "insert into factors.sources (source_date,source_description,doi,bibtex,file_id) ".
             "values('".$source_date."','".$source_description."','".$doi."','".$bibtex."',NULL) returning source_id";
  else
    $query = "insert into factors.sources (source_date,source_description,doi,bibtex,file_id) ".
             "values('".$source_date."','".$source_description."','".$doi."','".$bibtex."',".$file_id.") returning source_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_mandatory_factor($cat_id, $factor_id) 
{
  $query = "insert into factors.mandatory_factors (cat_id,factor_id) ".
           "values('".$cat_id."','".$factor_id."')";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $factor_id;
  else
    return 0;
}



//---------- resources: ----------------


function write_resource($resource_name_pl,$resource_name_eng,$resource_description_pl,$resource_description_eng) 
{
  $query = "insert into resources.resources (resource_name_pl,resource_name_eng,resource_description_pl,resource_description_eng) ".
           "values('".$resource_name_pl."','".$resource_name_eng."','".$resource_description_pl."','".$resource_description_eng."') returning resource_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_resource_attribute($resource_id, $attribute_id, $attribute_value) 
{
  $query = "insert into resources.resources_attributes (resource_id,attribute_id,attribute_value) ".
           "values(".$resource_id.",".$attribute_id.",'".$attribute_value."')";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $attribute_id;
  else
    return 0;
}


function write_factor($resource_id, $factor_id, $source_id, $resource_unit_1_id, 
                      $resource_unit_2_id, /* podaj 0 gdy chcesz NULL */
                      $factor_unit_id, $factor, $uncertainty=-1) 
{
  if ($resource_unit_2_id != 0 && $uncertainty != -1) // czyli bez NULL-i
    $query = "insert into resources.factors (resource_id,factor_id,source_id,resource_unit_1_id,".
                                            "resource_unit_2_id,factor_unit_id,factor,uncertainty) ".
             "values(".$resource_id.",'".$factor_id."',".$source_id.",".$resource_unit_1_id.
                     ",".$resource_unit_2_id.",".$factor_unit_id.",".$factor.",".$uncertainty.")";

  if ($resource_unit_2_id != 0 && $uncertainty == -1) // czyli uncertainty NULL
    $query = "insert into resources.factors (resource_id,factor_id,source_id,resource_unit_1_id,".
                                            "resource_unit_2_id,factor_unit_id,factor,uncertainty) ".
             "values(".$resource_id.",'".$factor_id."',".$source_id.",".$resource_unit_1_id.
                     ",".$resource_unit_2_id.",".$factor_unit_id.",".$factor.",NULL)";

  if ($resource_unit_2_id == 0 && $uncertainty != -1) // czyli resource_unit_2_id NULL
    $query = "insert into resources.factors (resource_id,factor_id,source_id,resource_unit_1_id,".
                                            "resource_unit_2_id,factor_unit_id,factor,uncertainty) ".
             "values(".$resource_id.",'".$factor_id."',".$source_id.",".$resource_unit_1_id.
                     ",NULL,".$factor_unit_id.",".$factor.",".$uncertainty.")";

  if ($resource_unit_2_id == 0 && $uncertainty == -1) // czyli oba NULL-e
    $query = "insert into resources.factors (resource_id,factor_id,source_id,resource_unit_1_id,".
                                            "resource_unit_2_id,factor_unit_id,factor,uncertainty) ".
             "values(".$resource_id.",'".$factor_id."',".$source_id.",".$resource_unit_1_id.
                     ",NULL,".$factor_unit_id.",".$factor.",NULL)";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $factor_id;
  else
    return 0;
}


function write_resource_category($resource_id, $cat_id) 
{
  $query = "insert into resources.resources_categories (resource_id,cat_id) ".
           "values(".$resource_id.",".$cat_id.")";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $cat_id;
  else
    return 0;
}



//---------- energy_resources: ----------------


function write_energy_resource($resource_name_pl,$resource_name_eng,$gus_id,$resource_description_pl,$resource_description_eng) 
{
  $query = "insert into energy_resources.energy_resources ".
           "(resource_name_pl,resource_name_eng,gus_id,resource_description_pl,resource_description_eng) ".
           "values('".$resource_name_pl."','".$resource_name_eng."','".$gus_id.
                   "','".$resource_description_pl."','".$resource_description_eng."') returning resource_id";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function write_energy_resource_attribute($resource_id, $attribute_id, $attribute_value) 
{
  $query = "insert into energy_resources.resources_attributes (resource_id,attribute_id,attribute_value) ".
           "values('".$resource_id."','".$attribute_id."','".$attribute_value."')";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $attribute_id;
  else
    return 0;
}


function write_energy_factor($resource_id, $factor_id, $source_id, $resource_unit_id, 
                             $factor_unit_id, $factor, $uncertainty=-1) 
{
  if ($uncertainty != -1) // czyli bez NULL-a
    $query = "insert into energy_resources.factors (resource_id,factor_id,source_id,resource_unit_id,".
                                                   "factor_unit_id,factor,uncertainty) ".
             "values(".$resource_id.",'".$factor_id."',".$source_id.",".$resource_unit_id.
                     ",".$factor_unit_id.",".$factor.",".$uncertainty.")";
  else
    $query = "insert into energy_resources.factors (resource_id,factor_id,source_id,resource_unit_id,".
                                                   "factor_unit_id,factor,uncertainty) ".
             "values(".$resource_id.",'".$factor_id."',".$source_id.",".$resource_unit_id.
                     ",".$factor_unit_id.",".$factor.",NULL)";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $factor_id;
  else
    return 0;
}


function write_energy_resource_category($resource_id, $cat_id) 
{
  $query = "insert into energy_resources.resources_categories (resource_id,cat_id) ".
           "values(".$resource_id.",".$cat_id.")";

  //echo "DEBUG: ".$query."<br><br>";

  if (pg_query($query))
    return $cat_id;
  else
    return 0;
}


//----------- read table: ----------------

function read_table($table_name, $where_clause="")
{
  $arr = array();

  $query = "select * from ".$table_name." ".$where_clause;

  if ($result = pg_query($query))
    $arr = pg_fetch_all($result);

  return $arr;
}

?>
