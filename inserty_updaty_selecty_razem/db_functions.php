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


function get_quantity_name_pl($quantity_id)  
{
  $query = "select quantity_name_pl from units.quantities where quantity_id = '".$quantity_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
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


function get_unit($unit_id)  
{
  $query = "select unit from units.units where unit_id = '".$unit_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
}

function get_canonical_unit_id($unit_variant)  
{
  $query = "select unit_canonical_id from units.source_unit_names where unit_variant = '".$unit_variant."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
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


function get_folder_id($folder_name)  
{
  $query = "select folder_id from files.folders where folder_name = '".$folder_name."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}

function get_folder_name($folder_id)  
{
  $query = "select folder_name from files.folders where folder_id = '".$folder_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
}


function get_file_id($folder_id, $file_name)  
{
  $query = "select file_id from files.files where file_name = '".$file_name."' and folder_id=".$folder_id;

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}

function get_file_name($file_id)  
{
  $query = "select file_name from files.files where file_id = ".$file_id;

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
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


function get_category_id($category_name_pl)  
{
  $query = "select cat_id from categories.categories where cat_name_pl = '".$category_name_pl."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}

function get_cat_name_pl($category_id)  
{
  $query = "select cat_name_pl from categories.categories where cat_id = '".$category_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
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


function get_attribute_id($attribute_name_pl)  
{
  $query = "select attribute_id from attributes.attributes where attribute_name_pl = '".$attribute_name_pl."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function get_attribute_id_eng($attribute_name_eng)  
{
  $query = "select attribute_id from attributes.attributes where attribute_name_eng = '".$attribute_name_eng."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function get_attr_name_pl($attribute_id)  
{
  $query = "select attribute_name_pl from attributes.attributes where attribute_id = '".$attribute_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
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


function get_factor_id($factor_name_pl)  
{
  $query = "select factor_id from factors.factor_names where factor_name_pl = '".$factor_name_pl."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
}

function get_factor_name_pl($factor_id)  
{
  $query = "select factor_name_pl from factors.factor_names where factor_id = '".$factor_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
}

function get_source_description($source_id)  
{
  $query = "select source_description from factors.sources where source_id = '".$source_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
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


function get_resource_id($name_pl)  
{
  $query = "select resource_id from resources.resources where resource_name_pl = '".$name_pl."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function get_res_name_pl($resource_id)  
{
  $query = "select resource_name_pl from resources.resources where resource_id = '".$resource_id."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
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


function get_energy_resource_id($name_pl)  
{
  $query = "select resource_id from energy_resources.energy_resources where resource_name_pl = '".$name_pl."'";

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}


function get_energy_resource_name_pl($energy_resource_id)  
{
  $query = "select resource_name_pl from energy_resources.energy_resources where resource_id = ".$energy_resource_id;

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";
}

function get_energy_resource_attribute_value($resource_id, $attribute_id)
{
  $query = "select attribute_value from energy_resources.resources_attributes where resource_id = ".$resource_id." and attribute_id = ".$attribute_id;

  //echo "DEBUG: ".$query."<br><br>";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return "";

}

//----------- read table: ----------------

function read_table($table_name, $where_clause="", $order_by="")
{
  $arr = array();

  $query = "select * from ".$table_name." ".$where_clause." ".$order_by;

  if ($result = pg_query($query))
    $arr = pg_fetch_all($result);

  return $arr;
}

function get_ratio($unit)  
{
  $query = "select ratio from units.units where unit = '".$unit."' or unit_full_name_pl = '".$unit."'  ";

  if ($result = pg_query($query))
  {
    $row = pg_fetch_row($result);
    return $row[0];
  }
  else
    return 0;
}
?>
