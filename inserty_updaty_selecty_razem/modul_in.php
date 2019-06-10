<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <title>File Upload with PHP</title>
</head>
<body>
    <?php
    include("navbar.php");
    ?>
    
    <div class="container">
               <div class="row mt-5">
                   <div class="col-md-4"></div>
                   <div class="col-md-4">
    <form action="modul_analityczny.php" method="post" enctype="multipart/form-data">
       <h3 class="text-white text-center">Upload a File:</h3> 
        <input type="file" name="myfile" id="fileToUpload" class="mt-5">
        <button type="submit" name="submit" class="btn btn-block btn-success mt-5 text-center" >Upload Now</button>
        
    </form>
</div>
<div class="col-md-4"></div>
</div>
</div>
</body>
</html>

