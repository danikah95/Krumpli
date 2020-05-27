<?php
	include ("alert_insert.php");
	session_start();
	if(isset($_SESSION["bTechLoggedIn"]) && $_SESSION["bTechLoggedIn"] == true)
	{
	}
	else
	{
		//header('Location: index.html');
		fun_alert ("A hirdetésfeladáshoz először jelentkezzen be!", "login.php");
	}
?>

<!DOCTYPE html>
<html lang="hu">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hirdetésfeladás</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/customcss-homepage.css" rel="stylesheet">

</head>



<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
    <div class="container">
      <a class="navbar-brand" href="loggedIn_index.php">B-Tech Vatera</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
			<li class="nav-item active">
            <a class="nav-link" href="loggedIn_index.php">Főoldal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hirdetesfeladas.php">Hirdetésfeladás</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kijelentkezes.php">Kijelentkezés</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->



  <div class="signup-form">	
  <form action="hirdetesfeladas_insert.php" method="POST" enctype="multipart/form-data">
		<h2>Hirdetésfeladás</h2>
        <div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" name="Title" placeholder="A hirdetés címe" required="required">
			</div>
        </div>
        <div class="form-group">
			<div class="input-group">
				<input type="number" class="form-control" name="Price" placeholder="A termék ára" required="required">
			</div>
        </div>
        <div class="form-group">
			<div class="input-group">
				<input type="textbox" class="form-control" name="Description" placeholder="A hirdetés leírása" required="required">
			</div>
		</div>
		<!-- kategóriák -->

		
        <div class="form-group">
		<select class="selectpicker form-control" id="Fokategoria" name="FokategoriaLista" required>
  			<option value="" disabled selected>Válasszon kategóriát</option>
  			<option value="jarmu">Jármű</option>
			<option value="muszakiCikkek">Műszaki cikkek</option>
			<option value="szabadidoSport">Szabadidő, sport</option>
			<option value="ruhazat">Ruházat</option>
			<option value="otthonHaztartas">Otthon, háztartás</option>
		</select>
		
		<!-- fájl feltöltése -->
		<div class="form-group text-center">
			<label for="fileToUpload">Kép feltöltése:</label>
			<input type="file" name="fileToUpload" id="fileToUpload">
        </div>        
		<div class="form-group">
            <button type="submit" class="btn btn-info btn-block btn-lg" name="reg_btn">Hirdetés feladása</button>
        	</div>
    	</form>
	</div>
	<!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
