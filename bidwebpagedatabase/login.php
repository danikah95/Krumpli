<!DOCTYPE html>
<html lang="hu">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>B-Tech Vatera</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/customcss-homepage.css" rel="stylesheet">

</head>



<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">B-Tech Vatera</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Főoldal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Regisztráció</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Bejelentkezés</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->


  <div class="signup-form">	
    <form action="log.php" method="POST">
		<h2>Bejelentkezés</h2>
        <div class="form-group">
			<div class="input-group">
				<input type="email" class="form-control" name="EMail" placeholder="E-mail cím" required="required">
			</div>
        </div>

		<div class="form-group">
			<div class="input-group">
				<input type="password" class="form-control" name="UserPassword" placeholder="Jelszó" required="required">
			</div>
        </div>
      
		<div class="form-group">
            <button type="submit" class="btn btn-info btn-block btn-lg" name="log_button">Bejelentkezés</button>
        </div>
    </form>
	    <div class="text-center">Még nincs fiókja? <a href="register.php">Regisztráljon most</a>.</div>
    </div>


    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
