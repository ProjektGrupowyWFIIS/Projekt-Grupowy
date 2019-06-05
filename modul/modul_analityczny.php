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

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['json']; // Get all the file extensions

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

						$jsondata = file_get_contents($fileName);		
						//$jsondata = file_get_contents("biostrateg_modul_analityczny_in.json");
						$json = json_decode($jsondata, true);
					$output = "<ul>";
					$output .= "<h3>Surowce energetyczne</h3>";
					echo "<table border = \"2\" cellpading= \"10\" cellspacing=\"5\" color = \"black\">";
					echo"<tr>";
					echo"<th>";
					foreach($json['energy_resources'] as $energy_resources)
					{
						$output .= "<li>Numer GUS:  ".$energy_resources['gus']."</li>";
						$output .= "<li>Nazwa:  ".$energy_resources['name']."</li>";
						$output .= "<li>Jednostka:  ".$energy_resources['unit']."</li>";
						$output .= "<li>Ilość:  ".$energy_resources['ammount']."</li>";
					}
						$output .= "</ul>";
							echo"<th>";

						echo $output;
						
					echo"</th>";
					echo"<th>";
					
					$output2 = "<ul>";
					$output2 .= "<h3>Surowce</h3>";
					foreach($json['resources'] as $resources)
					{
						$output2 .= "<li>ID surowca:  ".$resources['res_id']."</li>";
						$output2 .= "<li>Nazwa:  ".$resources['name']."</li>";
						$output2 .= "<li>Jednostka:  ".$resources['unit']."</li>";
						$output2 .= "<li>Ilość:  ".$resources['ammount']."</li>";
					}
						$output2 .= "</ul>";
						echo $output2;
					echo"</th>";
					echo"<th>";	
					$output2 = "<ul>";
					$output2 .= "<h3>Produkty</h3>";
					foreach($json['products'] as $products)
					{
						$output2 .= "<li>ID produktu:  ".$products['prod_id']."</li>";
						$output2 .= "<li>Nazwa:  ".$products['name']."</li>";
						$output2 .= "<li>Jednostka:  ".$products['unit']."</li>";
						$output2 .= "<li>Ilość:  ".$products['ammount']."</li>";
						$output2 .= "<li>Surowiec:  ".$products['resources']."</li>";
						$output2 .= "<li>Surowiec Energetyczny:  ".$products['energy_resources']."</li>";		
					}
						$output2 .= "</ul>";
						echo $output2;
					echo"</th>";
						
					echo"</table></tr>";
	
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




