﻿<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">

<body>

<?php
 
$jsondata = file_get_contents("biostrateg_modul_analityczny_in.json");
$json = json_decode($jsondata, true);
 
require "db_functions.php";
open_database();
 
$output2 = "<ul><ul>";
$output2 .= "<h3>Produkty</h3>";
 
foreach ($json['products'] as $products) {
    $amountOfAllProds = $amountOfAllProds + $products['ammount'];
    $numres = sizeof($products['resources']);
    for ($r = 0; $r < $numres; $r++) {
        $resId[] = $products['resources'][$r];
    }
    $numeres = sizeof($products['energy_resources']);
    for ($e = 0; $e < $numeres; $e++) {
        $eresId[] = $products['energy_resources'][$e];
    }
}
foreach (array_count_values($resId) as $key => $value) {
    if ($value > 1)
        $moreThanOneRes[] = $key;
}
 
foreach (array_count_values($eresId) as $key => $value) {
    if ($value > 1)
        $moreThanOneERes[] = $key;
}
 
$fp = fopen('out.json', 'w');
$output2 .= "<li>___________________________</li>";
 
 
 
foreach ($json['products'] as &$products) {
    $output2 .= "<li>ID produktu:  " . $products['prod_id'] . "</li>";
    $output2 .= "<li>Nazwa:  " . $products['name'] . "</li>";
    $output2 .= "<li>Jednostkaa:  " . $products['unit'] . "</li>";
    $output2 .= "<li>Ilość:  " . $products['ammount'] . "</li>";
    $proc = ($products['ammount'] / $amountOfAllProds) * 100;
 
    $output2 .= "<li>" . round($proc, 2) . " % / products</li>";
    $num = sizeof($products['resources']);
 
 
 
    for ($i = $num-1; $i >=0; $i--) {
        $id = $products['resources'][$i];
        unset($products['resources'][$i]);
       
        foreach ($json['resources'] as $resources) {
            if ($id == $resources['res_id'])
            {
 
                $output2 .= "<li>" . $flag . "</li>";
                $output2 .= "<li>SUROWIEC</li>";
                $output2 .= "<li>ID:  " . $resources['res_id'] . "</li>";
                $output2 .= "<li>Jednostka:  " . $resources['unit'] . "</li>";
                $output2 .= "<li>Ilość:  " . $resources['ammount'] . "</li>";
                $unit = get_ratio($resources['unit']);
                if (in_array($id, $moreThanOneRes)) {
                    $proc = $proc / 100;
                    $eqco2OfRes[$nu] = round(($resources['ammount'] * $proc) * $unit * 1, 2);
                } else
                    $eqco2OfRes[$nu] = $resources['ammount'] * $unit * 1;
                $resources['eqco2']=$eqco2OfRes[$nu];
                $output2 .= "<li>eqco2:  " . $eqco2OfRes[$nu] . "</li>";
                $total_eqco2 += $eqco2OfRes[$nu];
                array_push($products['resources'], $resources);
 
                $nu = $nu + 1;
            }
 
 
            $resources[] = array(
                'energy_resources' => array(
                    'res_id' => $energy_resources['res_id'],
                    'name' => $energy_resources['name'],
                    'unit' => $energy_resources['unit'],
                    'ammount' => $energy_resources['ammount']
                )
            );
        }
 
        $output2 .= "<li></li>";
    }
 
    $num2 = sizeof($products['energy_resources']);
    for ($i = $num2-1; $i >= 0; $i--) {
        $id = $products['energy_resources'][$i];
        unset($products['energy_resources'][$i]);
 
        foreach ($json['energy_resources'] as $energy_resources) {
            if ($id == $energy_resources['gus'])
            {
 
                $output2 .= "<li></li>";
                $output2 .= "<li>SUROWIEC ENERGETYCZNY</li>";
                $output2 .= "<li>ID:  " . $energy_resources['gus'] . "</li>";
                $output2 .= "<li>Jednostka:  " . $energy_resources['unit'] . "</li>";
                $output2 .= "<li>Ilość:  " . $energy_resources['ammount'] . "</li>";
                $unit = get_ratio($energy_resources['unit']);
                if (in_array($id, $moreThanOneERes)) {
                    $proc = $proc / 100;
                    $eqco2OfRes[$nu] = round(($resources['ammount'] * $proc) * $unit * 1, 2);
                } else
                    $eqco2OfRes[$nu] = $energy_resources['ammount'] * $unit * 1;
                $energy_resources['eqco2']=$eqco2OfRes[$nu];
 
                $output2 .= "<li>eqco2:  " . $eqco2OfRes[$nu] . "</li>";
                $total_eqco2 += $eqco2OfRes[$nu];
                array_push($products['energy_resources'], $energy_resources);
 
                $nu = $nu + 1;
            }
        }
        $output2 .= "<li></li>";
    }
 
    $products['total_eqco2']=$total_eqco2;
 
    $output2 .= "<li>total_eqco2:  " . $total_eqco2 . "</li>";
    $eqco2_per_unit = $total_eqco2 / $products['ammount'];
    $products['eqco2_per_unit']= $eqco2_per_unit ;
 
    $output2 .= "<li>eqco2_per_unit:  " . round($eqco2_per_unit, 2) . "</li>";
    $output2 .= "<li>___________________________</li>";
 
 
    $pro[] = $a;
 
 
    $total_eqco2 = 0;
}
 
print_r($pro);
 
fwrite($fp, json_encode($json,JSON_UNESCAPED_UNICODE));
exit();
foreach ($json['energy_resources'] as $energy_resources) {
    $energy[] = array(
        'energy_resources' => array(
            'gus' => $energy_resources['gus'],
            'name' => $energy_resources['name'],
            'unit' => $energy_resources['unit'],
            'ammount' => $energy_resources['ammount']
        )
    );
 
    fwrite($fp, json_encode($energy, JSON_UNESCAPED_UNICODE));
    $output .= "<li>Numer GUS:  " . $energy_resources['gus'] . "</li>";
    $output .= "<li>Nazwa:  " . $energy_resources['name'] . "</li>";
    $output .= "<li>Jednostka:  " . $energy_resources['unit'] . "</li>";
    $output .= "<li>Ilość:  " . $energy_resources['ammount'] . "</li>";
}
 
 
 
 
fclose($fp);
 
 
foreach ($json['resources'] as $resources) {
    $res[] = array(
        'resources'  => array(
            'res_id' => $resources['res_id'],
            'name' => $resources['name'],
            'unit' => $resources['unit'],
            'ammount' => $resources['ammount']
        )
    );
 
    fwrite($fp, json_encode($res, JSON_UNESCAPED_UNICODE));
    $output .= "<li>Numer ID:  " . $resources['res_id'] . "</li>";
    $output .= "<li>Nazwa:  " . $resources['name'] . "</li>";
    $output .= "<li>Jednostka:  " . $resources['unit'] . "</li>";
    $output .= "<li>Ilość:  " . $resources['ammount'] . "</li>";
}
 
fclose($fp);
 
 
 
 
 
 
 
 
 
 
 
echo $output2;
 
close_database();
echo "<br>";

?>
</body>
</head>
</html>