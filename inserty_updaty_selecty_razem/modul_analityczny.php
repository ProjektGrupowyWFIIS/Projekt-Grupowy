<!DOCTYPE html>
<html>
<head>
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
<style>
table {
text-align: left;
}
</style>
</head>
<body>
<?php
include('navbar.php');
?>

<div class="text-white text-center">
	<div class="container">
		<div class="row mt-5">
			<div class="col-md-12">



<?php
	
	$currentDir = getcwd();
    $uploadDirectory = "/";
    $errors = []; 
    $fileExtensions = ['json']; 
    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
    if (isset($_POST['submit'])) {
        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "To rozszerzenie jest zablokowane. Przeslij json-a";
        }
        if ($fileSize > 4000000) {
            $errors[] = "Plik jest wiekszy niz 4MB";
        }
        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
            if ($didUpload)
				{			
                echo "Plik json " . basename($fileName) . " został załadowany!";
				echo "<br>";
				echo "Rozpoczynam Obliczanie !";
								echo "<br>";				echo "<br>";
						$jsondata = file_get_contents($fileName);		
						$json = json_decode($jsondata, true);

					require "db_functions.php";
					open_database();
					 
					$output2 = "<ul class=\"list-group list-group-flush\"><ul>";
					$output2 .= "<h1>Produkty</h1>";
					 echo "<table border = \"2\" cellpading= \"10\" cellspacing=\"5\" color = \"black\">";
						
						
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
					 
					 
					 
					foreach ($json['products'] as &$products) {
						$output2 .= "<li class=\"list-group-item font-weight-bold text-dark \">ID produktu:  " . $products['prod_id'] . "</li>";
						$output2 .= "<li  class=\"list-group-item font-weight-bold text-dark\">Nazwa:  " . $products['name'] . "</li>";
						$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">Jednostka:  " . $products['unit'] . "</li>";
						$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">Ilość:  " . $products['ammount'] . "</li>";
						$proc = ($products['ammount'] / $amountOfAllProds) * 100;
					 
						$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">" . round($proc, 2) . " % / products</li>";
						$num = sizeof($products['resources']);
					 
					 
					 
						for ($i = $num-1; $i >=0; $i--) {
							$id = $products['resources'][$i];
							unset($products['resources'][$i]);
						   
							foreach ($json['resources'] as $resources) {
								if ($id == $resources['res_id'])
								{
					 
									$output2 .= "<br>" . $flag . "</br>";
									$output2 .= "<h5>SUROWIEC</h5>";
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">ID:  " . $resources['res_id'] . "</li>";
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">Jednostka:  " . $resources['unit'] . "</li>";
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">Ilość:  " . $resources['ammount'] . "</li>";
									$unit = get_ratio($resources['unit']);
									if (in_array($id, $moreThanOneRes)) {
										$proc = $proc / 100;
										$eqco2OfRes[$nu] = round(($resources['ammount'] * $proc) * $unit * 1, 2);
									} else
										$eqco2OfRes[$nu] = $resources['ammount'] * $unit * 1;
									$resources['eqco2']=$eqco2OfRes[$nu];
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">eqco2:  " . $eqco2OfRes[$nu] . "</li>";
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
					 
						$num2 = sizeof($products['energy_resources']);
						for ($i = $num2-1; $i >= 0; $i--) {
							$id = $products['energy_resources'][$i];
							unset($products['energy_resources'][$i]);
					 
							foreach ($json['energy_resources'] as $energy_resources) {
								if ($id == $energy_resources['gus'])
								{
					 
									$output2 .= "<br></br>";
									$output2 .= "<h5>SUROWIEC ENERGETYCZNY</h5>";
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">ID:  " . $energy_resources['gus'] . "</li>";
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">Jednostka:  " . $energy_resources['unit'] . "</li>";
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">Ilość:  " . $energy_resources['ammount'] . "</li>";
									$unit = get_ratio($energy_resources['unit']);
									if (in_array($id, $moreThanOneERes)) {
										$proc = $proc / 100;
										$eqco2OfRes[$nu] = round(($resources['ammount'] * $proc) * $unit * 1, 2);
									} else
										$eqco2OfRes[$nu] = $energy_resources['ammount'] * $unit * 1;
									$energy_resources['eqco2']=$eqco2OfRes[$nu];
					 
									$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">eqco2:  " . $eqco2OfRes[$nu] . "</li>";
									$total_eqco2 += $eqco2OfRes[$nu];
									array_push($products['energy_resources'], $energy_resources);
					 
									$nu = $nu + 1;
								}
							}
							$output2 .= "<br></br>";
						}
					 
						$products['total_eqco2']=$total_eqco2;
					 
						$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">total_eqco2:  " . $total_eqco2 . "</li>";
						$eqco2_per_unit = $total_eqco2 / $products['ammount'];
						$products['eqco2_per_unit']= $eqco2_per_unit ;
					 
						$output2 .= "<li class=\"list-group-item font-weight-bold text-dark\">eqco2_per_unit:  " . round($eqco2_per_unit, 2) . "</li>";
					 
					 
						$pro[] = $a;
					 
					 
						$total_eqco2 = 0;
					}

					 
					fwrite($fp, json_encode($json,JSON_UNESCAPED_UNICODE));

					echo $output2;

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
						$output .= "<li class=\"list-group-item font-weight-bold text-dark\">Numer GUS:  " . $energy_resources['gus'] . "</li>";
						$output .= "<li  class=\"list-group-item font-weight-bold text-dark \">Nazwa:  " . $energy_resources['name'] . "</li>";
						$output .= "<li class=\"list-group-item font-weight-bold text-dark\">Jednostka:  " . $energy_resources['unit'] . "</li>";
						$output .= "<li class=\"list-group-item font-weight-bold text-dark\">Ilość:  " . $energy_resources['ammount'] . "</li>";
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
						$output .= "<li class=\"list-group-item font-weight-bold text-dark\">Numer ID:  " . $resources['res_id'] . "</li>";
						$output .= "<li  class=\"list-group-item font-weight-bold text-dark\">Nazwa:  " . $resources['name'] . "</li>";
						$output .= "<li class=\"list-group-item font-weight-bold text-dark\">Jednostka:  " . $resources['unit'] . "</li>";
						$output .= "<li class=\"list-group-item font-weight-bold text-dark\">Ilość:  " . $resources['ammount'] . "</li>";
					}
					 
					fclose($fp);

					 
					close_database();
					echo "<br>";
					echo"</table>";	
	
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }


?>


</div>
</div>
</div>
</div>
</body>
</html>
