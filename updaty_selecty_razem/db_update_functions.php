<?php

function console_log( $data )
{
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}


//----------- units: ----------------


function get_quantity_and_base_unit($quantity_id, $unit_id)
{
    open_database();
        $query1 = "select * from units.quantities where quantity_id=$quantity_id;";
        $result1 = pg_query($query1);

        $query2 = "select * from units.units where unit_id = $unit_id;";
        $result2 = pg_query($query2);
    close_database();
    $row1 = pg_fetch_array($result1);
    $row2 = pg_fetch_array($result2);

    return array($row1['quantity_name_pl'], $row1['quantity_name_eng'],
                 $row2['unit'], $row2['unit_full_name_pl'], $row2['unit_full_name_eng']);
}


function update_quantity_and_base_unit($quantity_id, $unit_id, $quantity_name_pl, $quantity_name_eng, $unit,
                                       $unit_full_name_pl, $unit_full_name_eng)
{
    $query1 = "update units.quantities 
                set (quantity_name_pl, quantity_name_eng, base_unit_id)=
                ('".$quantity_name_pl."','".$quantity_name_eng."', NULL)
                where quantity_id=$quantity_id;";

    //echo "DEBUG: ".$query1."<br>";

    if ($result = pg_query($query1))
        $quantity_id = 2;
    else
        return 0;

    $query2 = "update units.units set 
                (unit, unit_full_name_pl, unit_full_name_eng, quantity_id)=
                ('".$unit."', '".$unit_full_name_pl."',
                '".$unit_full_name_eng."', ".$quantity_id.")  where unit_id = $unit_id;";

    //echo "DEBUG: ".$query2."<br>";


    if ($result = pg_query($query2))
        return 1;
    else
        return 0;
}


function get_other_unit($unit_id)
{
    open_database();
        $query = "select * from units.units where unit_id = $unit_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['unit'], $row['unit_full_name_pl'],
                 $row['unit_full_name_eng'], $row['ratio']);
}

function update_other_unit($unit_id, $unit, $unit_full_name_pl, $unit_full_name_eng, $ratio, $quantity_id)
{
    $query = "update units.units set 
                (unit, unit_full_name_pl, unit_full_name_eng, ratio, quantity_id)=
                ('".$unit."', '".$unit_full_name_pl."',
                '".$unit_full_name_eng."', ".$ratio.", ".$quantity_id.")  
                where unit_id = $unit_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}


function update_source_unit_name($unit_variant, $unit_variant2, $unit_canonical_id)
{
    $query = "update units.source_unit_names set 
              (unit_variant, unit_canonical_id)= ('".$unit_variant2."', '".$unit_canonical_id."')
              where unit_variant = '$unit_variant';";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return $unit_canonical_id;
    else
        return 0;
}


//---------- files: -----------------

function get_folder($folder_id)
{
    open_database();
        $query = "select * from files.folders where folder_id = $folder_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['folder_name'], $row['folder_description_pl'],
                 $row['folder_description_eng'], $row['parent_folder_id']);
}


function update_folder($folder_id, $folder_name, $folder_description_pl,
                       $folder_description_eng, $parent_folder_id=0)
{
    if ($parent_folder_id==0)
        $query = "update files.folders set 
                (folder_name,folder_description_pl,folder_description_eng,parent_folder_id)=
                ('".$folder_name."','".$folder_description_pl."',
                '".$folder_description_eng."', NULL) where folder_id = $folder_id;";
    else
        $query = "update files.folders set 
                (folder_name,folder_description_pl,folder_description_eng,parent_folder_id)=
                ('".$folder_name."','".$folder_description_pl."',
                '".$folder_description_eng."',".$parent_folder_id.") where folder_id = $folder_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}

function get_file($file_id)
{
    open_database();
        $query = "select * from files.files where file_id = $file_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['file_name'], $row['hdd_file_path'], $row['file_type']);
}


function update_file($file_id, $file_name, $file_type, $hdd_file_path, $folder_id)
{
    $query = "update files.files set (file_name,file_type,hdd_file_path,folder_id)=
            ('".$file_name."','".$file_type."',
            '".$hdd_file_path."',".$folder_id.") where file_id=$file_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}


//---------- categories: -------------


function get_category($cat_id)
{
    open_database();
        $query = "select * from categories.categories where cat_id = $cat_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['cat_name_pl'], $row['cat_name_eng'],
                $row['cat_description_pl'], $row['cat_description_eng']);
}


function update_category($cat_name_pl, $cat_name_eng, $cat_description_pl, $cat_description_eng, $cat_id)
{
    $query = "update categories.categories set
            (cat_name_pl, cat_name_eng, cat_description_pl, cat_description_eng)=
            ('".$cat_name_pl."','".$cat_name_eng."',
            '".$cat_description_pl."','".$cat_description_eng."') where cat_id=$cat_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}


function update_hierarchy_of_categories($cat_id, $parent_id, $cat_id2, $parent_id2)
{
    $query = "update categories.hierarchy_of_categories set 
              (cat_id, parent_id)= ('".$cat_id2."', '".$parent_id2."')
              where cat_id = $cat_id and parent_id = $parent_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return $cat_id;
    else
        return 0;
}


//-------- attributes: ---------------

function get_attribute($attribute_id)
{
    open_database();
        $query = "select * from attributes.attributes where attribute_id = $attribute_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['attribute_name_pl'], $row['attribute_name_eng'],
                 $row['attribute_description_pl'], $row['attribute_description_eng'],
                 $row['type_id']);
}

function update_attribute($type_id, $attribute_name_pl, $attribute_name_eng,
                          $attribute_description_pl, $attribute_description_eng, $attribute_id)
{

    $query = "update attributes.attributes set
            (type_id, attribute_name_pl, attribute_name_eng,
            attribute_description_pl, attribute_description_eng)=
        ('".$type_id."','".$attribute_name_pl."','".$attribute_name_eng."',
            '".$attribute_description_pl."',
            '".$attribute_description_eng."') 
            where attribute_id=$attribute_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}

function get_attribute_enum($attribute_id, $attribute_value_pl)
{
    open_database();
    $query = "select * from attributes.attribute_enums where attribute_id=$attribute_id 
                                                        and attribute_value_pl='$attribute_value_pl';";
    $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['attribute_value_pl'], $row['attribute_value_eng'],
                 $row['attribute_value_description_pl'], $row['attribute_value_description_eng']);
}


function update_attribute_enum($attribute_id, $attribute_value_pl,
                               $attribute_id2, $attribute_value_pl2, $attribute_value_eng,
                               $attribute_value_description_pl, $attribute_value_description_eng)
{
//    echo "test";
    $query = "update attributes.attribute_enums set 
            (attribute_id,attribute_value_pl,attribute_value_eng,
            attribute_value_description_pl,attribute_value_description_eng)=
            ('".$attribute_id2."','".$attribute_value_pl2."',
            '".$attribute_value_eng."','".$attribute_value_description_pl."',
            '".$attribute_value_description_eng."') where attribute_id=$attribute_id 
                                                    and attribute_value_pl='$attribute_value_pl';";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}



function update_mandatory_attribute($cat_id, $attribute_id, $cat_id2, $attribute_id2)
{
    $query = "update attributes.mandatory_attributes set 
              (cat_id, attribute_id)= ('".$cat_id2."', '".$attribute_id2."')
              where cat_id = $cat_id and attribute_id = $attribute_id;";
    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return 1;
    else
        return 0;
}


//-------- factors: --------------

function get_factor_name($factor_id)
{
    open_database();
        $query = "select * from factors.factor_names where factor_id = '$factor_id';";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['factor_id'], $row['factor_name_pl'], $row['factor_name_eng'],
                 $row['factor_description_pl'], $row['factor_description_eng'] );
}


function update_factor_name($factor_id, $factor_id2, $factor_name_pl, $factor_name_eng,
                            $factor_description_pl, $factor_description_eng)
{
    $query = "update factors.factor_names set 
            (factor_id,factor_name_pl,factor_name_eng,factor_description_pl,factor_description_eng)=
            ('".$factor_id2."','".$factor_name_pl."',
            '".$factor_name_eng."','".$factor_description_pl."','".$factor_description_eng."')
            where factor_id = '$factor_id';";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return 1;
    else
        return 0;
}

function get_source($source_id)
{
    open_database();
        $query = "select * from factors.sources where source_id=$source_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['source_date'], $row['source_description'], $row['doi'],
                 $row['bibtex'], $row['file_id'] );
}

function update_source($source_id, $source_date, $source_description, $doi, $bibtex, $file_id=0)
{
    if ($file_id==0)
        $query = "update factors.sources set (source_date, source_description, doi, bibtex, file_id)=
                ('".$source_date."','".$source_description."','".$doi."','".$bibtex."',NULL) 
                where source_id = $source_id;";
    else
        $query = "update factors.sources set (source_date, source_description, doi, bibtex, file_id)=
                ('".$source_date."','".$source_description."',
                '".$doi."','".$bibtex."',".$file_id.") where source_id = $source_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}


function update_mandatory_factor($cat_id, $factor_id, $cat_id2, $factor_id2)
{
    $query = "update factors.mandatory_factors set 
              (cat_id, factor_id)= ('".$cat_id2."', '".$factor_id2."')
              where cat_id = $cat_id and factor_id = '$factor_id';";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return 1;
    else
        return 0;
}



//---------- resources: ----------------

function get_resource($resource_id)
{
    open_database();
        $query = "select * from resources.resources where resource_id=$resource_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['resource_name_pl'], $row['resource_name_eng'],
                 $row['resource_description_pl'], $row['resource_description_eng']);
}


function update_resource($resource_id, $resource_name_pl, $resource_name_eng,
                         $resource_description_pl, $resource_description_eng)
{
    $query = "update resources.resources set 
            (resource_name_pl, resource_name_eng, resource_description_pl, resource_description_eng)=
            ('".$resource_name_pl."','".$resource_name_eng."',
            '".$resource_description_pl."','".$resource_description_eng."') where resource_id=$resource_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}


function get_attribute_name_pl($attribute_id)
{
    open_database();
        $query = "select * from attributes.attributes where attribute_id = $attribute_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return $row['attribute_name_pl'];
}

function get_resource_name_pl($resource_id)
{
    open_database();
        $query = "select * from resources.resources where resource_id=$resource_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return $row['resource_name_pl'];
}

function get_resource_attribute($resource_id, $attribute_id)
{
    open_database();
        $query = "select * from resources.resources_attributes
                  where resource_id = $resource_id and attribute_id = $attribute_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return $row['attribute_value'];
}

function update_resource_attribute($resource_id, $attribute_id, $attribute_value)
{
    $query = "update resources.resources_attributes set attribute_value = '$attribute_value'
                         where resource_id = $resource_id and attribute_id = $attribute_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return 1;
    else
        return 0;
}


function get_factor($resource_id, $factor_id, $resource_unit_1_a_id)
{
    open_database();
        $query = "select * from resources.factors where 
                        resource_id = $resource_id and factor_id = '$factor_id' and 
                        resource_unit_1_id = $resource_unit_1_a_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['factor'], $row['uncertainty']);
}


function update_factor($resource_id, $factor_id, $resource_id2, $factor_id2, $source_id,
                       $resource_unit_1_a_id, $resource_unit_1_b_id, $resource_unit_2_id,
                       /* podaj 0 gdy chcesz NULL */
                       $factor_unit_id, $factor, $uncertainty=-1)
{
    if ($resource_unit_2_id != 0 && $uncertainty != -1) // czyli bez NULL-i
        $query = "update resources.factors set (resource_id,factor_id,source_id,resource_unit_1_id,".
                "resource_unit_2_id,factor_unit_id,factor,uncertainty)=
                (".$resource_id2.",'".$factor_id2."',".$source_id.",".$resource_unit_1_b_id.
                ",".$resource_unit_2_id.",".$factor_unit_id.",".$factor.",".$uncertainty.") where 
                        resource_id = $resource_id and factor_id = '$factor_id' and 
                        resource_unit_1_id = $resource_unit_1_a_id;";

    if ($resource_unit_2_id != 0 && $uncertainty == -1) // czyli uncertainty NULL
        $query = "update resources.factors set (resource_id,factor_id,source_id,resource_unit_1_id,".
                "resource_unit_2_id,factor_unit_id,factor,uncertainty)=
                (".$resource_id2.",'".$factor_id2."',".$source_id.",".$resource_unit_1_b_id.
                ",".$resource_unit_2_id.",".$factor_unit_id.",".$factor.",NULL) where 
                        resource_id = $resource_id and factor_id = '$factor_id' and 
                        resource_unit_1_id = $resource_unit_1_a_id;";

    if ($resource_unit_2_id == 0 && $uncertainty != -1) // czyli resource_unit_2_id NULL
        $query = "update resources.factors set 
                (resource_id,factor_id,source_id,resource_unit_1_id,".
                "resource_unit_2_id,factor_unit_id,factor,uncertainty)=
                (".$resource_id2.",'".$factor_id2."',".$source_id.",".$resource_unit_1_b_id.
                ",NULL,".$factor_unit_id.",".$factor.",".$uncertainty.") where 
                        resource_id = $resource_id and factor_id = '$factor_id' and 
                        resource_unit_1_id = $resource_unit_1_a_id;";

    if ($resource_unit_2_id == 0 && $uncertainty == -1) // czyli oba NULL-e
        $query = "update resources.factors set 
                (resource_id,factor_id,source_id,resource_unit_1_id,".
            "resource_unit_2_id,factor_unit_id,factor,uncertainty)=
            (".$resource_id2.",'".$factor_id2."',".$source_id.",".$resource_unit_1_b_id.
            ",NULL,".$factor_unit_id.",".$factor.",NULL) where 
                        resource_id = $resource_id and factor_id = '$factor_id' and 
                        resource_unit_1_id = $resource_unit_1_a_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return $factor_id;
    else
        return 0;
}


function get_category_name_pl($cat_id)
{
    open_database();
        $query = "select * from categories.categories where cat_id = $cat_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return $row['cat_name_pl'];
}


function update_resource_category($resource_id, $cat_id, $resource_id2, $cat_id2)
{
    $query = "update resources.resources_categories set 
              (resource_id, cat_id)= ('".$resource_id2."', '".$cat_id2."')
              where resource_id = $resource_id and cat_id = $cat_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return 1;
    else
        return 0;
}



//---------- energy_resources: ----------------

function get_energy_resource($resource_id)
{
    open_database();
        $query = "select * from energy_resources.energy_resources where resource_id=$resource_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['resource_name_pl'], $row['resource_name_eng'],
                 $row['gus_id'], $row['resource_description_pl'],
                 $row['resource_description_eng']);
}

function update_energy_resource($resource_name_pl, $resource_name_eng, $gus_id,
                                $resource_description_pl, $resource_description_eng, $resource_id)
{
    $query = "update energy_resources.energy_resources set ".
            "(resource_name_pl,resource_name_eng,gus_id,
             resource_description_pl,resource_description_eng)=
            ('".$resource_name_pl."','".$resource_name_eng."','".$gus_id.
            "','".$resource_description_pl."','".$resource_description_eng."')
             where resource_id=$resource_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if ($result = pg_query($query))
        return 1;
    else
        return 0;
}

function get_energy_resource_attribute($resource_id, $attribute_id)
{
    open_database();
        $query = "select * from energy_resources.resources_attributes
                  where resource_id = $resource_id and attribute_id = $attribute_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return $row['attribute_value'];
}

function update_energy_resource_attribute($resource_id, $attribute_id, $attribute_value)
{
    $query = "update energy_resources.resources_attributes set attribute_value = '$attribute_value' 
                         where resource_id = $resource_id and attribute_id = $attribute_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return $attribute_id;
    else
        return 0;
}

function get_energy_factor($resource_id, $factor_id, $resource_unit_id)
{
    open_database();
        $query = "select * from energy_resources.factors where resource_id=$resource_id and
                    factor_id='$factor_id' and resource_unit_id=$resource_unit_id;";
        $result = pg_query($query);
    close_database();
    $row = pg_fetch_array($result);

    return array($row['factor'], $row['uncertainty']);
}


function update_energy_factor($resource_id2, $factor_id2, $source_id, $resource_unit_id2,
                              $factor_unit_id, $factor, $resource_id, $factor_id, $resource_unit_id, $uncertainty=-1)
{
    if ($uncertainty != -1) // czyli bez NULL-a
        $query = "update energy_resources.factors set
                  (resource_id,factor_id,source_id,resource_unit_id,".
                "factor_unit_id,factor,uncertainty)=
                (".$resource_id2.",'".$factor_id2."',".$source_id.",".$resource_unit_id2.
                ",".$factor_unit_id.",".$factor.",".$uncertainty.") where resource_id=$resource_id and
                    factor_id='$factor_id' and resource_unit_id=$resource_unit_id;";
    else
        $query = "update energy_resources.factors set (resource_id,factor_id,source_id,resource_unit_id,".
                "factor_unit_id,factor,uncertainty)=
                (".$resource_id2.",'".$factor_id2."',".$source_id.",".$resource_unit_id2.
                ",".$factor_unit_id.",".$factor.",NULL) where resource_id=$resource_id and
                    factor_id='$factor_id' and resource_unit_id=$resource_unit_id;";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return $factor_id;
    else
        return 0;
}


function update_energy_resource_category($resource_id, $cat_id, $resource_id2, $cat_id2)
{
    $query = "update energy_resources.resources_categories set 
              (cat_id, resource_id)= ('".$cat_id2."', '".$resource_id2."')
              where cat_id = $cat_id and resource_id = '$resource_id';";

    //echo "DEBUG: ".$query."<br><br>";

    if (pg_query($query))
        return $cat_id;
    else
        return 0;
}

?>

