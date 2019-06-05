<!DOCTYPE html>
<html>
<head><meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>

<?php
 
$jsondata = file_get_contents("biostrateg_modul_analityczny_in.json");
$json = json_decode($jsondata, true);
 
require "db_functions.php";
open_database();
 
$output2 = "<ul><ul>";
$output2 .= "<h3>Produkty</h3>";
 echo "<table border = \"2\" cellpading= \"10\" cellspacing=\"5\" color = \"black\">";
	
	
foreach ($json['products'] as $products) {
    $amountOfAllProds = $amountOfAllProds + $products['ammount'];
    $numres = sizeof($products['resources']); //ilosc produktow
    for ($r = 0; $r < $numres; $r++) {
        $resId[] = $products['resources'][$r];
    }
    $numeres = sizeof($products['energy_resources']); //ilosc produktow
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
 
$fp = fopen('out.json', 'w'); /////////////////////////////////
//$output2 .= "___________________________";
 
 
 
foreach ($json['products'] as &$products) {
    $output2 .= "<li>ID produktu:  " . $products['prod_id'] . "</li>";
    $output2 .= "<li>Nazwa:  " . $products['name'] . "</li>";
    $output2 .= "<li>Jednostkaa:  " . $products['unit'] . "</li>";
    $output2 .= "<li>Ilość:  " . $products['ammount'] . "</li>";
    $proc = ($products['ammount'] / $amountOfAllProds) * 100; //procenty kazdego
 
    $output2 .= "<li>" . round($proc, 2) . " % / products</li>";
    $num = sizeof($products['resources']); //ilosc produktow
 
 
 
    for ($i = $num-1; $i >=0; $i--) {
        $id = $products['resources'][$i]; //id dla ktorego sprawdzamy i liczymy
        unset($products['resources'][$i]);
       
        foreach ($json['resources'] as $resources) {
            if ($id == $resources['res_id']) //szukamy tego samego id jak nie to olewamy, nie liczymy, glupie max ale dziala
            {
 
                $output2 .= "<br>" . $flag . "</br>";
                $output2 .= "<li>SUROWIEC</li>";
                $output2 .= "<li>ID:  " . $resources['res_id'] . "</li>";
                $output2 .= "<li>Jednostka:  " . $resources['unit'] . "</li>";
                $output2 .= "<li>Ilość:  " . $resources['ammount'] . "</li>";
                $unit = get_ratio($resources['unit']);
                if (in_array($id, $moreThanOneRes)) {
                    $proc = $proc / 100;
                    $eqco2OfRes[$nu] = round(($resources['ammount'] * $proc) * $unit * 1, 2); //dodac co2
                } else
                    $eqco2OfRes[$nu] = $resources['ammount'] * $unit * 1; //dodac co2
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
 
        $output2 .= "<br></br>";
    }
 
    $num2 = sizeof($products['energy_resources']); //ilosc produktow
    for ($i = $num2-1; $i >= 0; $i--) {
        $id = $products['energy_resources'][$i]; //id dla ktorego sprawdzamy i liczymy
        unset($products['energy_resources'][$i]);
 
        foreach ($json['energy_resources'] as $energy_resources) {
            if ($id == $energy_resources['gus']) //szukamy tego samego id jak nie to olewamy, nie liczymy
            {
 
                $output2 .= "<br></br>";
                $output2 .= "<li>SUROWIEC ENERGETYCZNY</li>";
                $output2 .= "<li>ID:  " . $energy_resources['gus'] . "</li>";
                $output2 .= "<li>Jednostka:  " . $energy_resources['unit'] . "</li>";
                $output2 .= "<li>Ilość:  " . $energy_resources['ammount'] . "</li>";
                $unit = get_ratio($energy_resources['unit']);
                if (in_array($id, $moreThanOneERes)) {
                    $proc = $proc / 100;
                    $eqco2OfRes[$nu] = round(($resources['ammount'] * $proc) * $unit * 1, 2); //dodac co2
                } else
                    $eqco2OfRes[$nu] = $energy_resources['ammount'] * $unit * 1; //dodac co2
                $energy_resources['eqco2']=$eqco2OfRes[$nu];
 
                $output2 .= "<li>eqco2:  " . $eqco2OfRes[$nu] . "</li>";
                $total_eqco2 += $eqco2OfRes[$nu];
                array_push($products['energy_resources'], $energy_resources);
 
                $nu = $nu + 1;
            }
        }
        $output2 .= "<br></br>";
    }
 
    $products['total_eqco2']=$total_eqco2;
 
    $output2 .= "<li>total_eqco2:  " . $total_eqco2 . "</li>";
    $eqco2_per_unit = $total_eqco2 / $products['ammount'];
    $products['eqco2_per_unit']= $eqco2_per_unit ;
 
    $output2 .= "<li>eqco2_per_unit:  " . round($eqco2_per_unit, 2) . "</li>";
   // $output2 .= "<br>___________________________</br>";
 
 
    $pro[] = $a;
 
 
    $total_eqco2 = 0;
}
 
//print_r($pro);
 
fwrite($fp, json_encode($json,JSON_UNESCAPED_UNICODE));

echo $output2;

exit();
foreach ($json['energy_resources'] as $energy_resources) { ////////////////////////////////////////
    $energy[] = array(
        'energy_resources' => array(
            'gus' => $energy_resources['gus'],
            'name' => $energy_resources['name'],
            'unit' => $energy_resources['unit'],
            'ammount' => $energy_resources['ammount']
        )
    );
 
    fwrite($fp, json_encode($energy, JSON_UNESCAPED_UNICODE)); //////////////////////////////
    $output .= "<li>Numer GUS:  " . $energy_resources['gus'] . "</li>";
    $output .= "<li>Nazwa:  " . $energy_resources['name'] . "</li>";
    $output .= "<li>Jednostka:  " . $energy_resources['unit'] . "</li>";
    $output .= "<li>Ilość:  " . $energy_resources['ammount'] . "</li>";
}
 
 
 
 
 
 
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
 
 
 
 
 
 
 
 
 
 
 

 
close_database();
echo "<br>";
echo"</table>";
?>
</body>
</head>
</html>